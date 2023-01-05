<?php 

include 'connection.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: page/index.php");
}

if (isset($_POST['submit'])) {
 $email = $_POST['email'];
 $password = md5($_POST['password']);

 $sql = "SELECT * FROM tb_users WHERE email='$email' AND password='$password'";
 $result = mysqli_query($conn, $sql);
 if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);
  $_SESSION['username'] = $row['username'];
  $_SESSION['role_user'] = $row['role_user'];
  header("Location: page/index.php");
 } else {
  echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
 }
}

?>


<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="assets/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <link rel="stylesheet" href="assets/css/animate.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    </head>
    <body class="text-center">
          <?php if($_SESSION['error']){
                  echo "<div class='alert alert-warning alert-dismissible fade show pb-5' role='alert'>
                          <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                          ". $_SESSION['error']. "
                      </div>";
              } 
              ?>
      <div class="row justify-content-md-between mt-lg-4">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-9">
          <div class="card mb-3" style="width: 750px;">
            <main class="form-signin w-100 m-auto needs-validation" novalidate>
              <form action="" method="POST" class="login-email">
                <img class="my-4" src="../asset/img/account-com.svg" alt="" width="300" height="200">
                <h1 class="h3 mb-3 fw-normal text-muted">Please sign in</h1>
               <div class="row">
                 <div class="col-md-2"></div>
                 <div class="col-md-8">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" required name="email" id="email" placeholder="name@example.com" value="<?php echo $email; ?>">
                    <label for="floatingInput">email</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" required name="password" id="password" placeholder="Password" value="<?php echo $password; ?>">
                    <label for="floatingPassword">Password</label>
                  </div>
                  <button type="submit" name="submit" class="w-100 btn btn-lg btn-primary mb-3 ">Sign In</button>
                  <input type="button" value="Reset" type="reset" class="w-100 btn btn-lg btn-outline-danger wow fadeInLeft" id="resetbtn" name="resetbtn" onclick=""/>
                  <label class="fw-bold" for="myCheck">Not Yet Register ? <a href="register.php" class="alert-link">Here</a></label> 
                </div>
               </div>
          
                <p class="mt-5 mb-3 text-muted">Akhdan &copy; 2022</p>
              </form>
            </main>
            </div>
        </div>
        </div>

            <script>
              $(document).ready(function () {
                $("#resetbtn").hide(); 
                $("#resetbtn").click(function (){
                    reset();
                    $("#resetbtn").hide();
                })
            })
              	$(document).keypress(function(event){
                  $("#resetbtn").show();
              });

              function reset (){
                let reset = '';
                var email = document.getElementById('email').value = reset;
                var password = document.getElementById('password').value =reset;
              }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

          </body>
</html>