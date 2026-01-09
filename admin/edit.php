<?php
session_start();
require '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$id = intval($_GET['id'] ?? 0);
$sql = "SELECT * FROM apotek WHERE id = $id";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($res);

if (!$data) {
    die('Data tidak ditemukan');
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

    $stmt = mysqli_prepare($conn, "UPDATE apotek SET 
        nama_apotek=?, alamat=?, desa=?, kecamatan=?, kabupaten=?, telepon=?, latitude=?, longitude=?, keterangan=?
        WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'ssssssddsi',
        $nama_apotek, $alamat, $desa, $kecamatan, $kabupaten, $telepon,
        $latitude, $longitude, $keterangan, $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php');
        exit;
    } else {
        $msg = 'Gagal mengupdate data: ' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Apotek - SIG Apotek Lebak</title>
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
<h2>Edit Data Apotek</h2>
<?php if ($msg): ?><p class="msg"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
<form method="post">
    <label>Nama Apotek</label>
    <input type="text" name="nama_apotek" value="<?= htmlspecialchars($data['nama_apotek']) ?>" required>

    <label>Alamat Lengkap</label>
    <textarea name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>

    <label>Desa</label>
    <input type="text" name="desa" value="<?= htmlspecialchars($data['desa']) ?>" required>

    <label>Kecamatan</label>
    <input type="text" name="kecamatan" value="<?= htmlspecialchars($data['kecamatan']) ?>" required>

    <label>Kabupaten</label>
    <input type="text" name="kabupaten" value="<?= htmlspecialchars($data['kabupaten']) ?>" required>

    <label>Telepon</label>
    <input type="text" name="telepon" value="<?= htmlspecialchars($data['telepon']) ?>">

    <label>Latitude</label>
    <input type="text" name="latitude" value="<?= $data['latitude'] ?>" required>

    <label>Longitude</label>
    <input type="text" name="longitude" value="<?= $data['longitude'] ?>" required>

    <label>Keterangan</label>
    <textarea name="keterangan"><?= htmlspecialchars($data['keterangan']) ?></textarea>

    <button type="submit">Update</button>
    <a href="index.php">Batal</a>
</form>
</body>
</html>
