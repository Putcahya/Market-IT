<?php
include '../../koneksi.php';
$id = intval($_GET['id']);
mysqli_query($conn, "UPDATE hub_kami SET status=1 WHERE id=$id");
header("Location: ../pesan.php");
exit;