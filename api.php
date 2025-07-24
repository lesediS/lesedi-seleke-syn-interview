<?php
require_once 'config.php';

startSession();
requireLogin();

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? $_POST['action'] ?? '';

$database = new Database();
$taskManager = new Task($database);
$currentUser = getCurrentUser();

$response = ['success' => false, 'message' => '', 'data' => null];

// Trying to manage our tasks based on the action
try {
    switch ($action) {
        case 'get_tasks':
            $status = $_GET['status'] ?? null;
            $tasks = $taskManager->getUserTasks($currentUser['id'], $status);
            $response = [
                'success' => true,
                'data' => $tasks,
                'count' => count($tasks)
            ];
            break;
            
        case 'get_task':
            $taskId = (int)($_GET['id'] ?? 0);
            $task = $taskManager->getTask($taskId, $currentUser['id']);
            if ($task) {
                $response = ['success' => true, 'data' => $task];
            } else {
                $response = ['success' => false, 'message' => 'Task not found'];
            }
            break;
            
        case 'create_task':
            if ($method === 'POST') {
                $title = sanitizeInput($_POST['title'] ?? '');
                $description = sanitizeInput($_POST['description'] ?? '');
                $dueDate = sanitizeInput($_POST['due_date'] ?? '');
                
                if (empty($title) || empty($dueDate)) {
                    $response = ['success' => false, 'message' => 'Title and due date are required'];
                } else {
                    $result = $taskManager->createTask($currentUser['id'], $title, $description, $dueDate);
                    if ($result) {
                        $response = ['success' => true, 'message' => 'Task created successfully'];
                    } else {
                        $response = ['success' => false, 'message' => 'Failed to create task'];
                    }
                }
            }
            break;
            
        case 'update_task':
            if ($method === 'POST') {
                $taskId = (int)($_POST['task_id'] ?? 0);
                $title = sanitizeInput($_POST['title'] ?? '');
                $description = sanitizeInput($_POST['description'] ?? '');
                $dueDate = sanitizeInput($_POST['due_date'] ?? '');
                
                if (empty($title) || empty($dueDate)) {
                    $response = ['success' => false, 'message' => 'Title and due date are required'];
                } else {
                    $result = $taskManager->updateTask($taskId, $currentUser['id'], $title, $description, $dueDate);
                    if ($result) {
                        $response = ['success' => true, 'message' => 'Task updated successfully'];
                    } else {
                        $response = ['success' => false, 'message' => 'Failed to update task'];
                    }
                }
            }
            break;
            
        case 'complete_task':
            if ($method === 'POST') {
                $taskId = (int)($_POST['task_id'] ?? 0);
                $result = $taskManager->markAsCompleted($taskId, $currentUser['id']);
                if ($result) {
                    $response = ['success' => true, 'message' => 'Task marked as completed'];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to complete task'];
                }
            }
            break;
            
        case 'delete_task':
            if ($method === 'POST') {
                $taskId = (int)($_POST['task_id'] ?? 0);
                $result = $taskManager->deleteTask($taskId, $currentUser['id']);
                if ($result) {
                    $response = ['success' => true, 'message' => 'Task deleted successfully'];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to delete task'];
                }
            }
            break;
            
        case 'bulk_complete':
            if ($method === 'POST') {
                $taskIds = $_POST['task_ids'] ?? [];
                $successCount = 0;
                
                foreach ($taskIds as $taskId) {
                    if ($taskManager->markAsCompleted((int)$taskId, $currentUser['id'])) {
                        $successCount++;
                    }
                }
                
                if ($successCount > 0) {
                    $response = [
                        'success' => true, 
                        'message' => "$successCount task(s) marked as completed"
                    ];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to complete tasks'];
                }
            }
            break;
            
        case 'get_stats':
            $allTasks = $taskManager->getUserTasks($currentUser['id']);
            $pendingTasks = $taskManager->getUserTasks($currentUser['id'], 'pending');
            $completedTasks = $taskManager->getUserTasks($currentUser['id'], 'completed');
            
            $overdueTasks = array_filter($pendingTasks, function($task) {
                return isOverdue($task['due_date']);
            });
            
            $dueSoonTasks = array_filter($pendingTasks, function($task) {
                return !isOverdue($task['due_date']) && strtotime($task['due_date']) <= strtotime('+3 days');
            });
            
            $response = [
                'success' => true,
                'data' => [
                    'total' => count($allTasks),
                    'pending' => count($pendingTasks),
                    'completed' => count($completedTasks),
                    'overdue' => count($overdueTasks),
                    'due_soon' => count($dueSoonTasks)
                ]
            ];
            break;
            
        default:
            $response = ['success' => false, 'message' => 'Invalid action'];
            break;
    }
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'An error occurred: ' . $e->getMessage()
    ];
}

// Output JSON response
echo json_encode($response);
exit;
?>