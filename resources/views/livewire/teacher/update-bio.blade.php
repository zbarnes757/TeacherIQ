<?php

use App\Livewire\Forms\TeacherProfileForm;
use App\Models\TeacherProfile;
use App\Models\Grade;
use App\Models\Subject;
use function Livewire\Volt\{mount, state, form};


form(TeacherProfileForm::class);

mount(function () {
    $profile = TeacherProfile::where('user_id', auth()->id())->firstOrFail();
    $this->form->setProfile($profile);
});

$updateBio = function () {
    $this->form->store();

    session()->now('flash.banner', 'Your profile has been updated!');
};

?>

<x-form-section submit="updateBio">
    <x-slot name="title">
        {{ __('Your Teacher Profile') }}
    </x-slot>

    <x-slot name="description">
        {{ __('This profile is what prospective teachers see when looking at your profile. Be descriptive 😁') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="bio" value="{{ __('Bio') }}"/>
            <x-textarea id="bio" type="text" class="block w-full mt-1" wire:model="form.bio" required/>
            <x-input-error for="bio" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="grades" value="{{ __('Grades Taught') }}"/>
            <x-select id="grades" class="block w-full mt-1" wire:model="form.grades" multiple>
                @foreach (Grade::all() as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </x-select>
            <x-input-error for="grades" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="subjects" value="{{ __('Subjects Taught') }}"/>
            <x-select id="subjects" class="block w-full mt-1" wire:model="form.subjects" multiple>
                @foreach (Subject::all() as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </x-select>
            <x-input-error for="subjects" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <label for="can_be_remote" class="flex items-center">
                <x-checkbox id="can_be_remote" name="can_be_remote" wire:model="form.can_be_remote"/>
                <span class="text-sm text-gray-600 ms-2">{{ __('Can be remote?') }}</span>
            </label>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
