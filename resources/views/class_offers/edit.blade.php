{{-- <x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-indigo-900 shadow-md rounded-md">
        <h2 class="text-center text-lg text-white font-bold pt-6 tracking-widest">掲載情報登録</h2>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('class_offers.update', $class_offer) }}" method="POST" class="rounded pt-3 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-white mb-2" for="subject_id">
                    担当科目
                </label>
                <div
                    class="text-white border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3">
                    @foreach ($subjects as $subject)
                        <input type="radio" name="subject_id" value="{{ $subject->id }}" {{ $subject->id == old('subject_id', $class_offer->subject_id) ? "checked" : ""}}>{{ $subject->name }}
                    @endforeach
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2" for="school">
                    出身校
                </label>
                <input type="text" name="school"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    placeholder="出身校" value="{{ old('school', $class_offer->school) }}">
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2" for="money">
                    時給
                </label>
                <input type="text" name="money"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    placeholder="時給" value="{{ old('money', $class_offer->money) }}">
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2" for="area">
                    地域
                </label>
                <input type="text" name="area"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    placeholder="地域" value="{{ old('area', $class_offer->area) }}">
            </div>
            <input type="submit" value="更新"
                class="w-full flex justify-center bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
        </form>
    </div>
</x-app-layout> --}}
<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-white shadow-md rounded-md">
        <h2 class="text-center text-lg box-border h-20 w-full bg-black text-white font-bold pt-6 tracking-widest">掲載情報編集
        </h2>
    </div>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-2 px-8 bg-white shadow-md rounded-full">
        <x-validation-errors :errors="$errors" />
    </div>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-2 px-8 bg-white shadow-md rounded-md">
        <form action="{{ route('class_offers.update', $class_offer) }}" method="POST" class="rounded pt-3 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-black mb-2" for="subject_id">
                    担当科目
                </label>
                <div
                    class="text-black border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3">
                    @foreach ($subjects as $subject)
                        <input type="checkbox" class="appearance-none checked:bg-slate-900 indeterminate:bg-slate-200" name="subject_id" value="{{ $subject->id }}" {{ $subject->id == old('subject_id', $class_offer->subject_id) ? "checked" : ""}}>{{ $subject->name }}
                    @endforeach
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-black mb-2" for="school">
                    出身校
                </label>
                <input type="text" name="school"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    placeholder="出身校" value="{{ old('school', $class_offer->school) }}">
            </div>
            <div class="mb-4">
                <label class="block text-black mb-2" for="money">
                    時給
                </label>
                <input type="text" name="money"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    placeholder="時給" value="{{ old('money', $class_offer->money) }}">
            </div>
            <div class="mb-4">
                <label class="block text-black mb-2" for="area">
                    地域
                </label>
                <input type="text" name="area"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    placeholder="地域" value="{{ old('area', $class_offer->area) }}">
            </div>
            <input type="submit" value="更新"
                class="w-full flex justify-center bg-violet-500 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
        </form>
    </div>
</x-app-layout>
