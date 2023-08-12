@props(['listing'])

@php $tags = json_decode($listing->tags) @endphp

@foreach ($tags as $tag)
    <li
        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 text-xs">
        <a href="/?tag={{$tag->name}}">{{$tag->name}}</a>
    </li>
@endforeach