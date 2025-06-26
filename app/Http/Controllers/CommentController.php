<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    private $filePath = 'comments.json';

    public function index()
    {
        if (Storage::exists($this->filePath)) {
            $comments = json_decode(Storage::get($this->filePath), true);
            return response()->json($comments ?: []);
        }
        return response()->json([]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $comments = Storage::exists($this->filePath)
            ? json_decode(Storage::get($this->filePath), true)
            : [];

        $comments[] = [
            'author' => $request->author,
            'text' => $request->text,
            'created_at' => now()->toDateTimeString(),
        ];

        Storage::put($this->filePath, json_encode($comments, JSON_PRETTY_PRINT));

        return response()->json(['success' => true]);
    }
}