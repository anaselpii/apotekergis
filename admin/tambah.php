<?php
session_start();
require '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_apotek = trim($_POST['nama_apotek']);
    $alamat      = trim($_POST['alamat']);
    $desa        = trim($_POST['desa']);
    $kecamatan   = trim($_POST['kecamatan']);
    $kabupaten   = trim($_POST['kabupaten']);
    $telepon     = trim($_POST['telepon']);
    $latitude    = trim($_POST['latitude']);
    $longitude   = trim($_POST['longitude']);
    $keterangan  = trim($_POST['keterangan']);

    $stmt = mysqli_prepare($conn, "INSERT INTO apotek 
        (nama_apotek, alamat, desa, kecamatan, kabupaten, telepon, latitude, longitude, keterangan)
        VALUES (?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, 'ssssssdds',
        $nama_apotek, $alamat, $desa, $kecamatan, $kabupaten, $telepon,
        $latitude, $longitude, $keterangan
    );

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php');
        exit;
    } else {
        $msg = 'Gagal menyimpan data: ' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Apotek - SIG Apotek Lebak</title>
    <style>
        body { font-family: Arial, sans-serif; padding:20px; }
        label { display:block; margin-top:8px; }
        input[type=text], textarea {
            width:100%; padding:6px; border:1px solid #ccc; border-radius:4px;
        }
        textarea { height:70px; }
        button { margin-top:10px; padding:8px 14px; background:#198754; color:#fff;
            border:none; border-radius:4px; cursor:pointer; }
        a { text-decoration:none; color:#0d6efd; }
        .msg { color:#d00; font-size:13px; }
    </style>
</head>
<body>
<h2>Tambah Data Apotek</h2>
<?php if ($msg): ?><p class="msg"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
<form method="post">
    <label>Nama Apotek</label>
    <input type="text" name="nama_apotek" required>

    <label>Alamat Lengkap</label>
    <textarea name="alamat" required></textarea>

    <label>Desa</label>
    <input type="text" name="desa" value="Lebak" required>

    <label>Kecamatan</label>
    <input type="text" name="kecamatan" value="Pakis Aji" required>

    <label>Kabupaten</label>
    <input type="text" name="kabupaten" value="Jepara" required>

    <label>Telepon</label>
    <input type="text" name="telepon">

    <label>Latitude (contoh: -6.5740)</label>
    <input type="text" name="latitude" required>

    <label>Longitude (contoh: 110.8000)</label>
    <input type="text" name="longitude" required>

    <label>Keterangan</label>
    <textarea name="keterangan"></textarea>

    <button type="submit">Simpan</button>
    <a href="index.php">Batal</a>
</form>
</body>
</html>
