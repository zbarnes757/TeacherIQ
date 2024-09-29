<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Your Teacher Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto space-y-4 max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <p>Display Name</p>
                <p>{{ $user->name }}</p>
            </div>

            <div class="flex flex-col">
                <p>Your bio</p>
                <p>{{ $profile->bio }}</p>
            </div>


            <div class="flex flex-col">
                <p>Grades Taught</p>

                <ul>
                    @foreach ($profile->grades as $grade)
                        <li>{{ $grade->name }}</li>
                    @endforeach

                </ul>
            </div>

            <div class="flex flex-col">
                <p>Subjects Taught</p>

                <ul>
                    @foreach ($profile->subjects as $subject)
                        <li>{{ $subject->name }}</li>
                    @endforeach
                </ul>

            </div>
        </div>

</x-app-layout>
