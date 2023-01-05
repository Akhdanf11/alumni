<?php 
include '../connection.php';
if (isset($_POST['insert'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role_user =$_POST['role_user'];
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) {
    $sql = "SELECT * FROM tb_users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
    $sql = "INSERT INTO tb_users (id,username, email, password, role_user)
        VALUES (null,'$username', '$email', '$password', '$role_user')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Tambah data berhasil!')</script>";
        $username = "";
        $email = "";
        $_POST['password'] = "";
        $_POST['cpassword'] = "";
        $role_user = "";
    } else {
        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
    }
    } else {
    echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
    }
    
    } else {
    echo "<script>alert('Password Tidak Sesuai')</script>";
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
                  <th>Username</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Role</th>
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
                    $queryview = mysqli_query($conn, "SELECT * FROM tb_users");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr class="text-center">
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['password'];?></td>
                    <td><?php echo $row['role_user'];?></td>
                    <?php 
                    if ($_SESSION['role_user'] == 'Admin'){
                    ?>
                    <td>
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#updateuser<?php echo $no; ?>"><i class="far fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-bs-toggle="modal" data-bs-target="#deleteuser<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
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
                                <input type="text" class="form-control" required name="username" id="username" placeholder="name">
                                <label for="floatingInput">username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" required name="email" id="email" placeholder="name@example.com">
                                <label for="floatingInput">email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" required name="password" id="password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" required name="cpassword" id="cpassword" placeholder="Confirm Password">
                                <label for="floatingPassword">Confirm Password</label>
                            </div>
                            <div class="form-floating">
                                <select name="role_user" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected readonly>Pilih Role</option>
                                <option value="pegawai">Pegawai</option>
                                <option value="admin">Admin</option>
                                </select>
                                <label for="floatingSelect">Role</label>
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
                        <div id="deleteuser<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Delete Data user</h3>
                                <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus user dengan nama <div class="text-uppercase uppercase">"<?php echo $row['username'];?><strong><span class="grt"></span></strong>" ?</div></h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                <button onclick="deleteData(<?= $row['id']; ?>)" class="btn btn-primary"><i class="fas fa-trash-alt"></i> Delete</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updateuser<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Edit Data user</h3>
                              <button type="button" class="close btn text-danger btn-lg" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                              </button>
                              </div>
                              <div class="modal-body">
                                <form action="#" onsubmit="return editData(event, <?= $row['id'] ?>);" method="post" role="form">
                                    <div class="form-floating mb-3">
                                    <input type="text" class="form-control" required name="id" id="id" readonly placeholder="id" value="<?php echo $row['id']; ?>">
                                    <label for="floatingInput">username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username-edit-<?= $row['id']; ?>" required name="username" id="username" placeholder="username" value="<?php echo $row['username']; ?>">
                                    <label for="floatingInput">username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email-edit-<?= $row['id']; ?>" required name="email" id="email" placeholder="name@example.com" value="<?php echo $row['email']; ?>">
                                        <label for="floatingInput">email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password-edit-<?= $row['id']; ?>" required name="password" id="password" placeholder="Password" value="<?php echo $row['password']; ?>">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <div class="form-floating">
                                        <select name="role_user" class="form-select" id="role_user-edit-<?= $row['id']; ?>" aria-label="Floating label select example">
                                          <option selected ><?php echo $row['role_user']; ?></option>
                                          <option value="pegawai">Pegawai</option>
                                          <option value="admin">Admin</option>
                                        </select>
                                        <label for="floatingSelect">Role</label>
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
                      </div><!-- modal update user -->
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

//   $('#insert').submit((e) => {
//     try {
//       e.preventDefault();
//       var username = $("#username").val();
//       var email = $("#email").val();
//       var password= $("#password").val();
//       var role_user = $("#role_user").val(role_user);

//       $.ajax({
//           type: "POST",
//           dataType: "html",
//           url: "../../backend/api.php?jenis=insertuser",
//           data: {
//             username,
//             email,
//             password,
//             role_user,
//           },
//           success: function(msg){
//             console.log(msg, username, email, password, role_user);
//             location.reload();
//           }
//       });
//     } catch (error) {
//       console.log(error);
//     }
//   });

  function deleteData(id) {
    try {
      $.ajax({
          type: "POST",
          dataType: "html",
          url: "../../backend/api.php?jenis=deleteuser",
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
          url: "../../backend/api.php?jenis=edituser",
          data: {
            username: $(`#username-edit-${id}`).val(),
            email: $(`#email-edit-${id}`).val(),
            password: $(`#password-edit-${id}`).val(),
            role_user: $(`#role_user-edit-${id}`).val(),
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