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
      <a href="cetak-pdf.php" target="_blank" rel="noopener noreferrer"><button class="btn btn-md btn-primary" ><i class="fas fa-print"></i> Cetak Data</button></a>
    </div>
  </div>
  <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead class="text-center">
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Skill</th>
                  <th>Email</th>
                  <th>Telephone</th>
                  <th>Perusahan</th>
                  <th>Provinsi</th>
                  <th>Kota</th>
                  <th>Kecamatan</th>
                  <th>Desa</th>
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
                  </tr>

                      
                  <?php
                    }
                  ?>
              </tbody>
            </table>
          </div> 
</main>
<?php
  include 'footer.php';
?>