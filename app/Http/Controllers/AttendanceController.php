<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Menampilkan view absensi di dashboard.
     */
    public function index()
    {
        // Ambil data kehadiran pengguna saat ini pada tanggal hari ini.
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->first();
    
        // Ambil data riwayat absensi pengguna
        $attendances = Attendance::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Tampilkan view dashboard dengan data kehadiran dan riwayat absensi
        return view('dashboard', compact('attendance', 'attendances'));
    }
    
    

    /**
     * Menangani aksi Clock In.
     */
    public function clockIn()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->first();
    
        if ($attendance) {
            if ($attendance->status !== 'Hadir') {
                return redirect()->back()->with('error', 'Anda tidak dapat melakukan Clock In karena sudah mengajukan izin presensi.');
            }
            return redirect()->back()->with('error', 'Anda sudah melakukan Clock In hari ini.');
        }
    
        Attendance::create([
            'user_id' => Auth::id(),
            'clock_in' => now(),
            'status' => 'Hadir',
            'alasan' => '-',
        ]);
    
        return redirect()->back()->with('success', 'Clock In berhasil.');
    }
    
    public function clockOut()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->first();
    
        if ($attendance) {
            if ($attendance->status !== 'Hadir') {
                return redirect()->back()->with('error', 'Anda tidak dapat melakukan Clock Out karena sudah mengajukan izin presensi.');
            }
    
            if (!$attendance->clock_out) {
                $attendance->update([
                    'clock_out' => now(),
                ]);
    
                return redirect()->back()->with('success', 'Clock Out berhasil.');
            }
    
            return redirect()->back()->with('error', 'Anda sudah melakukan Clock Out hari ini.');
        }
    
        return redirect()->back()->with('error', 'Anda belum melakukan Clock In hari ini.');
    }

    public function history()
    {
        // Ambil data riwayat absensi pengguna
        $attendances = Attendance::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history-absence', compact('attendances'));
    }

    public function izinForm()
    {
        return view('izin');
    }

    public function submitIzin(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'alasan' => 'required|max:255',
        ]);
    
        // Cek apakah pengguna sudah mengajukan izin presensi hari ini
        $existingIzin = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->where('status', '!=', 'Hadir')  // Cek jika bukan presensi "Hadir"
            ->first();
    
        if ($existingIzin) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan izin presensi hari ini.');
        }
    
        Attendance::create([
            'user_id' => Auth::id(),
            'status' => $request->status,
            'alasan' => $request->alasan,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Izin berhasil diajukan.');
    }
}