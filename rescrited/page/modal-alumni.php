<?php 
  include '../connection.php';
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
                  <th>Nama</th>
                  <th>Skill</th>
                  <th>email</th>
                  <th>telp</th>
                  <th>Perusahan</th>
                  <th>Provinsi</th>
                  <th>Kota</th>
                  <th>Kecamatan</th>
                  <th>Desa</th>
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
                    $queryview = mysqli_query($conn, "SELECT ec_datalumni.data_nama, ec_datalumni.data_id, ec_provinces.prov_name, ec_cities.city_name, ec_districts.dis_name, ec_subdistricts.subdis_name,tb_contact.id_contact,tb_contact.email,tb_contact.no_telp, tb_skill.nama_skill,tb_skill.id_skill, tb_perusahaan.id_perusahaan,tb_perusahaan.nama  FROM ec_datalumni,ec_provinces,ec_cities,ec_districts,ec_subdistricts,tb_perusahaan,tb_skill,tb_contact WHERE  ec_datalumni.prov_id = ec_provinces.prov_id && ec_datalumni.city_id = ec_cities.city_id && ec_datalumni.dis_id = ec_districts.dis_id && ec_datalumni.subdis_id = ec_subdistricts.subdis_id  && ec_datalumni.id_perusahaan = tb_perusahaan.id_perusahaan && ec_datalumni.id_skill = tb_skill.id_skill && ec_datalumni.id_contact = tb_contact.id_contact;");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                      $getAllProvinsi = mysqli_query($conn,"SELECT * FROM ec_provinces ORDER BY prov_name ASC");
                      $getAllCompany = mysqli_query($conn,"SELECT * FROM tb_perusahaan ORDER BY nama ASC");
                      $getAllSkill = mysqli_query($conn,"SELECT * FROM tb_skill ORDER BY nama_skill ASC");

                  ?>
                  <tr class="text-center">
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['data_nama'];?></td>
                    <td><?php echo $row['nama_skill'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['no_telp'];?></td>
                    <td><?php echo $row['nama'];?></td>
                    <td><?php echo $row['prov_name'];?></td>
                    <td><?php echo $row['city_name'];?></td>
                    <td><?php echo $row['dis_name'];?></td>
                    <td><?php echo $row['subdis_name'];?></td>
                    <?php 
                    if ($_SESSION['role_user'] == 'Admin'){
                    ?>
                    <td>
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#updatealumni<?php echo $no; ?>"><i class="far fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#deletealumni<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
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
                          <form method="POST" action="#" id='insert'>
                            <div class="form-group">
                              <label for="name">Nama</label>
                              <input type="text" class="form-control" id="data-alumni" placeholder="Masukkan alumni">            
                            </div>
                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Perusahaan :</label>
                                <select class="form-control w-100 " name="id_perusahaan" id="id_perusahaan">
                                    <?php while($rs_company = mysqli_fetch_assoc($getAllCompany)): ?>
                                        <option value="<?php echo $rs_company['id_perusahaan']; ?>"><?php echo $rs_company['nama']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Skill :</label>
                                <select class="form-control w-100 " name="id_skill" id="id_skill">
                                    <?php while($rs_skill = mysqli_fetch_assoc($getAllSkill)): ?>
                                        <option value="<?php echo $rs_skill['id_skill']; ?>"><?php echo $rs_skill['nama_skill']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Contact Person :</label>
                                <div class="row">
                                  <div class="col-md-6">
                                      <input type="email" class="form-control" id="email" name="email" placeholder="mail@mail.com">            
                                  </div>
                                  <div class="col-md-6">
                                      <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="+62xxxxxxxxx">            
                                  </div>
                                </div>
                            </div>

                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Provinsi:</label>
                                <select class="form-control w-100 " name="provinsi" id="provinsi">
                                    <?php while($rs_provinsi = mysqli_fetch_assoc($getAllProvinsi)): ?>
                                        <option value="<?php echo $rs_provinsi['prov_id']; ?>"><?php echo $rs_provinsi['prov_name']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <img src="asset/img/loading.gif" width="35" id="load1" style="display:none;" />
                            </div>
                            
                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Kota/Kabupaten:</label>
                                <select class="form-select"name="kota" id="kota" aria-label="Floating label select example"></select>
                                <img src="asset/img/loading.gif" width="35" id="load2" style="display:none;" />
                            </div>

                            <!-- Kecamatan -->
                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Kecamatan:</label>
                                <select class="form-select"name="kecamatan" id="kecamatan" aria-label="Floating label select example"></select>
                                <img src="asset/img/loading.gif" width="35" id="load2" style="display:none;" />
                            </div>

                            <!-- Desa -->
                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Desa:</label>
                                <select class="form-select"name="desa" id="desa" aria-label="Floating label select example"></select>
                                <img src="asset/img/loading.gif" width="35" id="load2" style="display:none;" />
                            </div>

                          </div>
                            <div class="modal-footer">            
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                              <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                  <!-- modal insert close -->


                    <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deletealumni<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Delete Data alumni</h3>
                                <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus alumni dengan nama <div class="text-uppercase uppercase">"<?php echo $row['data_nama'];?><strong><span class="grt"></span></strong>" ?</div></h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                <button onclick="deleteData(<?= $row['data_id']; ?>)" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Delete</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- modal delete -->

                      <!-- modal update alumni -->
                      <div class="example-modal">
                        <div id="updatealumni<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Edit Data alumni</h3>
                              <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <form action="#" onsubmit="return editData(event, <?= $row['data_id'] ?>);" method="post" role="form">
                                  <?php
                                  include("../../backend/index.php");
                                  $data_id = $row['data_id'];
                                  $query = "SELECT * FROM ec_datalumni WHERE data_id='$data_id'";
                                  $result = mysqli_query($conn, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label text-right">data_id <span class="text-red">*</span></label>         
                                      <input type="text" class="form-control" name="data_id" placeholder="data_id" readonly value="<?php echo $row['data_id']; ?>">
                                    </div>
                                  <div class="form-group">
                                    <label for="name">nama</label>
                                    <input type="text" class="form-control" id="nama-edit-<?= $row['data_id']; ?>" placeholder="Masukkan nama" value="<?php echo $row['data_nama']; ?>">            
                                  </div>   
                                  <div class="modal-footer">            
                                      <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-check"></i> Update</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- modal update alumni -->
                      
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
  $('#provinsi').select2({
      placeholder: 'Pilih Provinsi',
      language: "id"
  });
  $('#kota').select2({
      placeholder: 'Pilih Kota/Kabupaten',
      language: "id"
  });
  $('#kecamatan').select2({
      placeholder: 'Pilih Kecamatan',
      language: "id"
  });
  $('#desa').select2({
      placeholder: 'Pilih Desa',
      language: "id"
  });

  $("#provinsi").change(getKota);
  $("#kota").change(getKecamatan);
  $("#kecamatan").change(getDesa);

  function getDesa() {
    try {
      $("img#load2").show();
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=desa",
          data: "id_dis="+$('#kecamatan').val(),
          success: function(msg){
            $("img#load2").hide();
            $("select#desa").html(msg);
          }
      });
    } catch (error) {
      console.log(error);
    }
  }

  function getKecamatan() {
    try {
      $("img#load2").show();
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=kec",
          data: "id_regencies="+$('#kota').val(),
          success: function(msg){
            $("img#load2").hide();
            $("select#kecamatan").html(msg);
            getDesa();
          }
      });
    } catch (error) {
      console.log(error);
    }
  }

  function getKota() {
    $("img#load1").show();

    try {
      var id_provinces = $(this).val(); 
    } catch (error) {
      var id_provinces = 1; 
    }

    $.ajax({
      type: "POST",
      dataType: "html",
      url: "../../backend/api.php?jenis=kota",
      data: "id_provinces="+id_provinces,
      success: function(msg){
        $("select#kota").html(msg);                                                       
        $("img#load1").hide();
        getKecamatan();
      }
    }); 
  }

  getKota();

  $('#insert').submit((e) => {
    try {
      e.preventDefault();

      $("img#load2").show();
      var city = $("#kota").val();
      var subdis = $("#desa").val();
      var prov = $("#provinsi").val();
      var dis = $("#kecamatan").val();
      var nama = $("#data-alumni").val();
      var noTelp = $("#no_telp").val();
      var skill = $("#id_skill").val();
      var perusahaan = $("#id_perusahaan").val();
      var email = $("#email").val();

      console.log(noTelp, email);
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=insertcontact",
          data: {
            noTelp,
            email,
          },
          success: function(msg){
            $("img#load2").hide();
            console.log(msg);
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "../../backend/api.php?jenis=insert",
                data: {
                  subdis,
                  city,
                  skill,
                  perusahaan,
                  contact: msg,
                  prov,
                  nama,
                  dis
                },
                success: function(msg){
                  $("img#load2").hide();
                  location.reload();
                }
            });
          }
      });

      
    } catch (error) {
      console.log(error);
    }
  });

  function deleteData(id) {
    try {
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=delete",
          data: {
            id,
          },
          success: function(msg){
            location.reload();
          }
      });
    } catch (error) {
      console.log(error);
    }
  };

  function editData(e, id) {
    try {
      e.preventDefault();
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=edit",
          data: {
            nama: $(`#nama-edit-${id}`).val(),
            id
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