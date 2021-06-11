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
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Tampil Barang</title>
</head>
<body>

	<div class="container">
  <div class="row">
    <div class="col"><br><br><br>
     <div class="container">
		<p><h3>Detail Barang : </h3></p>
	<div class="card" style="width:400px">
	<?=$img;?>
    <div class="card-body">
      <h4 class="card-title"><?=$namabarang;?></h4>
      <b><p class="card-text"><?=$kategori;?></p>
      <p class="card-text"><?=$stock;?></p></b>
    </div>
  </div>
</div>
    </div>
    <div class="col">
    	<br><br><br>
    	<p><h3>Barang Masuk </h3></p>
    	 <table id="barangmasuk" class="table table-bordered" cellspacing="0" width="100%">
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
                                        $ambildatamasuk = mysqli_query($conn, "select * from masuk m, supplier u, stock s where u.idsup = m.idsup AND s.idbarang = m.idbarang ");
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
                             
                                <table id="barangkeluar" class="table table-bordered" cellspacing="0" width="100%">
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


  

</body>
</html>