<x-app-layout>
    <div class="container mx-auto w-3/5 my-8 px-4 py-4">
        @can('teacher')
            <div class="flex justify-end items-center mb-3">
                <h4 class="text-gray-400 text-sm">並び替え</h4>
                <ul class="flex">
                    @foreach (App\Models\ClassOffer::SORT_LIST as $value => $name)
                        <li class="ml-4">
                            <a href="{{ Request::fullUrlWithQuery(array_merge($params, ['sort' => $value, 'page' => null])) }}"
                                class="hover:text-blue-500 @if (Request::get('sort') == $value ||
                                    (empty(Request::get('sort')) && App\Models\ClassOffer::SORT_NEW_ARRIVALS == $value)) text-green-500 font-bold @endif">
                                {{ $name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endcan
        <div>
            @foreach ($class_offers as $class_offer)
                <a href="{{ route('class_offers.show', $class_offer) }}"
                    class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500 group block max-w-xs mx-auto rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-sky-500 hover:ring-sky-500">
                    <div class="mt-4">
                        <div class="flex justify-between text-sm items-center mb-4">
                            <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                                {{ $class_offer->subject->name }}
                            </div>
                            <div class="text-gray-700 text-sm text-right">
                                <b>リクエスト : {{ $class_offer->requests->count() }}</b>
                                {{-- <span class="inline-block mx-1">|</span>
                                <span>{{ $class_offer->ClassOfferViews->count() }} views</span> --}}
                                {{-- <span class="inline-block mx-1">|</span>
                                <span class="font-normal ml-2">{{ $class_offer->created_at->diffForHumans() }}</span> --}}
                            </div>
                        </div>
                        </h2>
                        <div class="flex justify-between items-center">
                            <div class="mt-4 flex items-center space-x-4 py-6">
                                <div>
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ $class_offer->teacher->profile_photo_url }}"
                                            alt="{{ $class_offer->school }}" />
                                    @endif
                                </div>
                                <div class="text-sm font-semibold">
                                    {{ $class_offer->teacher->name }}
                                </div>
                                <div class="text-sm font-semibold">
                                    出身校: {{ $class_offer->school }}
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 text-md text-gray-600">
                            <span>自己紹介</span><br>{{ Str::limit($class_offer->teacher->profile, 50, '...') }}
                        </p>
                    </div>
                </a>
                <hr>
            @endforeach
            <div class="block mt-3">
                {{ $class_offers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
