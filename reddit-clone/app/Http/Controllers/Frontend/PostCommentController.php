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
            return response()->json(['errors' => $validator->errors()], 422); // Return errors as JSON
        }

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => request()->input('content'),
        ]);
        
        // Ensure the comment has a `username` field, either directly or via relationship
        $username = auth()->user()->username; // Assuming you have a username field in your User model
        

    }
}