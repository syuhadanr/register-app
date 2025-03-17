@extends('layouts.app')

@section('content')
    <h2>Daftar Pengguna</h2>
    <a href="{{ route('users.create') }}">Tambah Pengguna</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ddd;">
                <th style="border: 1px solid #ddd; padding: 8px;">NIK</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Nama</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Tempat Lahir</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Tanggal Lahir</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Jenis Kelamin</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Agama</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Alamat</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Hobi</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Foto</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Aksi</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Print PDF</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->nik }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->nama }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->tempat_lahir }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->tanggal_lahir }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->jenis_kelamin }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->agama }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $user->alamat }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        {{ json_decode($user->hobi, true) ? implode(', ', json_decode($user->hobi, true)) : '-' }}
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo"
                                style="width: 80px; height: 100px; object-fit: cover; border-radius: 5px;">
                        @else
                            Tidak Ada Foto
                        @endif
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <a href="{{ route('users.edit', $user->id) }}" style="margin-right: 5px;">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <a href="{{ route('users.pdf', $user->id) }}" class="btn btn-primary" target="_blank">Print PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection