<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "2022_db_alumni";

$conn = mysqli_connect($server, $user, $pass, $database);

$getAllProvinsi = mysqli_query($conn, "SELECT * FROM ec_provinces ORDER BY prov_name ASC");
$getAllProvinsi = mysqli_query($conn,"SELECT * FROM ec_provinces ORDER BY prov_name ASC");
$getAllCompany = mysqli_query($conn,"SELECT * FROM tb_perusahaan ORDER BY nama ASC");
$getAllSkill = mysqli_query($conn,"SELECT * FROM tb_skill ORDER BY nama_skill ASC");

if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

?>
