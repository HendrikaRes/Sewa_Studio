@extends('admin.layouts.main')

@section('content')
<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Admin Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                        <div class="row g-0 w-100">
                            <div class="col-6">
                                <div class="p-3 m-1">
                                    <h4>Welcome Back, Admin</h4>
                                    <p class="mb-0">Admin Dashboard, {{ Auth::user()->name }}</p>
                                    <p><strong>Total =</strong>{{ $totalUsers }} users</p>
                                </div>
                            </div>
                            <div class="col-6 align-self-end text-end">
                                <img src="image/customer-support.jpg" class="img-fluid illustration-img" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h4 class="mb-2">
                                Rp{{ number_format($totalEarnings, 0, ',', '.') }}
                                </h4>
                                <p class="mb-2">
                                    Total Earnings
                                </p>
                                <div class="mb-0">
                                    <span class="badge text-success me-2">
                                        +9.0%
                                    </span>
                                    <span class="text-muted">
                                        Since Last Month
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       <!-- Table Element -->
<div class="card border-0">
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Studio Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Payment Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentHistories as $paymentHistory)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $paymentHistory->user->name }}</td>
                        <td>{{ $paymentHistory->studio->name }}</td>
                        <td>Rp{{ number_format($paymentHistory->amount, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($paymentHistory->payment_date)->format('d-m-Y H:i') }}</td>
                        <td>{{ ucfirst($paymentHistory->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    </div>
</main>
<style>
    .table-container {
    max-height: 300px; /* Sesuaikan dengan tinggi yang diinginkan */
    overflow-y: auto; /* Membuat scroll vertikal */
    overflow-x: auto; /* Membuat scroll horizontal jika diperlukan */
}
</style>
@endsection
