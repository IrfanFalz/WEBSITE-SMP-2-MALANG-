<?php
include 'koneksi.php';

$query = $conn->query("SELECT tanggal, jumlah FROM pengunjung ORDER BY tanggal ASC");
$data = [];
while ($row = $query->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
