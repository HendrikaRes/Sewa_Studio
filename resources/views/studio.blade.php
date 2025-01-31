@extends('partials.main')

@section('studios')
<!-- Playlist section -->

   <!-- Tampilkan Pesan Error -->
    
   @if(isset($error))
            <div style="padding: 50px;" class="alert alert-danger">
                {{ $error }}
            </div>
        @endif

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="playlist-section spad">
		<div class="container-fluid">
			<div class="section-title">
				<h2>Studio</h2>
			</div>
			<div class="container">
			
			</div>                                              
			<div class="clearfix"></div>
			<div class="row playlist-area">
            @foreach ($studios as $studio)
        <div class="col-lg-3 col-md-4 col-sm-6 genres">
            <div class="playlist-item">
                <!-- Studio Image -->
                <img src="{{ asset($studio->image_path) }}" alt="{{ $studio->name }}" class="img-fluid">

                
                <!-- Studio Information -->
                <h5>{{ $studio->name }}</h5>
                <p>{{ $studio->description }}</p>
                <p><strong>Kelengkapan:</strong> {{ $studio->facilities }}</p>
                <p><strong>Harga/Jam:</strong> Rp{{ number_format($studio->price_per_hour, 0, ',', '.') }}</p>
                
                <!-- Booking Button -->
                @if(Auth::check() && Auth::user()->role == 'user') 
    <a href="#bookingModal{{ $studio->id }}" data-toggle="modal" class="btn btn-primary">Pesan</a>
@endif

                
                <!-- Booking Progress -->
                <div class="progress mt-3">
                    @php
                    $now = now();
                    $total = 24 * 60; // Total menit dalam sehari
                    $booked = $studio->bookings->map(function ($booking) use ($now) {
                        $start = \Carbon\Carbon::parse($booking->start_time);
                        $end = \Carbon\Carbon::parse($booking->end_time);
                        return [
                            'start' => $start->diffInMinutes($now),
                            'end' => $end->diffInMinutes($now)
                        ];
                    });

                    @endphp
                    @foreach ($booked as $slot)
                    <div class="progress-bar bg-danger" style="width: {{ ($slot['end'] - $slot['start']) / $total * 100 }}%;"></div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Booking Modal -->
<div class="modal fade" id="bookingModal{{ $studio->id }}" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel{{ $studio->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('studios.book', $studio->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel{{ $studio->id }}">Pesan Studio {{ $studio->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Booking Form -->
                    <div class="form-group">
                        <label for="user_name_{{ $studio->id }}">Nama</label>
                        <!-- Menampilkan nama pengguna yang sedang login -->
                        <input type="text" id="user_name_{{ $studio->id }}" name="user_name" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    </div>

                    <div class="form-group">
                        <label for="start_time_{{ $studio->id }}">Mulai</label>
                        <input type="datetime-local" id="start_time_{{ $studio->id }}" name="start_time" class="form-control" required>
                        
                        <!-- Menampilkan pesan error untuk start_time -->
                        @error('start_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="end_time_{{ $studio->id }}">Selesai</label>
                        <input type="datetime-local" id="end_time_{{ $studio->id }}" name="end_time" class="form-control" required>
                        
                        <!-- Menampilkan pesan error untuk end_time -->
                        @error('end_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Pesan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
<script>
    @if(session('success'))
        $('#bookingModal{{ $studio->id }}').modal('hide');
    @endif
</script>

			</div>
		</div>
	</section>
	<!-- Playlist section end -->
@endsection

