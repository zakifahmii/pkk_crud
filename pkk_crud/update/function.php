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

function tambah($data){
    global $koneksi;
    //ambil data dari form(input)
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    $query ="INSERT INTO siswa
    VALUES (id, '$nis', '$nama', '$email', '$jurusan', '$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi); 
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yang di upload
    if ($error === 4) {
        echo "<script>
        alert('Pilihlah gambar terlebih dulu!');
        </script>";
        return false;
    }

    //cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['JPG', 'jpeg', 'png', 'jpg', 'PNG', 'JPEG'];
    $ekstensiGambar = explode('.', $namaFile);

    //fungsi explode itu string array, kalau nama filenya nama.jpg itu menjadi ['nama','jpg']
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang Anda Upload Bukan Gambar!');
        </script>";
    }
}

function hapus($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($koneksi);

}

function ubah($data)
{
    global $koneksi;

    //ambil dari data tiap elemen form
    $id = $data["id"];
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    //query insertnya
    $query = "UPDATE siswa SET
                nis = '$nis',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'

                WHERE id = $id
                 ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);

}
 ?>