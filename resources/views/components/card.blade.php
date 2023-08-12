{{--
    thanks to variable attributes merge method can be used.
    Merge method means that by default it's gonna use values in braces (class in this case) but it can be overwritten in <x-...> tag
--}}
<div {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6']) }}>
    {{ $slot }}
</div>

{{--
<div class="bg-gray-50 border border-gray-200 rounded p-6">
    {{$slot}}
</div>
--}}
