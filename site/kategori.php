<?php
require 'function.php';
require 'cek.php';

//qr
 $urlview = 'http://localhost/stockbarang/view.php?id='.$idbarang;
 $qrcode = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='.$urlview.'&choe=UTF-8';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kategori Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous">
        </script>

        <style>
            .zoomable{
                width: 100px;
            }
            .zoomable:hover{
                transform:scale(2.5);
                transition: 0.4s ease;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-secondary bg-secondary">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 text-white" href="index.php"><h4>Inventaris Barang</h4></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars text-white"></i></button>
            <ul class="navbar-nav ml-auto">
            <h5 class="text-white"><?php echo date('Y-m-d');?></h5>&nbsp;
           <h5 id="timestamp" class="text-white"></h5>
       </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav bg-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"><img style="width: 90%" src="images/J.png" class="rounded-circle" alt="Cinque Terre"></div>
                            <Center><h5 style="font-family: cursive ">Hai <?php echo $_SESSION['username']; ?></h5></Center>
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                                Daftar Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck-loading"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="kategori.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-indent"></i></div>
                                Kategori
                            </a>
                            <a class="nav-link" href="supplier.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Supplier
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">

                    

                        <h1 class="mt-4">Kategori Barang</h1>
                      
                        <div class="card mb-4">
                            <div class="card-header">
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Kategori
                                </button>
                            </div>
                            <div class="card-body">
                                <div class= "table-responsive">  
                                <table id="tabel" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Barang</th>
                                            <th>Aksi</th>
                                            </tr>
                                    </thead>
                                 
                                    <tbody>

                                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "select * from kategori");
                                         $i = 1;
                                        while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                    
                                            $jenisbarang = $data['kategori'];
                                            $idb = $data['idkategori'];

                                            
                                        ?>

                                        <tr>
                                            <td><?=$i++;
                                            ?></td>
                                            <td><?=$jenisbarang;?></td>
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                <i class="fas fa-edit"></i></button>
                                                <input type="hidden" name="idbarangygmaudihapus" value="<?=$idb;?>">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                 <i class="fas fa-trash-alt"></i></button>
                                                                                                
                                         </td>

                                       </tr>

                                        <!-- Edit  -->
                                      <div class="modal fade" id="edit<?=$idb;?>">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Edit Kategori</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                            <input type="text" name="namabarang" value="<?=$jenisbarang;?>" placeholder="Nama Barang" class="form-control" required="">
                                            
                                
                                            <br> 
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <button type="submit" class="btn btn-primary" name="updatekategori">Edit</button>
                                            </div>
                                            </form> 
                                            
                                          </div>
                                        </div>
                                      </div>

                                       <!-- Hapus  -->
                                      <div class="modal fade" id="delete<?=$idb;?>">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Hapus kategori</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            Apakah yakin ingin menghapus kategori <?=$jenisbarang;?>?
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapuskategori">Hapus</button>
                                            </div>
                                            </form>  
                                            
                                          </div>
                                        </div>
                                      </div>

                                       <?php
                                   };
                                   ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>


            </div>
        </div>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    </body>
    
<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Kategori</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <input type="text" name="namabarang" placeholder="Nama Kategori" class="form-control" required="">
        <br>
        
        <button type="submit" class="btn btn-primary" name="addnewkategori">Tambah</button>
        </div>
        </form>  
        
       
        <script type="text/javascript">
            $(document).ready( function () {
            $('#tabel').DataTable();
        } );
        </script>

        <script>
        $(function(){
        setInterval(timestamp, 1000);
        });
         
        function timestamp() {
        $.ajax({
        url: 'ajax_timestamp.php',
        success: function(data) {
        $('#timestamp').html(data);
        },
        });
        }
        </script>
        
      </div>
    </div>
  </div>
</html>