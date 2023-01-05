<?php
include '../connection.php';
if ( isset($_POST['insert'])) {
  $id_skill = $_POST['id_skill'];
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis_perusahaan'];

  $sql = "INSERT INTO tb_perusahaan (id_perusahaan,id_skill,nama,jenis_perusahaan) VALUES(null,'$id_skill','$nama','$jenis');";
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
                  <th>Nama Perusahaan</th>
                  <th>Jenis Perusahaan</th>
                  <th>Skill</th>
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
                    // $queryview = mysqli_query($conn, "SELECT * FROM tb_perusahaan");
                    
                    // $queryview = mysqli_query($conn, "SELECT ec_datalumni.data_nama,ec_datalumni.data_id, ec_provinces.prov_name, ec_cities.city_name, ec_districts.dis_name, ec_subdistricts.subdis_name  FROM ec_datalumni,ec_provinces,ec_cities,ec_districts,ec_subdistricts WHERE  ec_datalumni.prov_id = ec_provinces.prov_id && ec_datalumni.city_id = ec_cities.city_id && ec_datalumni.dis_id = ec_districts.dis_id && ec_datalumni.subdis_id = ec_subdistricts.subdis_id;");
                    $queryview = mysqli_query($conn, "SELECT tb_perusahaan.id_perusahaan,tb_perusahaan.nama,tb_perusahaan.jenis_perusahaan,tb_skill.nama_skill,tb_skill.id_skill FROM tb_perusahaan,tb_skill where tb_perusahaan.id_skill = tb_skill.id_skill");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                    // while ($row1 = mysqli_fetch_assoc($queryview1)) {
                      $getAllSkill = mysqli_query($conn,"SELECT * FROM tb_skill ORDER BY nama_skill ASC");
                      $getSkill = mysqli_query($conn,"SELECT * FROM tb_skill ORDER BY nama_skill ASC");
                  ?>
                  <tr class="text-center">
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['nama'];?></td>
                    <td><?php echo $row['jenis_perusahaan'];?></td>
                    <td><?php echo $row['nama_skill'];?></td>
                    <?php 
                    if ($_SESSION['role_user'] == 'Admin'){
                    ?>
                    <td>
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#updateperusahaan<?php echo $no; ?>"><i class="far fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#deletesperusahaan<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                    </td>
                    <?php
                    }
                    ?>
                  </tr>

                  

                  <!-- modal delete -->
                  <div class="example-modal">
                        <div id="deletesperusahaan<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Delete Data skill</h3>
                                <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus skill dengan nama <div class="text-uppercase uppercase">"<?php echo $row['nama'];?><strong><span class="grt"></span></strong>" ?</div></h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                <button onclick="deleteData(<?= $row['id_perusahaan']; ?>)" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Delete</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update perusahaan -->
                      <div class="example-modal">
                        <div id="updateperusahaan<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Edit Data perusahaan</h3>
                              <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <form action="#" onsubmit="return editData(event, <?= $row['id_perusahaan'] ?>);" method="post" role="form">
                                    <div class="form-floating mb-3">
                                    <input type="text" class="form-control" required name="id_perusahaan" id="id_perusahaan" readonly placeholder="id_perusahaan" value="<?php echo $row['id_perusahaan']; ?>">
                                    <label for="floatingInput">Id Perusahaan</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="jenis_perusahaan" class="form-select" id="jenis_perusahaan-edit-<?= $row['id_perusahaan']; ?>" aria-label="Floating label select example">
                                          <option selected ><?php echo $row['jenis_perusahaan']; ?></option>
                                          <option value="negeri">negeri</option>
                                          <option value="swasta">swasta</option>
                                        </select>
                                        <label for="floatingSelect">Jenis Perusahaaan</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="id_skill" class="form-select" id="id_skill-edit-<?= $row['id_perusahaan']; ?>" aria-label="Floating label select example">
                                          <option selected ><?php echo $row['nama_skill']; ?></option>
                                            <?php while($rs_skill = mysqli_fetch_assoc($getAllSkill)): ?>
                                                <option value="<?php echo $rs_skill['id_skill']; ?>"><?php echo $rs_skill['nama_skill'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <label for="floatingSelect">Jenis</label>
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
                      </div>
                      <!-- modal update user -->
                  <?php
                    // }
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
                                <input type="text" class="form-control" required name="nama" id="nama" placeholder="name">
                                <label for="floatingInput">Nama Perusahaan</label>
                            </div>
                            <div class="form-floating">
                            <select class="form-select" id="floatingSelect" name="jenis_perusahaan" id="jenis_perusahaan" aria-label="Floating label select example">
                              <option selected>- Pilih jenis perusahaan -</option>
                              <option value="negeri">Negeri</option>
                              <option value="swasta">Swasta</option>
                            </select>
                            <label for="floatingSelect">Jenis Perusahaan</label>
                          </div> 
                           
                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Skill:</label>
                                <select class="form-control w-100 " name="id_skill" id="id_skill">
                                    <?php while($rs_skill = mysqli_fetch_assoc($getSkill)): ?>
                                        <option value="<?php echo $rs_skill['id_skill']; ?>"><?php echo $rs_skill['nama_skill']; ?></option>
                                    <?php endwhile; ?>
                                </select>
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
<script refer>

  function deleteData(id_perusahaan) {
    try {
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=deleteperusahaan",
          data: {
            id_perusahaan,
          },
          success: function(msg){
            location.reload();
          }
      });
    } catch (error) {
      console.log(error);
    }
  };

  function editData(e, id_perusahaan) {
    try {
      e.preventDefault();
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=editperusahaan",
          data: {
            jenis_perusahaan: $(`#jenis_perusahaan-edit-${id_perusahaan}`).val(),
            id_skill: $(`#id_skill-edit-${id_perusahaan}`).val(),
            id_perusahaan,

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