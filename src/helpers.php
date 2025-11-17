<?php

namespace TaskManager;


function displayStatistics(TaskManager $taskManager): void
{
    $allTasks = $taskManager->getAllTasks();
    $totalCount = $taskManager->getTotalTaskCount();
    $completedCount = $taskManager->getCompletedTaskCount();
    
    $pendingCount = count(array_filter($allTasks, fn($task) => $task->status === 'planned'));
    $inProgressCount = count(array_filter($allTasks, fn($task) => $task->status === 'in-progress'));
    
    $highPriority = count(array_filter($allTasks, fn($task) => $task->priority === 'high'));
    $mediumPriority = count(array_filter($allTasks, fn($task) => $task->priority === 'medium'));
    $lowPriority = count(array_filter($allTasks, fn($task) => $task->priority === 'low'));
    
    echo "\n=== Statistics ===\n";
    echo "Total Tasks: {$totalCount}\n";
    echo "Completed: {$completedCount}\n";
    echo "Pending: {$pendingCount}\n";
    echo "In Progress: {$inProgressCount}\n";
    echo "\nBy Priority:\n";
    echo "  - High: {$highPriority}\n";
    echo "  - Medium: {$mediumPriority}\n";
    echo "  - Low: {$lowPriority}\n";
    
    if ($totalCount > 0) {
        $completionRate = round(($completedCount / $totalCount) * 100, 1);
        echo "\nCompletion Rate: {$completionRate}%\n";
    }
}
