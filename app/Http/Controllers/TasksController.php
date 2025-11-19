<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TasksController extends Controller
{
    //! Crud Operations
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json(Auth::user()->tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'priority' => $request->priority,
            'user_id' => Auth::id()
        ]);
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $Task)
    {
        Gate::authorize('view', $Task);
        return response()->json($Task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $Task)
    {
        Gate::authorize('update', $Task);
        $Task->update($request->only(['title', 'description', 'due_date', 'status', 'periority']));
        return response()->json($Task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $Task)
    {
        Gate::authorize('delete', $Task);
        $Task->delete();
        return response()->json(['messaga' => 'Task Deleted'], 200);
    }
    //!

    //? Changing the status of the task
    public function markAsCompleted(Task $Task)
    {
        Gate::authorize('changeStatus', $Task);
        $Task->markTaskAsComplete();
        return response()->json(['Massege' => 'Task Marked As Complete'], 200);
    }

    public function markAsinProgress(Task $Task)
    {
        Gate::authorize('changeStatus', $Task);
        $Task->markTaskAsInProgress();
        return response()->json(['Massege' => 'Task Marked As In_Progress'], 200);
    }
    //?

    //* Get Tasks Accourding to its Status
    public function getStatusTasks($status)
    {
        return response()->json(Task::getStatusTasks(Auth::id(), $status), 200);
    }
    //* Get Tasks Accourding to its periority
    public function getPeriorityTasks($periority)
    {
        return response()->json(Task::getPeriorityTasks(Auth::id(), $periority), 200);
    }
}
