#!/usr/bin/env php

<?php

use TaskManager\Task;
use TaskManager\TaskManager;


require_once __DIR__ . '/vendor/autoload.php';

$taskManager = new TaskManager();

function showStatistics($taskManager): void
{
    $allTasks = $taskManager->getAllTasks();

}

function executeCommand(int $input, TaskManager $taskManager): void 
{
    switch ($input) {
        case 1:
            $inputTitle = readline("Enter title: ");
            $inputDesc = readline("Enter description: ");
            $inputPriority = readline("Enter priority (low|medium|high): ");
            $newId = $taskManager->addTask($inputTitle, $inputDesc, $inputPriority);
            echo "Task added successfully! (ID: {$newId})\n";
            break;
        case 2:
            $allTasks = $taskManager->getAllTasks();
            $taskManager->displayTasks($allTasks);
            break;
        case 3:
            $inputStatus = readline("Enter status (planned|in-progress|completed): ");
            $tasks = $taskManager->getTasksByStatus($inputStatus);
            $taskManager->displayTasks($tasks);
            break;
        case 4:
            $inputPriority = readline("Enter priority (low|medium|high): ");
            $tasks = $taskManager->getTasksByPriority($inputPriority);
            $taskManager->displayTasks($tasks);
            break;
        case 5:
            $inputId = readline("Enter id: ");
            $task = $taskManager->getTaskByID($inputId);
            $task->status = "in-progress";
            break;
        case 6:
            $inputId = readline("Enter id: ");
            $task = $taskManager->getTaskByID($inputId);
            $task->status = "completed";
            break;
        case 7:
            $inputId = readline("Enter id: ");
            $taskManager->removeTask($inputId);
            break;
        case 8:
            showStatistics($taskManager);
            break;
    }
}

do{
    echo "
=== Task Management System ===

1. Add new task
2. List all tasks
3. List tasks by status
4. List tasks by priority
5. Mark task as in progress
6. Mark task as completed
7. Delete task
8. Show statistics
9. Exit
";
    $input = (int)readline("\nEnter your choice: ");
    executeCommand($input, $taskManager);
    if ($input != 9) {
        $enter = readline("\npress ENTER to continue\n");
    }
} while($input != 9);