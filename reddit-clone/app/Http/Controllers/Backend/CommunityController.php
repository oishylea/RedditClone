<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\CommunityStoreRequest;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Add this line



class CommunityController extends Controller
{   

    use AuthorizesRequests; 
    public function show($slug){
        $community = Community:: where('slug',$slug)->firstOrFail();
        $posts = CommunityPostResource::collection(Community->post()->with('user')->paginate(12));
        return Inertia::render('Fronted/Communities/Show', compact('community','posts'));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communities = Community::where('user_id',auth()->id())->paginate(5)->through(fn($community) => [
            'id' => $community->id,
            'name' => $community->name,
            'slug' => $community->slug,
        ]);
        // $communities = Community::paginate(10);
        // dd($communities);
        return Inertia::render( 'Communities/Index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Communities/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityStoreRequest $request)
    {
        Community::create(
            $request->validated() + [
                'slug' => Str::slug($request->name), //generate slug from name
                'user_id'=>auth()->id()
            ]
        );
    
        return to_route('communities.index')->with('message','Community created successfully.');
    }


    public function edit(Community $community)
    {
        $this->authorize('update', $community);
        return Inertia::render('Communities/Edit', compact('community'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommunityStoreRequest $request, Community $community)
    {
        $this->authorize('update', $community);

        $community->update(
            $request->validated() + [
                'slug' => Str::slug($request->name) // Update slug when name changes
            ]
        );

        return to_route('communities.index')->with('message','Community updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        $this->authorize('delete', $community);

        $community->delete();
        return redirect()->route('communities.index')->with('message', 'Community deleted successfully.');
    }

    // app/Http/Controllers/Backend/CommunityController.php


}

