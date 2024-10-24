@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('css')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
@stop

@section('content')
    <!-- Tampilkan Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk Tambah User Baru -->
    <a href="{{ route('master-data.create_user') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Create New User</a>

    <!-- Tabel Daftar User -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Users</h3>
        </div>
        <div class="card-body">
            <table id="userTable" class="table DataTable table-hovered table-bordered">
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
                                <a href="{{ route('master-data.edit_user', $user->id) }}" class="btn btn-warning btn-sm fas fa-edit">Edit</a>
                                
                                <form action="{{ route('master-data.delete_user', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    <i class="fa fa-trash"></i> Hapus</button>
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
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    let table = new DataTable('#userTable')
</script>
@stop
