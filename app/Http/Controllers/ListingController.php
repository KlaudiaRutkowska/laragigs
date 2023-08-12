<?php

namespace App\Http\Controllers;

use App\Filters\ListingsFilter;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Http\Resources\ListingCollection;
use App\Http\Resources\ListingResource;
use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //dd($request->input('active'));s

        return view('listings.index', [
            'listings' => Listing::latest()
                ->with('tags')
                ->filter($request)
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create', [
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingRequest $request)
    {
        $user = Auth::user();
        $formFields = $request->validated();

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing = new Listing($formFields);

        // example: ['0', '4', 'new' => 'fkndsjf, dskfnkj']
        $tags = collect($formFields['tags']);

        //['new' => 'fkndsjf, dskfnkj']
        // $newTags = $tags->only('new')->reduce(
        //     function($result, $item) {
        //         return explode(', ', $item);
        //     },
        //     //[]
        // );

        $newTags = [];
        $tags->only('new')->each(function($item) use(&$newTags) {
            $tags = array_filter(explode(', ', $item));
            !empty($tags) && array_push($newTags, ...$tags);
        });

        $existingTags = $tags->except('new')->map(function($item) {
            return (int) $item;
        });

        $tags = collect($existingTags);

        foreach($newTags as $tag) {
            $id = Tag::firstOrCreate(['name' => $tag])->id;
            $tags->add($id);
        }

        $user->listings()->save($listing);
        $listing->tags()->sync($tags->values()->toArray());

        return redirect()
            ->route('home')
            ->setStatusCode(Response::HTTP_CREATED)
            ->with('success', 'Element is created!');
    }

    public function manage() {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return view('listings.edit', [
            'listing' => $listing,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingRequest $request, Listing $listing)
    {
        $formFields = $request->validated();

        $listing->fill($formFields);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $tags = collect($formFields['tags']);

        $newTags = [];
        $tags->only('new')->each(function($item) use(&$newTags) {
            $tags = array_filter(explode(', ', $item));
            !empty($tags) && array_push($newTags, ...$tags);
        });

        $existingTags = $tags->except('new')->map(function($item) {
            return (int) $item;
        });

        $tags = collect($existingTags);

        foreach($newTags as $tag) {
            $id = Tag::firstOrCreate(['name' => $tag])->id;
            $tags->add($id);
        }

        $listing->save();
        $listing->tags()->sync([]);
        $listing->tags()->sync($tags->values()->toArray());

        return redirect()
            ->route('listing.show', [$listing])
            ->with('success', 'Element is edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect('/')->with('success', 'Post deleted successfully!');

    }
}
