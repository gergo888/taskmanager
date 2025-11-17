<?php

namespace TaskManager;
use Carbon\Carbon;


class TaskManager
{
    private array $tasks = [];

    public function addTask($title, $description, $priority): int
    {
        $newId = count($this->tasks);
        $this->tasks[] = new Task($newId, $title, $description, "planned", $priority, Carbon::now());
        return $newId;
    }

    public function removeTask(int $id): void
    {
        $taskIndex = -1;
        for ($i = 0; $i < count($this->tasks); $i++) {
            $currentTask = $this->tasks[$i];
            if ($currentTask->id == $id) {
                $taskIndex = $i;
            }
        }
        if ($taskIndex != -1) {
            unset($this->tasks[$taskIndex]);
        }
    }

    public function getAllTasks(): array
    {
        return $this->tasks;
    }

    public function getTasksByStatus(string $status): array
    {
        $resultArray = [];
        foreach ($this->tasks as $task) {
            if ($task->status == $status) {
                $resultArray[] = $task;
            }
        }
        return $resultArray;
    }
    
    public function getTasksByPriority(string $priority): array
    {
        $resultArray = [];
        foreach ($this->tasks as $task) {
            if ($task->priority == $priority) {
                $resultArray[] = $task;
            }
        }
        return $resultArray;
    }

    public function getTaskByID(int $id): Task
    {
        $resultTask = null;
        foreach ($this->tasks as $task) {
            if ($task->id == $id) {
                $resultTask = $task;
            }
        }
        return $task;
    }

    public function getTotalTaskCount(): int
    {
        return count($this->tasks);
    }

    public function getCompletedTaskCount(): int
    {
        $count = 0;
        foreach ($this->tasks as $task) {
            if ($task->status == "completed") {
                $count++;
            }
        }
        return $count;
    }

    public function displayTasks($tasks): void
    {
        foreach ($tasks as $task) {
            echo $task->getDetails() . "\n";
        }
    }
}
