<?php

use App\Models\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text("title");
            $table->text("body");
            $table->enum("status", [Task::WAIT, Task::ACTIVE, Task::SUCCESS, Task::AT_WORK, Task::OVERDUE]);
            $table->foreignId('user_id_creator')->references('id')->on('users');
            $table->foreignId('user_id_getter')->nullable()->references('id')->on('users');
            $table->dateTimeTz('period_start');
            $table->dateTimeTz('period_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
