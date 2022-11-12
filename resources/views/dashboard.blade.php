<x-app-layout>
    <div class="container mx-auto w-3/5 my-8 px-4 py-4">
        <div class="flex justify-between">
            <div class="w-full">
                @foreach ($class_offers as $class_offer)
                    <a href="{{ route('class_offers.show', $class_offer) }}"
                        class="group hover:bg-black hover:ring-sky-500">
                        <div class="bg-white flex font-sans">
                            <div class="flex-none w-56 relative">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="absolute inset-0 w-full h-full object-cover rounded-lg"
                                        src="{{ $class_offer->teacher->profile_photo_url }}"
                                        alt="{{ $class_offer->school }}" />
                                @endif
                            </div>
                            <div class="flex-auto p-6 group-hover:bg-black">
                                <div class="flex flex-wrap">
                                    <h1 class="flex-auto text-lg font-semibold text-slate-900">
                                        <div
                                            class="box-decoration-clone bg-black text-white text-center group-hover:text-black  group-hover:bg-white">
                                            {{ $class_offer->teacher->name }}
                                        </div>
                                    </h1>

                                </div>
                                <div class="flex items-baseline mt-4 mb-6 pb-6 border-b border-slate-200">
                                    <div class="space-x-2 flex text-sm font-bold">
                                        @foreach ($class_offer->subjects->pluck('name') as $item)
                                            <label>
                                                <div
                                                    class="w-9 h-9 rounded-full flex items-center justify-center bg-black text-white">
                                                    <div
                                                        class="group-hover:text-black group-hover:bg-white rounded-full w-9 h-9 flex items-center justify-center">
                                                        {{-- {{ $class_offer->subjects->pluck('name')->join(', ') }} --}}
                                                        {{ $item }}
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    <div
                                        class="text-lg font-bold text-slate-900 text-violet-400 group-hover:text-white">
                                        <h1>リクエスト: {{ $class_offer->requests->count() }}件</h1>
                                    </div>
                                </div>
                                <div class="group-hover:text-white text-2xl font-semibold">
                                    出身校: {{ $class_offer->school }}
                                </div>
                                <br>
                                <div class="group-hover:text-white text-2xl font-semibold">
                                    エリア: {{ $class_offer->area }}
                                </div>
                                <p class="mt-4 text-md text-gray-600 group-hover:text-white">
                                    <span>自己紹介</span><br>{{ Str::limit($class_offer->teacher->profile, 50, '...') }}
                                </p>
                            </div>
                        </div>
                    </a>
                    <hr>
                @endforeach
                <div class="block mt-3">
                    {{ $class_offers->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
