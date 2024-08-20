<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Left Column: Profile and Presence -->
                    <div class="w-full md:w-1/3 flex flex-col gap-4">
                        <x-profile></x-profile>
                        <x-presence :attendance="$attendance"></x-presence>
                    </div>

                    <!-- Right Column: History Absence -->
                    <div class="w-full md:w-2/3">
                        <x-history-absence :attendances="$attendances"></x-history-absence>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
