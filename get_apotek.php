<?php
require 'config.php';
header('Content-Type: application/json; charset=utf-8');

$data = [];
$sql  = "SELECT * FROM apotek ORDER BY nama_apotek ASC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
