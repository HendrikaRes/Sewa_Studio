@extends('admin.layouts.main')

@section('tambahstudio')

<main class="content px-3 py-2">
                <div class="container-fluid"> 
                <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Tambah Studio
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                Tambahkan studio baru ke dalam daftar studio yang tersedia di website
                            </h6>
                        </div>
                        <div class="card-body">
                        <form method="POST" action="/tambahstudio" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Studio</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="facilities">Fasilitas</label>
                        <input type="text" name="facilities" id="facilities" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="price_per_hour">Harga per Jam</label>
                        <input type="number" name="price_per_hour" id="price_per_hour" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
                        </div>
                    </div>
                </div>
                </main>
@endsection
