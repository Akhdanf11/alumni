<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
include '../connection.php';

?>

<?php
  include 'meta.php';
 ?>
  <body>
  <?php
  include 'nav.php';
 ?>


<main role="main" class="col-md-10 mx-auto pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2 class="h2">Data skill</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target=".modal-create"><i class="fas fa-plus"></i> Tambah Data</button>
            </div>
          </div>
          <?php 
                //panggil form modals bootstrap
              include "modal-skill.php";                    
              ?>    
        </main>

<?php
include 'footer.php'
?>
