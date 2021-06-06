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
