<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tasks')->get();

        return view('tasks', compact('tasks'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('tasks')->insert([
            'name' => $request->input('name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('tasks')->with('success', 'Task created successfully.');
    }

    public function destroy(int $id)
    {
        DB::table('tasks')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }

    public function edit(int $id)
    {
        $tasks = DB::table('tasks')->get();
        $task = DB::table('tasks')->where('id', $id)->first();

        if (! $task) {
            abort(404);
        }

        return view('tasks', compact('tasks', 'task'));
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('tasks')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'updated_at' => now(),
            ]);

        return redirect('/tasks')->with('success', 'Task updated successfully.');
    }
}
