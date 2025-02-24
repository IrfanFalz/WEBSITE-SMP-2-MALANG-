<?php
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM sarpras WHERE id=$id";
mysqli_query($conn, $query);
header("Location: kelola_sarpras.php");
?>
