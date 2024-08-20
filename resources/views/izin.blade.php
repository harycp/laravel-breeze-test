<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Izin Presensi') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-500 text-white p-4 mb-4 rounded-lg text-sm sm:text-base">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded-lg text-sm sm:text-base">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg">
                <h3 class="text-lg sm:text-xl font-bold mb-4">Lapor Presensi Forum Human Capital Indonesia</h3>
                <p class="text-gray-700 mb-4 text-xs sm:text-sm">Form ini digunakan untuk melaporkan kehadiran tanpa
                    check in</p>
                <form action="{{ route('presence.submit-izin') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="status"
                            class="block text-black text-sm sm:text-lg font-bold mb-2">Keterangan:</label>
                        <select id="status" name="status"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm text-sm sm:text-base">
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="alasan"
                            class="block text-black text-sm sm:text-lg font-bold mb-2">Catatan:</label>
                        <textarea id="alasan" name="alasan" rows="5"
                            class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm text-sm sm:text-base"></textarea>
                    </div>
                    <div class="flex justify-center">
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 bg-red-200 rounded-lg mr-2 text-red-500 font-bold text-xs sm:text-sm">Batal</a>
                        <button type="submit"
                            class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 font-bold text-xs sm:text-sm">Ajukan
                            Izin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
