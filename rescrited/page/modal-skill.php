<?php
include '../connection.php';
if ( isset($_POST['insert'])) {
  $nama = $_POST['nama_skill'];

  $sql = "INSERT INTO tb_skill (id_skill,nama_skill) VALUES(null,'$nama');";
  $result = mysqli_query($conn, $sql);
  echo "<script>console.log('" . $result . "')</script>";

  if ($result) {
    echo "<script>alert('Skill berhasil ditambah!')</script>";
  } else {
    echo "<script>alert('Skill gagal ditambah!')</script>";
  }

}


?>

<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead class="text-center">
                <tr>
                  <th>No.</th>
                  <th>Nama Skill</th>
                  <?php 
                    if ($_SESSION['role_user'] == 'Admin'){
                    ?>
                  <th>Aksi</th>
                  <?php
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($conn, "SELECT * FROM tb_skill");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr class="text-center">
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['nama_skill'];?></td>
                    <?php 
                    if ($_SESSION['role_user'] == 'Admin'){
                    ?>
                    <td>
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#updateskill<?php echo $no; ?>"><i class="far fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#deleteskill<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                    </td>
                    <?php
                    }
                    ?>
                  </tr>

                  <!-- modal insert -->
                  <div class="modal modal-create" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header text-center">
                          <h5 class="modal-title">Form Data</h5>
                          <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="#" id="insert">
                          <div class="form-floating mb-3">
                                <input type="text" class="form-control" required name="nama_skill" id="nama_skill" placeholder="name">
                                <label for="floatingInput">Nama SKill</label>
                            </div>
                            <div class="modal-footer">            
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                              <button type="submit" name="insert" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- modal insert close -->

                  <!-- modal delete -->
                  <div class="example-modal">
                        <div id="deleteskill<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Delete Data skill</h3>
                                <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus skill dengan nama <div class="text-uppercase uppercase">"<?php echo $row['nama_skill'];?><strong><span class="grt"></span></strong>" ?</div></h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                <button onclick="deleteData(<?= $row['id_skill']; ?>)" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Delete</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update skill -->
                      <div class="example-modal">
                        <div id="updateskill<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Edit Data skill</h3>
                              <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <form action="#" onsubmit="return editData(event, <?= $row['id_skill'] ?>);" method="post" role="form">
                                    <div class="form-floating mb-3">
                                    <input type="text" class="form-control" required name="id_skill" id="id_skill" readonly placeholder="id_skill" value="<?php echo $row['id_skill']; ?>">
                                    <label for="floatingInput">Id</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama-edit-<?= $row['id_skill']; ?>" required name="nama_skill" placeholder="nama_skill" value="<?php echo $row['nama_skill']; ?>">
                                    <label for="floatingInput">Nama Skill</label>
                                    </div>
                                  <div class="modal-footer">            
                                      <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-check"></i> Update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal update skill -->
                  <?php
                    }
                  ?>
              </tbody>
            </table>
          </div> 
        </div>

      </div>
    </div>
  </div>
</section><!-- /.content -->
</div>



<script refer>

  function deleteData(id_skill) {
    try {
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=deleteskill",
          data: {
            id_skill,
          },
          success: function(msg){
            location.reload();
          }
      });
    } catch (error) {
      console.log(error);
    }
  };

  function editData(e, id_skill) {
    try {
      e.preventDefault();
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=editskill",
          data: {
            nama_skill: $(`#nama-edit-${id_skill}`).val(),
            id_skill
          },
          success: function(msg){
            location.reload();
          }
      });
    } catch (error) {
      console.log(error);
    }
    return false;
  };
</script>