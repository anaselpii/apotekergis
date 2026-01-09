<?php
session_start();
require '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM apotek ORDER BY nama_apotek ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - SIG Apotek Lebak</title>
    <style>
        body { font-family: Arial, sans-serif; margin:0; }
        header {
            background:#198754; color:#fff; padding:10px 20px;
            display:flex; justify-content:space-between; align-items:center;
        }
        header h1 { margin:0; font-size:18px; }
        header .right a { color:#fff; margin-left:10px; text-decoration:none; }
        main { padding:20px; }
        table { width:100%; border-collapse:collapse; font-size:13px; }
        th, td { border:1px solid #ddd; padding:6px 8px; }
        th { background:#f0f0f0; }
        a.btn { padding:4px 8px; border-radius:3px; font-size:12px; text-decoration:none; }
        .btn-tambah { background:#0d6efd; color:#fff; }
        .btn-edit { background:#ffc107; color:#000; }
        .btn-hapus { background:#dc3545; color:#fff; }
    </style>
</head>
<body>
<header>
    <h1>Admin - SIG Apotek Desa Lebak</h1>
    <div class="right">
        <?= htmlspecialchars($_SESSION['admin_nama']) ?>
        <a href="logout.php">Logout</a>
        <a href="../index.php" target="_blank">Lihat Peta</a>
    </div>
</header>
<main>
    <p>
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Apotek</a>
    </p>
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Apotek</th>
            <th>Alamat</th>
            <th>Desa</th>
            <th>Koordinat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_apotek']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?= htmlspecialchars($row['desa']) ?></td>
                <td><?= $row['latitude'] . ', ' . $row['longitude'] ?></td>
                <td><?= htmlspecialchars($row['telepon']) ?></td>
                <td>
                    <a class="btn btn-edit" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="btn btn-hapus" href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>
</body>
</html>
