@props(['message'])

@if ($message)
    <div class="bg-slate-800 border-slate-600 text-white text-center rounded-full font-bold border-8 p-4 my-2">
        {{ $message }}
    </div>
@endif
