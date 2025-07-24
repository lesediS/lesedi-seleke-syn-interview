<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/session.php';
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

startSession();
requireLogin();

$database = new Database();
$taskManager = new Task($database);
$currentUser = getCurrentUser();

$tasks = $taskManager->getUserTasks($currentUser['id'], 'completed');

$exportType = $_GET['type'] ?? '';

switch ($exportType) {
    case 'pdf':
        exportAsPDF($tasks, $currentUser);
        break;
    case 'csv':
        exportAsCSV($tasks, $currentUser);
        break;
    default:
        header('HTTP/1.1 400 Bad Request');
        echo 'Invalid export type';
        exit;
}



function exportAsCSV($tasks, $user)
{
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="completed_tasks_' . date('Y-m-d') . '.csv"');

    $output = fopen('php://output', 'w');

    fputcsv($output, ['ID', 'Title', 'Description', 'Due Date', 'Completed At']); // CSV column headings

    foreach ($tasks as $task) {
        fputcsv($output, [
            $task['id'],
            $task['title'],
            $task['description'],
            $task['due_date'],
            $task['completed_at']
        ]);
    }

    fclose($output);
    exit;
}

function exportAsPDF($tasks, $user) {
    try {
        
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans'
        ]);

        // Styling exported pdf
        $stylesheet = '
        body { font-family: Arial; font-size: 10pt; }
        h1 { color: #333366; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #f2f2f2; font-weight: bold; }
        td, th { padding: 6px; border: 1px solid #ddd; }
        ';

        $html = '
        <html>
            <head>
                <style>'.$stylesheet.'</style>
            </head>
            <body>
                <h1>Completed Tasks Report</h1>
                <p><strong>User:</strong> '.htmlspecialchars($user['username']).'</p>
                <p><strong>Date:</strong> '.date('Y-m-d H:i:s').'</p>
                <p><strong>Total Tasks:</strong> '.count($tasks).'</p>
                
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Completed At</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($tasks as $task) {
            $html .= '
                <tr>
                    <td>'.$task['id'].'</td>
                    <td>'.htmlspecialchars($task['title']).'</td>
                    <td>'.htmlspecialchars($task['description']).'</td>
                    <td>'.$task['due_date'].'</td>
                    <td>'.$task['completed_at'].'</td>
                </tr>';
        }

        $html .= '
                    </tbody>
                </table>
            </body>
        </html>';

        $mpdf->WriteHTML($html);
        
        $mpdf->Output('completed_tasks_'.date('Y-m-d').'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
        exit;

    } catch (\Exception $e) {
        error_log('PDF Export Error: '.$e->getMessage());
        header('Content-Type: text/plain');
        echo 'Error generating PDF. Please try again.';
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            echo "\nDebug: ".$e->getMessage();
        }
        exit;
    }
}
?>