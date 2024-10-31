<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostCommentController extends Controller
{
    public function store($community_slug, Post $post)
    {
        $validator = Validator::make(request()->all(), [
            'content' => 'required|string|max:1000', // Validate comment content
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => request()->input('content'),
        ]);

        return back()->with('success', 'Comment added successfully!'); // Optional success message
    }
}