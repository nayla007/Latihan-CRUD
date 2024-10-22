@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <!-- Tampilkan Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk Tambah User Baru -->
    <a href="{{ route('master-data.create_user') }}" class="btn btn-primary mb-3">Create New User</a>

    <!-- Tabel Daftar User -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Users</h3>
        </div>
        <div class="card-body">
            <table id="userTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nomor_handphone }}</td>
                            <td>
                                <a href="{{ route('master-data.edit_user', $user->id) }}" class="btn btn-warning">Edit</a>
                                
                                <form action="{{ route('master-data.delete_user', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#userTable').DataTable({
                "paging": true, // Pagination
                "searching": true, // Pencarian
                "lengthChange": false, // Menonaktifkan opsi untuk mengubah jumlah baris per halaman
                "pageLength": 10, // Menampilkan 10 baris per halaman
                "language": {
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next"
                    },
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries"
                }
            });
        });
    </script>
@stop
