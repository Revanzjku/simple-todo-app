<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => false
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas Berhasil Ditambahkan!!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        //
        $task->update($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus');
    }

    public function trashed()
    {
        $tasks = Task::onlyTrashed()->get();
        return view('trash', compact('tasks'));
    }

    public function restore($id) 
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dikembalikan');
    }

    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus permanen');
    }
}
