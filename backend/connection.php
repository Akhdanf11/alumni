<?php
  $connection = mysqli_connect("localhost", "root", "", "2022_db_alumni");
  if (mysqli_connect_errno())  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>