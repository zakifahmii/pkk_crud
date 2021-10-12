<?php 
require 'function.php';
$siswa = query("SELECT * FROM siswa");
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Daftar siswa</h1>
    <a href="tambah.php">Tambah Siswa</a>
    <br>

    <table border="1" cellpadding="10 cellspacing="0>
        <tr>
            <td>No</td>
            <td>Aksi</td >
            <td>Gambar</td>
            <td>Nis</td>
            <td>Nama</td>
            <td>Email</td>
            <td>Jurusan</td>
        </tr>
        <?php $i = 1;?>
        <?php foreach ($siswa as $sws) :?>
            <tr>
                <td><?= $i?></td>
                <td>
                    <a href="ubah.php?id=<?=$sws["id"]?>">Ubah</a>
                    <a href="hapus.php?id=<?=$sws["id"]?>"
                    oneclick="return confirm('yakin mau dihapus');">Hapus</a>
                </td>
                <td><img src="img/<?= $sws["gambar"]?>" alt="" width="100"></td>
                <td><?=$sws["nis"] ?></td>
                <td><?=$sws["nama"] ?></td>
                <td><?=$sws["email"] ?></td>
                <td><?=$sws["jurusan"] ?></td>
            </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
    </table>
</body>
</html>