<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-white shadow-md rounded-md">
        <h2 class="text-center text-lg box-border h-20 w-full bg-black text-white font-bold font-mono pt-6 tracking-widest">掲載情報登録
        </h2>
    </div>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-2 px-8 bg-white shadow-md rounded-full font-mono">
        <x-validation-errors :errors="$errors" />
    </div>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-2 px-8 bg-white shadow-md rounded-md font-mono">
        <form action="{{ route('class_offers.store') }}" method="POST" class="rounded pt-3 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-black mb-2 font-bold" for="subject_id">
                    担当科目
                </label>
                @foreach ($subjects as $subject)
                    <div
                        class="text-black border-gray-300 focus:border-slate-900 focus:ring focus:ring-violet-600 w-full py-2 px-3">
                        <input type="checkbox" class="appearance-none checked:bg-slate-900 indeterminate:bg-slate-200"
                            name="subject_id[{{ $subject->id }}]" value="{{ $subject->id }}"
                            {{ $subject->id == old('subject_id.' . $subject->id) ? 'checked' : '' }}>{{ $subject->name }}
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <label class="block text-black mb-2 font-bold" for="school">
                    出身校
                </label>
                <input type="text" name="school"
                    class="rounded-md shadow-sm border-gray-300 focus:border-violet-300 focus:ring-2 focus:ring-violet-600 w-full py-2 px-3"
                    placeholder="出身校" value="{{ old('school') }}">
            </div>
            <div class="mb-4">
                <label class="block text-black mb-2 font-bold" for="money">
                    時給
                </label>
                <input type="text" name="money"
                    class="rounded-md shadow-sm border-gray-300 focus:border-violet-300 focus:ring-2 focus:ring-violet-600 w-full py-2 px-3"
                    placeholder="時給" value="{{ old('money') }}">
            </div>
            <div class="mb-4">
                <label class="block text-black mb-2 font-bold" for="area">
                    地域
                </label>
                <input type="text" name="area"
                    class="rounded-md shadow-sm border-gray-300 focus:border-violet-300 focus:ring-2 focus:ring-violet-600 w-full py-2 px-3"
                    placeholder="地域" value="{{ old('area') }}">
            </div>
            <input type="submit" value="登録"
                class="w-full flex justify-center bg-violet-500 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
        </form>
    </div>
</x-app-layout>
