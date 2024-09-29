<?php

use App\Models\TeacherProfile;
use App\Models\Grade;
use App\Models\Subject;
use function Livewire\Volt\{state, form};

$profile = TeacherProfile::where('user_id', auth()->id())->firstOrFail();
state('profile', $profile);
state('all_grades', Grade::all());
state('all_subjects', Subject::all());
state('bio', $profile->bio ?? null);
state('can_be_remote', $profile->can_be_remote ?? false);
state('selected_grades', $profile->grades->pluck('id') ?? []);
state('selected_subjects', $profile->subjects->pluck('id') ?? []);

$updateBio = function () {
    $this->profile->update([
        'bio' => $this->bio,
        'can_be_remote' => $this->can_be_remote,
    ]);

    $this->profile->grades()->sync($this->selected_grades);
    $this->profile->subjects()->sync($this->selected_subjects);

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
            <x-label for="bio" value="{{ __('Bio') }}" />
            <x-textarea id="bio" type="text" class="block w-full mt-1" wire:model="bio" required />
            <x-input-error for="bio" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="grades" value="{{ __('Grades Taught') }}" />
            <x-select id="grades" class="block w-full mt-1" wire:model="selected_grades" multiple>
                @foreach ($all_grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </x-select>
            <x-input-error for="grades" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="subjects" value="{{ __('Subjects Taught') }}" />
            <x-select id="subjects" class="block w-full mt-1" wire:model="selected_subjects" multiple>
                @foreach ($all_subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </x-select>
            <x-input-error for="subjects" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <label for="can_be_remote" class="flex items-center">
                <x-checkbox id="can_be_remote" name="can_be_remote" wire:model="can_be_remote" />
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
