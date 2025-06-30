<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller{
    public function findByUuid($uuid){
        $task = Task::where('uuid', $uuid)->firstOrFail();
        return response()->json($task);
    }

    public function index() {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return response()->json($tasks);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'deadline' => 'nullable|date',
            'completed' => 'boolean',
            'description' => 'nullable|string',
        ]);
        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    public function update(Request $request, string $uuid){
        $task = Task::where('uuid', $uuid)->firstOrFail();
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'deadline' => 'nullable|date',
            'completed' => 'boolean',
            'description' => 'nullable|string',
        ]);
        $task->update($validated);
        return response()->json($task);
    }

    public function destroy(string $uuid){
        $task = Task::where('uuid', $uuid)->firstOrFail();
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
