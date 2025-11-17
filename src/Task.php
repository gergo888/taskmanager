<?php

namespace TaskManager;

use Carbon\Carbon;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public string $status,
        public string $priority,
        public Carbon $createdAt,
    ){}

    public function markAsCompleted(): void
    {
        $this->status = "completed";
    }

    public function markAsInProgress(): void
    {
        $this->status = "in progress";
    }

    public function updatePriority(string $priority): void
    {
      $this->priority = $priority;
    }

    public function getDetails(): string
    {
      return "id: {$this->id} Title: {$this->title}, description: {$this->description}, status: {$this->status}, priority: {$this->priority}, created: {$this->createdAt}";
    }

}
