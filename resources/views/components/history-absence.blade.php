@props(['attendances'])

<div class="bg-white p-4 rounded-lg shadow-md">
    <h3 class="text-2xl font-bold mb-4">Riwayat Presensi</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Waktu Check In</th>
                    <th class="px-4 py-2 border">Waktu Check Out</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Alasan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $index => $attendance)
                    <tr>
                        <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border text-center">
                            {{ \Carbon\Carbon::parse($attendance->created_at)->format('d F Y') }}</td>
                        <td class="px-4 py-2 border text-center">
                            {{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i:s') : '-' }}
                        </td>
                        <td class="px-4 py-2 border text-center">
                            {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i:s') : '-' }}
                        </td>
                        <td class="px-4 py-2 border text-center">{{ $attendance->status }}</td>
                        <td class="px-4 py-2 border text-center">{{ $attendance->alasan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 border text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
