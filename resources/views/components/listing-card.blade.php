@props(['listing'])

<x-card>
    <div class="flex items-center">
        <img class="hidden w-48 mr-6 md:block" src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png') }}" alt=""/>
        <div>
            <h3 class="text-2xl">
                <a href="listings/{{$listing->id}}.html">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">Company: {{$listing->company}}</div>
            <ul class="flex flex-wrap gap-2">

                <x-listing-tags :listing="$listing" />

            </ul>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot mr-2"></i>Country: {{$listing->location}}
            </div>
        </div>
    </div>
</x-card>
