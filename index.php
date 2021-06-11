<?php
require 'function.php';
require 'cek.php';

//qr
 $urlview = 'http://localhost/stockbarang/view.php?id='.$idbarang;
 $qrcode = 'https://chart.googleapis.com/chart?chs=130x130&cht=qr&chl='.$urlview.'&choe=UTF-8';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Jepara Barang</title>
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
                             <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Admin
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
                    <div class="container-fluid px-4 position-relative">
                        <!-- ALERT -->
                        <?php if(isset($_SESSION['failed'])): ?>
                        <div
                            class="alert alert-danger alert-dismissible fade show position-absolute" role="alert"
                            style="top: -3.25rem; width: 90%"
                        >
                            Barang gagal diterima
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                            unset($_SESSION['failed']);
                            endif;
                        ?>
                        
                        <?php
                            $ambildatastock = mysqli_query($conn, "select * from stock where stock < 1");
                            while($fetch = mysqli_fetch_array($ambildatastock)){
                                $barang = $fetch['namabarang'];
                        ?>

                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong> Stok barang <?=$barang;?> kosong!!</strong>
                        </div>

                        <?php
                            }
                        ?>

                        <h1 class="mt-4">Daftar Barang</h1>
                      
                        <div class="card mb-4">
                            <?php if($_SESSION['role'] == 'staff'): ?>
                            <div class="card-header">
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Barang
                                </button>
                                <a href="export.php" class="btn btn-success float-right">Export Barang</a>
                            </div>
                            <?php endif; ?>
                          
                            <div class="card-body">
                                <div class= "table-responsive">  
                                <table id="tabel" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori Barang</th>
                                            <th>Stok</th>
                                            <th>Gambar</th>
                                            <th>Qr Code</th>
                                            <th>Aksi</th>
                                            </tr>
                                    </thead>
                                 
                                    <tbody>

                                        <?php

                                        if ($_SESSION['role'] == 'admin'):
                                            $ambilsemuadatastock = mysqli_query($conn, 
                                                "select * from stock s, kategori k where k.idkategori = s.idkategori AND s.status = 'pending'"
                                            );
                                        else:
                                            $ambilsemuadatastock = mysqli_query($conn, 
                                                "select * from stock s, kategori k where k.idkategori = s.idkategori AND s.status = 'approve'"
                                            );
                                        endif;

                                        $i = 1;
                                        while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                            $idb = $data['idbarang'];
                                            $idk = $data['idkategori'];
                                            $namabarang = $data['namabarang'];
                                            $stock = $data['stock'];
                                            $kategori = $data['kategori'];
                                            

                                            //CEK gambar ada/tdk
                                            $gambar = $data['image']; //ambil gambar
                                            if($gambar == null){
                                                //ada
                                                $img = 'Tidak ada Gambar';
                                            }else{
                                                $img ='<img src = "images/'.$gambar.'" class="zoomable">';
                                            }
                                        ?>

                                        <tr>
                                            <td><?=$i++;
                                            ?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$kategori;?></td>
                                            <td><?=$stock;?></td>
                                            <td><?=$img;?></td>
                                            <td> <a href="<?=$urlview.$idb;?>">
                                            <img alt="" src="<?=$qrcode;?>"></td>
                                            <td>
                                                <?php if($_SESSION['role'] == 'staff'): ?>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <input type="hidden" name="idbarangygmaudihapus" value="<?=$idb;?>">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <a href="detail.php?id=<?=$idb;?>" class="btn btn-success"><i class="fas fa-info-circle"></i></a>
                                                <?php else: ?>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#accept<?=$idb;?>">
                                                    Terima
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject<?=$idb;?>">
                                                    Tolak
                                                </button>
                                                <?php endif; ?>
                                            </td>

                                       </tr>

                                        <!-- Edit  -->
                                      <div class="modal fade" id="edit<?=$idb;?>">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Edit Barang</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                            <input type="text" name="namabarang" value="<?=$namabarang;?>" placeholder="Nama Barang" class="form-control" required="">
                                            <br>
                                            <select name="kategorinya" class="form-control">
                                            <?php
                                                $ambilsemuadatanya = mysqli_query($conn, "select * from kategori");
                                                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                                    $namabarangnya = $fetcharray['kategori'];
                                                    $idbarangnya = $fetcharray['idkategori'];
                                                ?>
                                                
                                                <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

                                                <?php
                                            }
                                            ?>
                                            </select>
                                            <br>
                                            <input type="file" name="file" class="form-control">
                                            <br>
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <input type="hidden" name="deskripsi" value="<?=$deskripsi;?>" placeholder="Deskripsi" class="form-control" required="">
                                            <button type="submit" class="btn btn-primary" name="updatebarang">Edit</button>
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
                                              <h4 class="modal-title">Hapus Barang</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            Apakah yakin ingin menghapus barang <?=$namabarang;?>?
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                            </div>
                                            </form>  
                                            
                                          </div>
                                        </div>
                                      </div>

                                       <!-- Reject  -->
                                      <div class="modal fade" id="reject<?=$idb;?>">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Tolak Barang</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            Apakah yakin ingin menolak barang <?=$namabarang;?>?
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapusbarang">Tolak</button>
                                            </div>
                                            </form>  
                                            
                                          </div>
                                        </div>
                                      </div>

                                       <!-- Terima  -->
                                      <div class="modal fade" id="accept<?=$idb;?>">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Terima Barang</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            Apakah yakin ingin menerima barang <?=$namabarang;?>?
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-primary" name="terimabarang">Terima</button>
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
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required="">
                <br>
                <select name="kategorinya" class="form-control">
                    <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from kategori");
                        while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                            $namabarangnya = $fetcharray['kategori'];
                            $idbarangnya = $fetcharray['idkategori'];
                        ?>
                        
                        <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

                        <?php
                    }
                    ?>
                </select>

                <br> 
                <input type="number" name="stock" placeholder="stock" class="form-control" required="">
                <br> 
                <input type="file" name="file" class="form-control">
                <br>
                <input type="hidden" name="deskripsi" placeholder="Deskripsi barang" class="form-control" required="">
                <br> 
                
                <button type="submit" class="btn btn-primary" name="addnewbarang">Tambah</button>
            </div>
        </form>  
        
       
        <script type="text/javascript">
            $(document).ready( function () {
            $('#tabel').DataTable();
        } );
        </script>

        <script>
        // Function ini dijalankan ketika Halaman ini dibuka pada browser
        $(function(){
        setInterval(timestamp, 1000);//fungsi yang dijalan setiap detik, 1000 = 1 detik
        });
         
        //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
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
