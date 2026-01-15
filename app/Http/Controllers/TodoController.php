<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TodoController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Todo::class);

        $todosNotDone = Todo::where('user_id', Auth::id())
            ->where('is_done', false)
            ->orderBy('due_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        $todosDone = Todo::where('user_id', Auth::id())
            ->where('is_done', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('todos.index', compact('todosNotDone', 'todosDone'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Todo::class);

        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'due_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048', // 画像バリデーション
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            // Cloudinaryへ直接アップロードしURLを取得
            $imageUrl = $request->file('image')->storeOnCloudinary('todos')->getSecurePath();
        }

        Todo::create([
            'title'   => $request->title,
            'user_id' => Auth::id(),
            'due_date' => $request->due_date,
            'image_path' => $imageUrl, // DBにURLを保存
        ]);

        return redirect()->route('todos.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $todo = Todo::findOrFail($id);
    
        $this->authorize('update', $todo);
    
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:150',
            'is_done' => 'sometimes|boolean',
            'due_date' => 'nullable|date',
        ]);

        $todo->update($validated);

        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);
    
        $this->authorize('delete', $todo);
    
        $todo->delete();
    
        return redirect()->route('todos.index');
    }
}
