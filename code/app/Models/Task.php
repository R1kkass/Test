<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const WAIT = "wait";
    const ACTIVE = "active";
    const SUCCESS = "success";
    const AT_WORK = "at_work";
    const OVERDUE = "overdue";

    protected $fillable = [
        'title',
        'body',
        'user_id_creator',
        'user_id_getter',
        'period_start',
        'period_end',
        "status"
    ];

    public function userCreator() {
        return $this->belongsTo(User::class, "user_id_creator");
    }

    public function userGetter() {
        return $this->belongsTo(User::class, "user_id_getter");
    }
}
