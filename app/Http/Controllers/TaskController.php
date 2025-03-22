<?php

namespace App\Http\Controllers;

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
        $tasks = Task::latest()->get();
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

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $task->update([
            'status' => !$task->status
        ]);

        return redirect()->route('tasks.index')->with('success', 'Status tugas telah berubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        //
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tugas telah dihapus!');
    }

    public function recycleBin()
    {
        $tasks = Task::onlyTrashed()->get();
        return view('recycle-bin', compact('tasks'));
    }

    public function restore(Task $task)
    {
        $task->restore();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dipulihkan!');
    }

    public function forceDelete(Task $task)
    {
        $task->forceDelete();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus permanen!');
    }
}
