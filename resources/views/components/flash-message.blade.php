@if (session()->has('success'))
    <div
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50"
        role="alert">
        <p> {{ session()->get('success') }} </p>
    </div>
@endif
