@extends('layout')
@section('content')
    @include('partials._search')
    @include('components.flash-message')

    <a href="/" class="inline-block text-black ml-4 mb-4">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <div
        class="mx-4"
        x-data="{ showModal: false }"
        @keydown.escape="showModal = false"
    >
        <x-card class="p-10 bg-black">
            <div class="flex flex-col items-center justify-center text-center">
                <img
                    class="w-48 mr-6 mb-6"
                    src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png') }}"
                    alt=""
                />

                <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
                <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
                <ul class="flex flex-wrap gap-2">
                    <x-listing-tags :listing="$listing"/>
                </ul>
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot mr-2"></i>{{$listing->location}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>{{$listing->description}}</p>

                        <a
                            href="mailto:{{$listing->email}}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-envelope"></i>
                            Contact Employer</a
                        >

                        <a
                            href="{{ $listing->website }}"
                            target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-globe"></i>Visit Website</a
                        >
                    </div>
                </div>
            </div>
        </x-card>

        @auth()
            @if($listing->isOwner())
                <x-card class="mt-4 p-2 flex space-x-6">
                    <a href="/listings/{{ $listing->id }}/edit">
                        <i class="fa-solid fa-pencil"></i> Edit
                    </a>

                    <button type="button" class="text-red-500" x-on:click="showModal = !showModal">
                        <i class="fa-solid fa-trash"></i>
                        Delete post
                    </button>
                </x-card>
            @endif
        @endauth

        <template x-if="true">
            <div
                class="fixed inset-0 overflow-y-auto z-30"
                x-show="showModal"
                x-transition.duration.500ms
                x-transition.opacity
            >

                <div
                    x-show="showModal"
                    x-transition.opacity
                    class="fixed inset-0 bg-black bg-opacity-50"
                    aria-hidden="true"
                >
                </div>

                <div
                    x-show="showModal"
                    x-transition
                    x-on:click="showModal = false"
                    class="relative flex min-h-screen items-center justify-center p-4">

                    <div x-on:click.stop
                         class="relative w-full max-w-lg overflow-y-auto rounded-xl bg-white p-12 shadow-lg">
                        <h2 class="text-3xl font-bold">Confirm</h2>

                        <p class="mt-2 text-gray-600">Are you sure you want to delete listing?</p>

                        <div class="mt-8 flex space-x-2">
                            <form action="/listings/{{ $listing->id }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button
                                    x-on:click="showModal = false"
                                    class="rounded-md border border-laravel bg-laravel text-white text-red-500 px-5 py-2.5">
                                    Delete
                                </button>
                            </form>
                            <button type="button" x-on:click="showModal = false"
                                    class="rounded-md border border-gray-200 bg-white px-5 py-2.5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

@endsection
