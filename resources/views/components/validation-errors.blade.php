@props(['errors'])

@if ($errors->any())
    <div class="bg-violet-400 border-violet-200 text-white text-center font-bold rounded-full border-8 p-4 my-2" role="alert">
        <p>
            <b>{{ count($errors) }}件のエラーがあります。</b>
        </p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
