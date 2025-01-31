@extends('admin.layouts.main')

@section('studio')
<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-header">
                <h5 class="card-title">
                    Daftar Studio
                </h5>
                <h6 class="card-subtitle text-muted">
                    Daftar studio yang tersedia di website
                </h6>
            </div>
            <a href="/tambahstudio" class="btn btn-primary btn-tambah-studio">
                Tambah Studio
            </a>
            <div class="card-body">
                <!-- Wrapper dengan Bootstrap untuk scroll di layar kecil -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Studio</th>
                                <th>Deskripsi</th>
                                <th>Fasilitas</th>
                                <th>Harga per Jam</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studios as $studio)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $studio->name }}</td>
                                <td>{{ $studio->description }}</td>
                                <td>{{ $studio->facilities }}</td>
                                <td>{{ $studio->price_per_hour }}</td>
                                <td>
                                    <img src="{{ asset($studio->image_path) }}" alt="{{ $studio->name }}" width="50" height="50">
                                </td>
                                <td>
                                    <button 
                                        class="btn btn-warning btn-sm edit-button" 
                                        data-id="{{ $studio->id }}" 
                                        data-name="{{ $studio->name }}" 
                                        data-description="{{ $studio->description }}" 
                                        data-facilities="{{ $studio->facilities }}" 
                                        data-price="{{ $studio->price_per_hour }}" 
                                        data-image="{{ asset('storage/' . $studio->image_path) }}"
                                        data-toggle="modal" 
                                        data-target="#editStudioModal">
                                        Edit
                                    </button>
                                    <form method="POST" action="/hapusstudio/{{ $studio->id }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus studio ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Akhir table-responsive -->
            </div>
        </div>
    </div>
</main>


<!-- Modal Edit Studio -->
<div class="modal fade" id="editStudioModal" tabindex="-1" role="dialog" aria-labelledby="editStudioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudioModalLabel">Edit Studio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editStudioForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="editName">Nama Studio</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="editDescription">Deskripsi</label>
                        <textarea name="description" id="editDescription" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="editFacilities">Fasilitas</label>
                        <input type="text" name="facilities" id="editFacilities" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="editPrice">Harga per Jam</label>
                        <input type="number" name="price_per_hour" id="editPrice" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="editImage">Gambar</label><br>
                        <img id="editPreviewImage" src="" alt="Studio Image" width="100" class="mb-2">
                        <input type="file" name="image" id="editImage" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success" id="saveEditButton">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
                <style>

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ccc;
       
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #4CAF50;
        outline: none;
    }

    .btn-tambah-studio {
        padding: 10px 10px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
    }

    .btn-success {
        background-color: #4CAF50;
        color: white;
        border: none;
    }

    .btn-success:hover {
        background-color: #45a049;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Saat tombol edit ditekan
        $('.edit-button').on('click', function() {
            // Ambil data dari tombol
            const id = $(this).data('id');
            const name = $(this).data('name');
            const description = $(this).data('description');
            const facilities = $(this).data('facilities');
            const price = $(this).data('price');
            const image = $(this).data('image');

            // Isi form di modal
            $('#editName').val(name);
            $('#editDescription').val(description);
            $('#editFacilities').val(facilities);
            $('#editPrice').val(price);
            $('#editPreviewImage').attr('src', image);

            // Ubah action form
            $('#editStudioForm').attr('action', `/editstudio/${id}`);
        });

        // Simpan perubahan saat tombol Simpan ditekan
        $('#saveEditButton').on('click', function() {
            $('#editStudioForm').submit();
        });
    });
</script>


@endsection
