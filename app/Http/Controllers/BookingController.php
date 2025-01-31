<?php

namespace App\Http\Controllers;

use App\Models\PaymentHistory;
use Carbon\Carbon;
use App\Models\Studio;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        // Menghapus booking yang sudah lewat
        Booking::where('end_time', '<', now())->delete();
    
        // Memuat kembali data terbaru
        $bookings = Booking::with(['studio', 'user'])
            ->where('user_id', auth()->id())
            ->get();
    
        return view('booking', compact('bookings'));
    }
    

    public function pay($bookingId)
    {
        // Cek apakah booking dengan ID tersebut ada
        $booking = Booking::find($bookingId);
        
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan!');
        }
    
        // Menghitung durasi dalam jam
        $startTime = \Carbon\Carbon::parse($booking->start_time);
        $endTime = \Carbon\Carbon::parse($booking->end_time);
        $duration = $startTime->diffInHours($endTime); // Menghitung durasi dalam jam
    
        // Jika durasi kurang dari 1 jam, set minimal 1 jam (untuk menghindari pembayaran 0)
        if ($duration < 1) {
            $duration = 1;
        }
    
        // Proses pembayaran dan simpan ke riwayat pembayaran
        $paymentHistory = new PaymentHistory();
        $paymentHistory->user_id = $booking->user_id;
        $paymentHistory->studio_id = $booking->studio_id;
        $paymentHistory->amount = $booking->studio->price_per_hour * $duration; // Hitung jumlah berdasarkan durasi
        $paymentHistory->payment_date = Carbon::now();
        $paymentHistory->status = 'paid'; // Menandakan pembayaran berhasil
        $paymentHistory->save();
    
        // Hapus data booking dari tabel bookings
        $booking->delete();
    
        return redirect()->route('bookings.index')->with('success', 'Pembayaran berhasil! ');
    }
    


    public function showDashboard()
    {
        // Mengambil riwayat pembayaran dengan relasi studio
        $paymentHistories = PaymentHistory::with('studio')->get();

        // Menghitung total jumlah user
        $totalUsers = User::count();
        $totalEarnings = PaymentHistory::sum('amount'); // Menghitung total pendapatan

        // Mengirimkan data ke view admin.dashboard
          // Mengirimkan data ke view admin.dashboard
    return view('admin.dashboard', compact('paymentHistories', 'totalUsers', 'totalEarnings'));
    }

}
