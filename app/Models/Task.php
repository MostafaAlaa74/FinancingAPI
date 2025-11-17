<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TasksFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'priority',
        'user_id',
    ];

    //* changing the status of a task

    public function markTaskAsComplete()
    {
        $this->status = 'completed';
        $this->save();
    }
    public function markTaskAsInProgress()
    {
        $this->status = 'in_progress';
        $this->save();
    }

    //* Get Tasks Accourding to its Status
    public static function getStatusTasks($userId, $status)
    {
        if( $status !== 'pending' && $status !== 'in_progress' && $status !== 'completed'){
            return null;
        }
        return self::where('user_id', $userId)->where('status', $status)->get();
    }

    //* Get Tasks Accourding to its Periority
    public static function getPeriorityTasks($userId, $priority)
    {
        if( $priority !== 'low' && $priority !== 'medium' && $priority !== 'high'){
            return null;
        }
        return self::where('user_id', $userId)->where('priority', $priority)->get();
    }


    //! Relation Ship functions

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
