<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/session.php';

startSession();
requireLogin();

header('Content-Type: application/json');

$database = new Database();
$taskManager = new Task($database);
$currentUser = getCurrentUser();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $taskId = (int)$_POST['task_id'];
    $task = $taskManager->getTask($taskId, $currentUser['id']);
    
    if ($task) {
        echo json_encode([
            'id' => $task['id'],
            'title' => $task['title'],
            'description' => $task['description'],
            'due_date' => $task['due_date']
        ]);
        exit;
    }
}

http_response_code(404);
echo json_encode(['error' => 'Task not found']);