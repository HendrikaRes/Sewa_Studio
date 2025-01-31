@extends('partials.main')

@section('booking')

@if($bookings->isEmpty())
<p style="padding: 20px; text-align: center; font-size: 18px; margin-top: 200px; margin-bottom: 200px;">Belum ada bookingan yang dipesan.</p>
@else

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @foreach($bookings as $booking)
        <section class="player-section set-bg" style="background-color: #0a183d;">
            <div class="player-box">
                <div class="tarck-thumb-warp">
                    <div class="tarck-thumb">
                    <img src="{{ asset($booking->studio->image_path) }}" alt="{{ $booking->studio->name }}">
                    </div>
                </div>
                <div class="wave-player-warp">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="wave-player-info">
                                <h2>{{ $booking->studio->name }}</h2>
                                <p>{{ $booking->studio->description }}</p>
                                <p><strong>Harga/Jam:</strong> Rp{{ number_format($booking->studio->price_per_hour, 0, ',', '.') }}</p>
                                <p>
                                    <strong>Durasi:</strong> 
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('d-m-Y H:i') }} - 
                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('d-m-Y H:i') }}
                                </p>

                                @php
                                    $duration = \Carbon\Carbon::parse($booking->start_time)->diffInHours(\Carbon\Carbon::parse($booking->end_time));
                                    $totalPrice = $booking->studio->price_per_hour * $duration;
                                @endphp

                                <p><strong>Total Harga:</strong> Rp{{ number_format($totalPrice, 0, ',', '.') }}</p>
                                
                                <!-- Tombol untuk membuka modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $booking->id }}">
                                    Bayar
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="songs-links">
                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="paymentModal{{ $booking->id }}" tabindex="-1" aria-labelledby="paymentModalLabel{{ $booking->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel{{ $booking->id }}">Pilih Metode Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama Studio:</strong> {{ $booking->studio->name }}</p>
                        <p><strong>Total Harga:</strong> Rp{{ number_format($totalPrice, 0, ',', '.') }}</p>
                        
                        <hr>
                        
                        <!-- Pilihan metode pembayaran -->
                        <form action="{{ route('bookings.pay', $booking->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="paymentMethod{{ $booking->id }}" class="form-label"><strong>Pilih Metode Pembayaran</strong></label>
                                <select name="payment_method" id="paymentMethod{{ $booking->id }}" class="form-select" required>
                                    <option value="bank_transfer">Transfer Bank</option>
                                    <option value="e_wallet">E-Wallet (OVO, Gopay, Dana)</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Konfirmasi & Bayar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
