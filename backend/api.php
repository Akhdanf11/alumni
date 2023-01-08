<?php
	include("connection.php");

	switch ($_GET['jenis']) {
		//ambil data kota / kabupaten
		case 'kota':
			$id_provinces = $_POST['id_provinces'];
			if($id_provinces == ''){
				exit;
			}else{
				$getcity = mysqli_query($connection,"SELECT  * FROM ec_cities WHERE prov_id ='$id_provinces' ORDER BY city_name ASC") or die ('Query Gagal');
				while($data = mysqli_fetch_array($getcity)){
					echo '<option value="'.$data['city_id'].'">'.$data['city_name'].'</option>';
				}
				exit;    
			}
		break;

		//ambil data kecamatan
		case 'kecamatan':
			$id_regencies = $_POST['id_regencies'];
			if($id_regencies == ''){
				exit;
			}else{
				$getcity = mysqli_query($connection,"SELECT  * FROM ec_districts WHERE city_id ='$id_regencies' ORDER BY dis_name ASC") or die ('Query Gagal');
				while($data = mysqli_fetch_array($getcity)){
                    $ditrictId = $data['dis_id'];
                    $getVillagesByDistrictId = mysqli_query($connection,"SELECT  * FROM ec_datalumni WHERE dis_id = '$ditrictId' ORDER BY data_nama ASC");

                    echo '<div class="card text-bg-primary mb-3">';
                    echo   '<div class="card-header bg-primary text-light">';
                    echo       '<p>Daerah Alumni : ';
					echo		$data['dis_name'];
					echo		'</p>' ;
                    echo    '</div>';

                    echo    '<div class="card-body alert alert-primary">';
                    echo '<ul>';
                    while($villagesData = mysqli_fetch_array($getVillagesByDistrictId)) {
                        $villageName = $villagesData['data_nama'];
						$villageTelp = $villagesData['no_telp'];
                        echo "<li> $villageName ($villageTelp)</li>";
                    }
                    echo '</ul>';
                    echo    '</div>';
                    echo '</div>';
				}
				exit;
            }
		break;

		//ambil data kecamatan dlm bentuk dropdown
		case 'kec':
			$id_regencies = $_POST['id_regencies'];
			if($id_regencies == ''){
				exit;
			}else{
				$getcity = mysqli_query($connection,"SELECT * FROM ec_districts WHERE city_id ='$id_regencies' ORDER BY dis_name ASC") or die ('Query Gagal');
				while($data = mysqli_fetch_array($getcity)){
					echo '<option value="'.$data['dis_id'].'">'.$data['dis_name'].'</option>';
				}
				exit;
            }
		break;

		//ambil data desa dlm bentuk dropdown
		case 'desa':
			$id_dis = $_POST['id_dis'];
			if($id_dis == ''){
				exit;
			}else{
				$getVillage = mysqli_query($connection,"SELECT * FROM ec_subdistricts WHERE dis_id	 ='$id_dis' ORDER BY subdis_name ASC") or die ('Query Gagal');
				while($data = mysqli_fetch_array($getVillage)){
					echo '<option value="'.$data['subdis_id'].'">'.$data['subdis_name'].'</option>';
				}
				exit;
            }
		break;

		//insert data
		case 'insert':
			$dis = $_POST['dis'];
			$subdis = $_POST['subdis'];
			$city = $_POST['city'];
			$prov = $_POST['prov'];
			$nama = $_POST['nama'];
			$skill = $_POST['skill'];
			$perusahaan = $_POST['perusahaan'];
			$contact = $_POST['contact'];

			$insertData = mysqli_query($connection, "INSERT INTO `ec_datalumni` (`data_id`, `subdis_id`, `dis_id`, `city_id`, `prov_id`, `id_perusahaan`, `id_skill`, `id_contact`, `data_nama`) VALUES (NULL, $subdis, $dis, $city, $prov, $perusahaan, $skill, $contact, '$nama');") or die ('Query Gagal');
			exit;
		break;

		case 'insertcontact':
			$email = $_POST['email'];
			$noTelp = $_POST['noTelp'];

			$insertData = mysqli_query($connection, "INSERT INTO `tb_contact` (`id_contact`, `email`, `no_telp`) VALUES (NULL, '$email', '$noTelp');") or die ('Query Gagal');

			echo mysqli_insert_id($connection);
			exit;
		break;

		case 'insertuser':
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$role_user = $_POST['role_user'];

			$insertData = mysqli_query($connection, "INSERT INTO `tb_users` (`id`,`username`, `email`, `password`, `role_user`) VALUES (NULL, '$username', '$email', '$password', '$role_user');") or die ('Query Gagal');
			exit;
		break;

		//delete data
		case 'delete':
			$id = $_POST['id'];
			$insertData = mysqli_query($connection, "DELETE FROM `ec_datalumni` WHERE `ec_datalumni`.`data_id` = $id") or die ('Query Gagal');
			exit;
		break;

		case 'deleteuser':
			$id = $_POST['id'];
			$insertData = mysqli_query($connection, "DELETE FROM `tb_users` WHERE `tb_users`.`id` = $id") or die ('Query Gagal');
			exit;
		break;

		case 'deleteskill':
			$id = $_POST['id_skill'];
			$insertData = mysqli_query($connection, "DELETE FROM `tb_skill` WHERE `tb_skill`.`id_skill` = $id") or die ('Query Gagal');
			exit;
		break;

		case 'deleteperusahaan':
			$id = $_POST['id_perusahaan'];
			$insertData = mysqli_query($connection, "DELETE FROM `tb_perusahaan` WHERE `tb_perusahaan`.`id_perusahaan` = $id") or die ('Query Gagal');
			exit;
		break;

		//edit data
		case 'edit':
			$nama = $_POST['nama'];
			$id = $_POST['id'];
			$insertData = mysqli_query($connection, "UPDATE `ec_datalumni` SET `data_nama` = '$nama' WHERE `ec_datalumni`.`data_id` = $id;") or die ('Query Gagal');
			exit;
		break;

		case 'edituser':
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$role_user = $_POST['role_user'];
			$id = $_POST['id'];
			$insertData = mysqli_query($connection, "UPDATE `tb_users` SET `username` = '$username', `email` = '$email', `password` = '$password',`role_user` = '$role_user' WHERE `tb_users`.`id` = $id;") or die ('Query Gagal');
			exit;
		break;
		
		case 'editskill':
			$nama = $_POST['nama_skill'];
			$id = $_POST['id_skill'];
			$insertData = mysqli_query($connection, "UPDATE `tb_skill` SET `nama_skill` = '$nama' WHERE `tb_skill`.`id_skill` = $id;") or die ('Query Gagal');
			exit;
		break;

		case 'editperusahaan':
			$jenis_perusahaan = $_POST['jenis_perusahaan'];
			$id_skill = $_POST['id_skill'];
			$id = $_POST['id_perusahaan'];
			$insertData = mysqli_query($connection, "UPDATE `tb_perusahaan` SET `jenis_perusahaan` = '$jenis_perusahaan',`id_skill` = '$id_skill' WHERE `tb_perusahaan`.`id_perusahaan` = $id;") or die ('Query Gagal');
			exit;
		break;

		case 'editapp':
			$nama = $_POST['nama'];
			$tahun_dibuat = $_POST['tahun_dibuat'];
			$id = $_POST['id'];
			$insertData = mysqli_query($connection, "UPDATE `tb_users` SET `nama` = '$nama', `tahun_dibuat` = '$tahun_dibuat' WHERE `tb_users`.`id` = $id;") or die ('Query Gagal');
			exit;
		break;
	}
?>