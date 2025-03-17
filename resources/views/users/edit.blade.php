@extends('layouts.app')

@section('content')
    <h2>Edit Pengguna</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>NIK:</label>
        <input type="text" name="nik" value="{{ $user->nik }}" required><br>

        <label>Nama:</label>
        <input type="text" name="nama" value="{{ $user->nama }}" required><br>

        <label>Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" value="{{ $user->tempat_lahir }}" required><br>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}" required><br>

        <label>Jenis Kelamin:</label>
        <input type="radio" name="jenis_kelamin" value="Laki-Laki" {{ $user->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }}>
        Laki-Laki
        <input type="radio" name="jenis_kelamin" value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
        Perempuan<br>

        <label>Agama:</label>
        <select name="agama" required>
            <option value="Islam" {{ $user->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
            <option value="Kristen" {{ $user->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
            <option value="Hindu" {{ $user->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
            <option value="Buddha" {{ $user->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
        </select><br>

        <label>Alamat:</label>
        <textarea name="alamat" required>{{ $user->alamat }}</textarea><br>

        <label>Hobi:</label>
        @php $userHobi = json_decode($user->hobi, true) @endphp
        <input type="checkbox" name="hobi[]" value="Membaca" {{ in_array('Membaca', $userHobi) ? 'checked' : '' }}> Membaca
        <input type="checkbox" name="hobi[]" value="Olahraga" {{ in_array('Olahraga', $userHobi) ? 'checked' : '' }}>
        Olahraga
        <input type="checkbox" name="hobi[]" value="Musik" {{ in_array('Musik', $userHobi) ? 'checked' : '' }}> Musik
        <input type="checkbox" name="hobi[]" value="Menulis" {{ in_array('Menulis', $userHobi) ? 'checked' : '' }}>
        Menulis<br>

        <label for="photo">Upload Photo:</label>
        <input type="file" name="photo" accept="image/*">
        <button type="submit">Submit</button>

        <button type="submit">Update</button>
    </form>
@endsection