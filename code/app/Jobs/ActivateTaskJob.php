<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class ActivateTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */


    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Task::where("period_end", "<", now("GMT+3"))->whereNot("status", Task::SUCCESS)->update([
            "status" => Task::OVERDUE
        ]);
        Task::where("period_start" ,"<", now("GMT+3"))->whereStatus(Task::WAIT)->update([
            "status" => Task::ACTIVE
        ]);
    }
}
