<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\CommunityPostResource;

class FrontendCommunityController extends Controller
{

    public function show($slug)
    {
        $community = Community::where('slug', $slug)->firstOrFail();
        $posts = CommunityPostResource::collection($community->posts()->with(['user','postVotes' =>function($query){
            $query->where('user_id',auth()->id());
        }])->withCount('comments')->paginate(3)); 

        return Inertia::render('Frontend/Communities/Show', compact('community', 'posts'));
    }
}