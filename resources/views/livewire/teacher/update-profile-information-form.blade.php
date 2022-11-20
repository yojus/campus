<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('講師プロフィール情報') }}
    </x-slot>

    <x-slot name="description">
        {{ __('講師プロフィール情報を更新する。') }}
    </x-slot>

    <x-slot name="form">
        <!-- teacher Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- teacher Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current teacher Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->teacher->profile_photo_url }}" alt="{{ $this->user->teacher->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New teacher Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->teacher->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="teacher_photo" class="mt-2" />
            </div>
        @endif

        <!-- teacher Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="teacher_name" value="{{ __('講師名') }}" />
            <x-jet-input name="teacher_name" id="teacher_name" type="text" class="mt-1 block w-full"
                wire:model.defer="state.teacher.name" autocomplete="teacher_name" />
            <x-jet-input-error for="teacher.name" class="mt-2" />
        </div>

        <!-- teacher Profile -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="teacher_profile" value="{{ __('講師紹介') }}" />
            <textarea name="teacher_profile" id="teacher_profile" cols="30" rows="5"
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                required wire:model.defer="state.teacher.profile"></textarea>
            <x-jet-input-error for="teacher.profile" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
