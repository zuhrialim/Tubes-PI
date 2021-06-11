<?php
require 'function.php';


//cek login
if (isset($_POST['login'])){
  $username = $_POST['username']; 
  $password = $_POST['password'];

  $cekdatabase = mysqli_query($conn, "SELECT * FROM login where username='$username' and password='$password'");
  $hitung = mysqli_num_rows($cekdatabase);

  if($hitung>0){
    $data = mysqli_fetch_assoc($cekdatabase);
    $_SESSION['log'] = 'True';
    $_SESSION['username'] = $username;
    // $_SESSION['nama'] = $data['nama'];
    $_SESSION['status'] = "sudah_login";
    // $_SESSION['id_login'] = $data['id'];
    $_SESSION['role'] = $data['role'];

    if ($data['role'] == 'admin') {
        return header("location:admin2.php");
    } else {
        return header('location:index.php');
    }

  } else {
   return header("location:login.php?pesan=Username/Password Salah.");
  }
};

if(!isset($_SESSION['log'])){

}else{
    header('location:index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/login.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                   <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <form method="post" class="box">
                                    <h1>JEPARA</h1>
                                    
                                    <input type="text" name="username" placeholder="Username">
                                     <input type="password" name="password" placeholder="Password"> 
                                     <input type="submit" name="login" value="Login" href="#">
                                     <?php if(isset($_GET['pesan'])) { ?>
                                        <div class="error">
                                          <center><label class="btn btn-danger"><?php echo $_GET['pesan']; ?></label></center>
                                      </div>
                                      <?php } ?>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
       
                </div><br>
                                
                            
                </main>
            </div>
           
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
