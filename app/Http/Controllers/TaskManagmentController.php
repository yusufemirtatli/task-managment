<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskManagmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::where('user_id', Auth::id())->get();

        return view('myviews.tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('myviews.tasks.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        Tasks::create([
            'name' => $request->title,
            'desc' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect(route('tasks-index'))->with('success', 'Task başarıyla eklendi!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Tasks::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Bu görevi düzenleme yetkiniz yok.');
        }

        return view('myviews.tasks.create-edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $task = Tasks::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Bu görevi güncelleme yetkiniz yok.');
        }

        $task->update([
            'name' => $request->title,
            'desc' => $request->description,
        ]);

        return redirect(route('tasks-index'))->with('success', 'Task başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Tasks::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Bu görevi silme yetkiniz yok.');
        }

        $task->delete();

        return redirect(route('tasks-index'));
    }

    /**
     * Mark the specified task as complete.
     */
    public function complete($id)
    {
        $task = Tasks::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Bu görevi tamamlama yetkiniz yok.');
        }

        $task->status = 1;
        $task->save();

        return redirect(route('tasks-index'));
    }
}
