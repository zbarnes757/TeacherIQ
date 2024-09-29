<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Your Teacher Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto space-y-4 max-w-7xl sm:px-6 lg:px-8">
            @livewire('teacher.update-bio')
        </div>
    </div>
</x-app-layout>
