<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\CommunityStoreRequest;
use App\Models\Community;




class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "ok";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(component: 'Communities/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityStoreRequest $request)
    {
        Community::create($request->validated()+['user_id'=>auth()->id()]);
    
        return to_route('communities.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
