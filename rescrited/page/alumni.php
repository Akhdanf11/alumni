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


<main role="main" class="col-md-9 mx-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Data Alumni</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target=".modal-create"><i class="fas fa-plus"></i> Tambah Data</button>
    </div>
  </div>
  
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
                <label class="control-label col-sm-4">Contact Person :</label>
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
                <select class="form-select" name="kota" id="kota" aria-label="Floating label select example"></select>
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
  
  <?php 
    include "modal-alumni.php";
  ?>    
</main>
<?php
  include 'footer.php';
?>