@props(['attendance'])

<div class="w-full mb-4 bg-white p-4 rounded-lg shadow-lg">
    <h3 class="text-2xl font-bold mb-2">Presensi</h3>
    <p class="text-black font-normal text-sm mb-2">
        Lakukan Check in dan Check out untuk melengkapi daftar hadir harian Anda.
    </p>
    <hr class="border-gray-300 mb-4">

    <div class="text-center">
        <p class="text-md text-gray-500 mb-2">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</p>
        <p id="current-time" class="text-3xl font-bold text-red-600 mb-4"></p>
    </div>

    <div class="flex flex-col md:flex-row justify-between gap-4 mb-4">
        <!-- Check-In Button -->
        <div class="w-full md:w-1/2 mb-4 md:mb-0">
            @if (!$attendance || !$attendance->clock_in)
                @if (!$attendance || $attendance->status === 'Hadir')
                    <form action="{{ route('presence.clock-in') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-pink-500 to-red-500 text-white py-3 px-4 rounded-lg flex flex-col items-center justify-center space-y-2 transition-transform duration-300 ease-in-out hover:bg-gradient-to-l hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <span class="text-lg font-bold">Check-In</span>
                            <span class="text-sm" id="check-in-time">00:00:00</span>
                        </button>
                    </form>
                @else
                    <button disabled
                        class="w-full bg-gray-200 text-gray-500 py-3 px-4 rounded-lg flex flex-col items-center justify-center space-y-2">
                        <span class="text-lg font-bold">Check-In</span>
                        <span class="text-sm">Izin diajukan</span>
                    </button>
                @endif
            @else
                <button disabled
                    class="w-full bg-gray-200 text-gray-500 py-3 px-4 rounded-lg flex flex-col items-center justify-center space-y-2">
                    <span class="text-lg font-bold">Check-In</span>
                    <span class="text-sm">{{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i:s') }}</span>
                </button>
            @endif
        </div>

        <!-- Check-Out Button -->
        <div class="w-full md:w-1/2">
            @if ($attendance && $attendance->clock_in && !$attendance->clock_out)
                @if ($attendance->status === 'Hadir')
                    <form action="{{ route('presence.clock-out') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 px-4 rounded-lg flex flex-col items-center justify-center space-y-2 transition-transform duration-300 ease-in-out hover:bg-gradient-to-l hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <span class="text-lg font-bold">Check-Out</span>
                            <span class="text-sm" id="check-out-time">00:00:00</span>
                        </button>
                    </form>
                @else
                    <button disabled
                        class="w-full bg-gray-200 text-gray-500 py-3 px-4 rounded-lg flex flex-col items-center justify-center space-y-2">
                        <span class="text-lg font-bold">Check-Out</span>
                        <span class="text-sm">Izin diajukan</span>
                    </button>
                @endif
            @else
                <button disabled
                    class="w-full bg-gray-200 text-gray-500 py-3 px-4 rounded-lg flex flex-col items-center justify-center space-y-2">
                    <span class="text-lg font-bold">Check-Out</span>
                    <span class="text-sm">
                        {{ $attendance && $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i:s') : '00:00:00' }}
                    </span>
                </button>
            @endif
        </div>
    </div>

    <p class="text-sm text-center text-gray-500">Tidak Hadir?
        <a href="{{ route('presence.izin') }}"
            class="text-red-500 font-semibold hover:text-red-700 hover:underline">Klik Disini</a>
    </p>
</div>

<script>
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;

        // Update button times to match the current time
        document.getElementById('check-in-time').textContent = `${hours}:${minutes}:${seconds}`;
        document.getElementById('check-out-time').textContent = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateTime, 1000);
    updateTime();
</script>
