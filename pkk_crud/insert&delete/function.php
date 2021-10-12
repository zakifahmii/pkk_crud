<?php 
//koneksi ke database

$koneksi = mysqli_connect("localhost", "root", "", "pkk");

function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    $rows = [];
    while ($sws = mysqli_fetch_assoc($result)){
        $rows[] = $sws;
    }
    return $rows;
}

function tambah($data)
{
    global $koneksi;
    //ambil data dari form(input)
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    //query insert data
    $query ="INSERT INTO siswa
    VALUES (id, '$nis', '$nama', '$email', '$jurusan', '$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);

    
    
}
function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($koneksi);

}
 ?>