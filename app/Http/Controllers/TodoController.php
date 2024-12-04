<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    //todo page
    public function TodoPage()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $todos = Todo::where('user_id', Auth::id())->get();
        return view('index', compact('todos'));
    }

    // Add todo
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        Todo::create([
            'task' => $request->task,
            'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'Todo added successfully!');
        return redirect()->route('todos.page');
    }

    // Update todo
    public function update(Todo $todo)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($todo->user_id !== Auth::id()) {
            return redirect()->route('todos.page');
        }

        $todo->status = $todo->status === 'completed' ? 'pending' : 'completed';
        $todo->save();

        session()->flash('success', 'Todo updated successfully!');
        return redirect()->route('todos.page');
    }

    //edit todo
    public function edit(Request $request, Todo $todo)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($todo->user_id !== Auth::id()) {
            return redirect()->route('todos.page');
        }

        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        $todo->task = $request->task;
        $todo->save();

        session()->flash('success', 'Edit todo successfully!');
        return redirect()->route('todos.page');
    }


    // Delete todo
    public function destroy(Todo $todo)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($todo->user_id !== Auth::id()) {
            return redirect()->route('todos.page');
        }

        $todo->delete();
        session()->flash('success', 'Todo deleted successfully!');
        return redirect()->route('todos.page');
    }
}
