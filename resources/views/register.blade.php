<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
</head>

<style>
    form {
        width: 300px;
    }

    div {
        margin-bottom: 10px;
    }
</style>

<body>
    <h2>Form Registrasi</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>NIK</label>
            <input type="text" name="nik" value="{{ old('nik') }}" required>
            @error('nik') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required>
            @error('nama') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
            @error('tempat_lahir') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
            @error('tanggal_lahir') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Jenis Kelamin</label>
            <input type="radio" name="jenis_kelamin" value="Laki-Laki" required> Laki-Laki
            <input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan
            @error('jenis_kelamin') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Agama</label>
            <select name="agama" required>
                <option value="">Pilih Agama</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
            @error('agama') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="alamat" required>{{ old('alamat') }}</textarea>
            @error('alamat') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Hobi</label>
            <input type="checkbox" name="hobi[]" value="Membaca"> Membaca
            <input type="checkbox" name="hobi[]" value="Olahraga"> Olahraga
            <input type="checkbox" name="hobi[]" value="Musik"> Musik
            <input type="checkbox" name="hobi[]" value="Menulis"> Menulis
        </div>
        <div> <label for="photo">Upload Photo:</label>
            <input type="file" name="photo" accept="image/*">
        </div>
        <button type="submit">Submit</button>
    </form>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif


    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
</body>

</html>