<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <h1>Daftar Pengguna</h1>
    <button onclick="getUsers()">Muat Pengguna</button>
    <table border="1">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>Hobi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="userTable">
        </tbody>
    </table>

    <h2>Tambah Pengguna</h2>
    <form id="addUserForm">
        <input type="text" name="nik" placeholder="NIK (16 digit)" required><br>
        <input type="text" name="nama" placeholder="Nama (Huruf Kapital)" required><br>
        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" required><br>
        <input type="date" name="tanggal_lahir" required><br>
        <select name="jenis_kelamin">
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br>
        <select name="agama">
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
        </select><br>
        <textarea name="alamat" placeholder="Alamat" required></textarea><br>
        <input type="text" name="hobi" placeholder="Hobi"><br>
        <button type="submit">Tambah Pengguna</button>
    </form>

    <script>
        function getUsers() {
            $.ajax({
                url: "/api/users",
                method: "GET",
                success: function (users) {
                    let rows = "";
                    users.forEach(user => {
                        rows += `<tr>
                                    <td>${user.nik}</td>
                                    <td>${user.nama}</td>
                                    <td>${user.tempat_lahir}, ${user.tanggal_lahir}</td>
                                    <td>${user.jenis_kelamin}</td>
                                    <td>${user.agama}</td>
                                    <td>${user.alamat}</td>
                                    <td>${user.hobi || '-'}</td>
                                    <td>
                                        <button onclick="deleteUser(${user.id})">Hapus</button>
                                    </td>
                                </tr>`;
                    });
                    $("#userTable").html(rows);
                }
            });
        }

        $("#addUserForm").submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "/api/users",
                method: "POST",
                data: $(this).serialize(),
                success: function () {
                    alert("Pengguna ditambahkan!");
                    getUsers();
                }
            });
        });

        function deleteUser(id) {
            if (confirm("Yakin ingin menghapus?")) {
                $.ajax({
                    url: `/api/users/${id}`,
                    method: "DELETE",
                    success: function () {
                        alert("Pengguna dihapus!");
                        getUsers();
                    }
                });
            }
        }
    </script>

</body>

</html>