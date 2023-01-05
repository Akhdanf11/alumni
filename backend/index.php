<?php
	include("connection.php");

    $getAllProvinsi = mysqli_query($connection,"SELECT * FROM ec_provinces ORDER BY prov_name ASC");
?>