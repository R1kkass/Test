<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Jobs\TaskUpdateJob;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function list() {
        return Inertia::render("Task/Tasks", [
            "tasks" => Task::whereStatus(Task::ACTIVE)->where("period_end", ">", today())->whereUserIdGetter(null)->with("userCreator")->get(),
        ]);
    }

    public function viewTask(Task $task) {
        if($task->status != Task::ACTIVE || $task->user_id_getter != null) {
            abort(404);
        }
        
        $task->userCreator;

        return Inertia::render("Task/Task", [
            "task" => $task,
        ]);
    }

    public function startTask(Task $task, Request $request) {
        Gate::authorize("start", $task);

        $task->user_id_getter = $request->user()->id;
        $task->status = Task::AT_WORK;
        $task->save();

        return redirect()->route("userTasks")->with('message', 'Задание взято');
    }

    public function userTasks(Request $request) {
        return Inertia::render("Task/UserTasks", [
            "getted_tasks" => Task::whereUserIdGetter($request->user()->id)->whereStatus(Task::AT_WORK)->get(),
            "success_tasks" => Task::whereUserIdGetter($request->user()->id)->whereStatus(Task::SUCCESS)->get(),
            "created_tasks" => Task::whereUserIdCreator($request->user()->id)->with("userGetter")->get()
        ]);
    }

    public function createTask(TaskCreateRequest $request) {
        Task::create([
            "title" => $request->title,
            "body" => $request->body,
            "period_start" => Carbon::parse($request->period_start),
            "period_end" => Carbon::parse($request->period_end),
            "user_id_creator" => $request->user()->id,
            "status" => Carbon::parse($request->period_start,"GMT+3")>now() ? Task::WAIT : Task::ACTIVE
        ]);

        return redirect()->route("userTasks")->with('message', 'Задание создано');
    }

    public function viewCreateTask() {
        return Inertia::render("Task/CreateTask");
    }

    public function updateStatus(Task $task) {
        Gate::authorize("updateStatus", $task);

        $task->status = Task::SUCCESS;
        $task->save();

        return redirect()->route("userTasks")->with('message', 'Задание выполнено');;
    }

    public function rejectTask(Task $task) {
        Gate::authorize("updateStatus", $task);
        
        $task->status = Task::ACTIVE;
        $task->user_id_getter;
        $task->save();

        return redirect()->route("userTasks")->with('message', 'Задание отменено');
    }

    public function viewUpdateTask(Task $task) {
        Gate::authorize("update", $task);

        return Inertia::render("Task/CreateTask", [
            "task" => $task,
            "routeName" => "updateTask"
        ]);
    }

    public function updateTask(Task $task, TaskCreateRequest $request) {
        Gate::authorize("update", $task);

        $task->title = $request->title;
        $task->body = $request->body;
        $task->period_start = $request->period_start;
        $task->period_end = $request->period_end;

        $task->save();

        return redirect()->route("userTasks")->with('message', 'Задание обновлено');
    }

    public function userTask(Task $task) {
        Gate::authorize("get", $task);
        $task->userGetter;
        return Inertia::render("Task/UserTask", [
            "task" => $task,
        ]);
    }
}
