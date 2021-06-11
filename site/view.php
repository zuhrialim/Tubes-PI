<?php
require 'function.php';
require 'cek.php';

//dapet id barang 
$idbarang = $_GET['id']; //get id brg
//get informasi barang database
$get = mysqli_query($conn, "select * from stock s, kategori k where idbarang='$idbarang' AND k.idkategori = s.idkategori");
$fetch = mysqli_fetch_assoc($get);
//set variable
$namabarang = $fetch['namabarang'];
$kategori = $fetch['kategori'];
$stock = $fetch['stock'];


//CEK gambar ada/tdk
 $gambar = $fetch['image']; //ambil gambar
    if($gambar==null){
//ada
 $img = 'Tidak ada Gambar';
    }else{

 $img = '<img class = card-img-top" src="images/'.$gambar.'" alt="Card image" style="width:100%">';
 }
?>

<!DOCTYPE html>
<html>
<head>
<title>Tampil Barang</title>
 <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
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

  
</head>
<body>

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

	<div class="container">
  <div class="row">
    <div class="col"><br><br><br>
     <div class="container">
		<p><h3>Detail Barang : </h3></p>
	<div class="card" style="width:400px">
	<?=$img;?>
    <div class="card-body">
      <table >
        <tr>
          <th style="font-size: 120%">Nama Barang</th>
          <td></td>
          <td>:</td>
          <td><?=$namabarang;?></td>
        </tr>
        <tr>
          <th style="font-size: 120%">Kategori</th>
          <td></td>
           <td>:</td>
           <td><?=$kategori;?></td>
        </tr>
        <tr>
          <th style="font-size: 120%">Stok</th>
          <td></td>
           <td>:</td>
           <td><?=$stock;?></td>
        </tr>
        <tr></tr>
      </table>
    </div>
  </div>
</div>
    </div>
    <div class="col">
    	<br><br><br>
    	<p><h3>Barang Masuk </h3></p>
    	 <table id="viewmasuk" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Supplier</th>
                                            <th>Jumlah</th> 
                                            </tr>
                                    </thead>                               
                                    <tbody>
                                
                                        <?php
                                        $ambildatamasuk = mysqli_query($conn, "select * from masuk m, supplier u where idbarang='$idbarang' AND u.idsup = m.idsup ");
                                        $i = 1;
                                        while($fetch = mysqli_fetch_array($ambildatamasuk)){
                                            $tanggal = $fetch['tanggal'];
                                            $supplier = $fetch['supplier'];
                                            $quantity = $fetch['qty'];
                                        ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$supplier;?></td>  
                                            <td><?=$quantity;?></td>
                                            
                                       </tr>
                                       <?php
                                   };
                                   ?>
                                    </tbody>
                             
                                <table id="viewkeluar" class="table table-bordered" cellspacing="0" width="100%">
                                	<h3>Barang Keluar</h3>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Penerima</th>
                                            <th>Jumlah</th> 
                                            </tr>
                                    </thead>
                                    <tbody>
                                
                                        <?php
                                        $ambildatakeluar = mysqli_query($conn, "select * from keluar where idbarang='$idbarang'");
                                        $i = 1;
                                        while($fetch = mysqli_fetch_array($ambildatakeluar)){
                                            $tanggal = $fetch['tanggal'];
                                            $penerima = $fetch['penerima'];
                                            $quantity = $fetch['qty'];
                                        ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$penerima;?></td>  
                                            <td><?=$quantity;?></td>
                                            
                                       </tr>


                                       <?php
                                   };
                                   ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                                </table>
   							 </div>


   <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

        <script type="text/javascript">
            $(document).ready( function () {
            $('#viewmasuk').DataTable();
        } );
        </script>

        <script type="text/javascript">
            $(document).ready( function () {
            $('#viewkeluar').DataTable();
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

</body>

</html>