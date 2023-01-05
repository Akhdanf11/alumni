<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "2022_db_alumni";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

?>
