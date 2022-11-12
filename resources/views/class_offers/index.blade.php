<x-app-layout>
    <div class="container mx-auto w-3/5 my-8 px-4 py-4">

        <x-flash-message :message="session('notice')" />

        <div class="flex justify-end items-center mb-3">
            <h4 class="text-gray-400 text-sm">並び替え</h4>
            <ul class="flex">
                @foreach (App\Models\ClassOffer::SORT_LIST as $value => $name)
                    <li class="ml-4">
                        <a href="{{ Request::fullUrlWithQuery(array_merge($params, ['sort' => $value, 'page' => null])) }}"
                            class="hover:text-violet-300 @if (Request::get('sort') == $value ||
                                (empty(Request::get('sort')) && App\Models\ClassOffer::SORT_NEW_ARRIVALS == $value)) text-violet-400 font-bold overline @endif">
                            {{ $name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="flex justify-between">
            <div class="w-1/6">
                <h3 class="mb-3 text-gray-400 text-sm">検索条件</h3>
                <ul>
                    <li class="mb-2">
                        <a href="{{ Request::get('sort') ? Request::fullUrlWithQuery(array_merge(Request::query(), ['subject_id' => null])) : Request::url() }}"
                            class="hover:text-violet-300 {{ Request::get('subject_id') ?: 'text-violet-400 font-bold overline' }}">
                            全て
                        </a>
                    </li>
                    @foreach ($subjects as $subject)
                        <li class="mb-2">
                            <a href="{{ Request::fullUrlWithQuery(array_merge(Request::query(), ['subject_id' => $subject->id, 'page' => null])) }}"
                                class="hover:text-violet-300 {{ Request::get('subject_id') == $subject->id ? 'text-violet-400 font-bold overline' : '' }}">
                                {{ $subject->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-full">
                @foreach ($class_offers as $class_offer)
                    <a href="{{ route('class_offers.show', $class_offer) }}"
                        class="group hover:bg-black rounded-lg ring-2 ring-inset ring-black">
                        <div class="rounded-lg bg-white flex font-sans">
                            <div class="flex-none w-56 relative">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="absolute inset-0 w-full h-full object-cover rounded-lg"
                                        src="{{ $class_offer->teacher->profile_photo_url }}"
                                        alt="{{ $class_offer->school }}" />
                                @endif
                            </div>
                            <div class="flex-auto p-6 group-hover:bg-black rounded-lg">
                                <div class="flex flex-wrap">
                                    <h1 class="flex-auto text-lg font-semibold text-slate-900">
                                        <div
                                            class="box-decoration-clone bg-black text-white text-center group-hover:text-black  group-hover:bg-white">
                                            {{ $class_offer->teacher->name }}
                                        </div>
                                    </h1>
                                    <div class="text-sm font-medium text-slate-400">
                                        <span
                                            class="group-hover:text-white font-normal ml-2">{{ $class_offer->created_at->diffForHumans() }}</span>
                                        <span class="group-hover:text-white inline-block mx-1">|</span>
                                        <span
                                            class="group-hover:text-white">{{ $class_offer->ClassOfferViews->count() }}
                                            views</span>
                                    </div>
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
</x-app-layout>
