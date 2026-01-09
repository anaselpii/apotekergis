<?php
// admin/hapus.php
session_start();
require '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    mysqli_query($conn, "DELETE FROM apotek WHERE id = $id");
}
header('Location: index.php');
exit;
