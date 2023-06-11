<?php 
header('Content-Type: application/json');

$koneksi = mysqli_connect("localhost", "root", "", "assesment3");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM produk";
    $query = mysqli_query($koneksi, $sql);
    $array_data = array();
    while ($data = mysqli_fetch_assoc($query)) {
        $array_data[] = $data;
    }
    echo json_encode($array_data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $harga_produk = $_POST['harga_produk'];
    $sql = "INSERT INTO produk (nama_produk, deskripsi_produk, harga_produk) VALUES('$nama_produk', '$deskripsi_produk', '$harga_produk')";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $sql = "DELETE FROM produk WHERE id='$id'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $nama_produk = $data['nama_produk'];
    $deskripsi_produk = $data['deskripsi_produk'];
    $harga_produk = $data['harga_produk'];

    $sql = "UPDATE produk SET nama_produk='$nama_produk', deskripsi_produk='$deskripsi_produk', harga_produk='$harga_produk' WHERE id='$id'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    $nama_produk = $data['nama_produk'];
    $deskripsi_produk = $data['deskripsi_produk'];
    $harga_produk = $data['harga_produk'];

    $sql = "UPDATE produk SET ";
    $fields = array();

    if (!empty($nama_produk)) {
        $fields[] = "nama_produk='$nama_produk'";
    }

    if (!empty($deskripsi_produk)) {
        $fields[] = "deskripsi_produk='$deskripsi_produk'";
    }

    if (!empty($harga_produk)) {
        $fields[] = "harga_produk='$harga_produk'";
    }

    $sql .= implode(', ', $fields);
    $sql .= " WHERE id='$id'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data);
    }
}
?>
