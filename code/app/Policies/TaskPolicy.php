<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task) {
        return $task->user_id_creator == $user->id && ($task->user_id_getter == null && $task->status == Task::ACTIVE || $task->status == Task::SUCCESS);
    }

    public function updateStatus(User $user, Task $task) {
        return $task->user_id_getter == $user->id && $task->period_end > now();
    }

    public function start(User $user, Task $task) {
        return $task->user_id_getter == null && $task->period_end > now() && $task->status == Task::ACTIVE;
    }

    public function get(User $user, Task $task) {
        return $task->user_id_creator == $user->id;
    }
}
