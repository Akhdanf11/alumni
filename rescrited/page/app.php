<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
include '../connection.php';
if (isset($_POST['submit'])) {
      $nama = $_POST['nama'];
			$tahun_dibuat = $_POST['tahun_dibuat'];
			$id = $_POST['id'];
      $mysql="UPDATE tb_aplikasi SET nama='$nama', tahun_dibuat='$tahun_dibuat' where id='$id'";
      $hasil=mysqli_query($conn, $mysql);
      if($hasil){
          // echo "Berhasil mengupdate data!";
          header('location:app.php');
      } else{
          die(mysqli_error($conn));
      }
    }
?>

<?php
  include 'meta.php';
 ?>
  <body>
  <?php
  include 'nav.php';
 ?>

<main role="main" class="col-md-9 mx-auto col-lg-10 pt-3 px-4">
          <div class="container rounded bg-dark p-md-4">
            <p class="fs-2 fw-bold text-muted text-center">INFORMATION APPLICATION</p>
            </div>

            <div class="card my-3">
            <div class="row">
               <div class="col-md-2 p-md-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="200" class="img-fluid rounded" height="200" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                  </svg>
                  <?php
                        $query = "SELECT * FROM tb_aplikasi";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>      
                </div>
                <div class="col-md-5 my-md-5">
                  <p class="fs-3 fw-bold text-uppercase"><?php echo $row['nama'];?> </p>     
                  <p class="fs-5 fw-light text-muted"><?php echo $row['tahun_dibuat'];?> </p>     
                </div>
                <div class="col-md-4">&nbsp;</div>
                <div class="col-md-1">
                  <div class="btn-toolbar mt-md-2 mb-md-0">
                    <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modal-update"><i class="fas fa-edit"></i> Edit</button>
                  </div>
                </div>
            </div>
            </div>

            <!-- modal update user -->
            <div class="example-modal">
                        <div id="modal-update" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Edit Data App</h3>
                              <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" role="form">
                                    <div class="form-floating mb-3">
                                    <input type="text" class="form-control" required name="id" id="id" readonly placeholder="id" value="<?php echo $row['id']; ?>">
                                    <label for="floatingInput">id</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama-edit-<?= $row['id']; ?>" required name="nama" id="nama" placeholder="nama" value="<?php echo $row['nama']; ?>">
                                    <label for="floatingInput">Nama Aplikasi</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="tahun_dibuat-edit-<?= $row['id']; ?>" required name="tahun_dibuat" id="tahun_dibuat" placeholder="yyyy-mm-dd" value="<?php echo $row['tahun_dibuat']; ?>">
                                        <label for="floatingInput">Tanggal Dibuat</label>
                                    </div>  
                                  <div class="modal-footer">            
                                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                    <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-check"></i> Update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal update user -->
            

        </main>
        <?php
                        }
include 'footer.php'
?>