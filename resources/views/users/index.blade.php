@extends('layouts.app')

@section('content')
    <h2>Daftar Pengguna</h2>
    <a href="/register">Tambah Pengguna</a>


    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellspacing="0" cellpadding="8" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>Hobi</th>
                <th>Foto</th>
                <th>Aksi</th>
                <th>Print PDF</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->nik }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->tempat_lahir }}</td>
                    <td>{{ $user->tanggal_lahir }}</td>
                    <td>{{ $user->jenis_kelamin }}</td>
                    <td>{{ $user->agama }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>{{ json_decode($user->hobi, true) ? implode(', ', json_decode($user->hobi, true)) : '-' }}</td>
                    <td style="text-align: center;">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo"
                                style="width: 80px; height: 100px; object-fit: cover; border-radius: 5px;">
                        @else
                            Tidak Ada Foto
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" style="margin-right: 5px;">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('users.pdf', $user->id) }}" class="btn btn-primary" target="_blank">Print PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection