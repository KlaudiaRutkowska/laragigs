<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Http\Resources\ListingResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ListingResource::collection(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingRequest $request)
    {
        return new ListingResource(
            Tag::create($request->validated())
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return new ListingResource($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingRequest $request, Tag $tag)
    {
        return $tag->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        return $tag->delete();
    }
}
