<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CommunityPostController extends Controller
{
    public function create(Community $community)
    {
        return Inertia::render('Communities/Posts/Create', compact('community'));
    }

    public function store(StorePostRequest $request, Community $community)
    {
        // Generate a slug from the title
        $slug = Str::slug($request->title);
    
        // Create the post
        $community->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'slug' => $slug, // Include the generated slug
        ]);
    
        return Redirect::route('frontend.communities.show', $community->slug);
    }
}