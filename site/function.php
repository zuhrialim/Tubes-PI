<?php
 session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","stockbarang");

//menambah barang baru
if(isset($_POST['addnewbarang'])){
	$kategorinya = $_POST['kategorinya'];
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];
	$status = 'pending';

	//gambar
	$allowed_extension = array('png','jpg');
	$nama = $_FILES['file']['name']; //ambil nama gambar
	$dot = explode('.', $nama);
	$ekstensi = strtolower(end($dot));//ambil ekstensi
	$ukuran = $_FILES['file']['size'];//ambil size file
	$file_tmp = $_FILES['file']['tmp_name']; //ambil lokasi file

	//penamaan file ekripsi
	$image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; //gabung nama file yg dieksnripsi dgn ekstensi

	//cek barang udh ada
	$cek = mysqli_query($conn, "select * from stock where namabarang='$namabarang'");
	$hitung = mysqli_num_rows($cek);

	if($hitung<1){
	//proses uplod gambar
	if(in_array($ekstensi, $allowed_extension) === true){
		//validasi ukuran file
		if($ukuran < 15000000){
			move_uploaded_file($file_tmp, 'images/'.$image);

			$addtotable = mysqli_query($conn, "insert into stock (idkategori, namabarang, deskripsi, stock, image, status) 
				values('$kategorinya','$namabarang','$deskripsi','$stock','$image', '$status')");
			if($addtotable){
				echo '
			  	<script>
			  		alert("Barang sedang menunggu persetujuan Admin");
			  		window.location.href="index.php";
			  	</script>';
			}else {
				echo 'Gagal';
				header('location:index.php');
			}
		} else {
			//kalo lebih 1.5mb
			echo '
		      <script>
				 alert("Ukuran file terlalu besar");
				 windows.location.href="index.php";
		      </script>';
		}

	} else {
		//kalo tdk png/jpg
		 echo '
		   <script>
			 alert("File harus png/jpg");
			 windows.location.href="index.php";
		   </script>';

		}
	} else {
		//ada brg
		echo '
		   <script>
			 alert("barang sudah terdaftar");
			 windows.location.href="index.php";
		   </script>';
	}
};

//edit barang
if(isset($_POST['updatebarang'])){
	$kategorinya = $_POST['kategorinya'];
	$idb = $_POST['idb'];
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];

	//gambar
	$allowed_extension = array('png','jpg');
	$nama = $_FILES['file']['name']; //ambil nama gambar
	$dot = explode('.', $nama);
	$ekstensi = strtolower(end($dot));//ambil ekstensi
	$ukuran = $_FILES['file']['size'];//ambil size file
	$file_tmp = $_FILES['file']['tmp_name']; //ambil lokasi file

	//penamaan file ekripsi
	$image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; 

	if($ukuran==0){
		//jika tidak ingin uplod
		$update = mysqli_query($conn, "update stock set namabarang = '$namabarang', idkategori = '$kategorinya', deskripsi='$deskripsi' where idbarang = '$idb'");
		if($update){
			header('location:index.php');
		}else{
			echo 'gagal';
			header('location:index.php');
		}
	}else{
		//jika ingin
		move_uploaded_file($file_tmp, 'images/'.$image);
		$update = mysqli_query($conn, "update stock set idkategori = '$kategorinya', namabarang = '$namabarang', deskripsi='$deskripsi', image='$image' where idbarang = '$idb'");
		if($update){
			header('location:index.php');
		}else{
			echo 'gagal';
			header('location:index.php');
		}
	}

}

//hapus barang
if(isset($_POST['hapusbarang'])){
	$idb = $_POST['idb'];

	$gambar = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$get = mysqli_fetch_array($gambar);
	$img = 'images/'.$get['image'];
	unlink($img);

	$hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
	if($hapus){
		header('location:index.php');
	}else{
		echo 'gagal';
		header('location:index.php');
	}
};


if(isset($_POST['hapusbarangpending'])){
	$idb = $_POST['idb'];

	$gambar = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$get = mysqli_fetch_array($gambar);
	$img = 'images/'.$get['image'];
	unlink($img);

	$hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
	if($hapus){
		header('location:indexpending.php');
	}else{
		echo 'gagal';
		header('location:indexpending.php');
	}
};

if (isset($_POST['terimabarang'])) {
	$id = $_POST['idb'];

	$changeStatus = mysqli_query($conn, "UPDATE stock SET status = 'approve' WHERE idbarang = '$id'");
	if (!$changeStatus) $_SESSION['failed'] = true;

	return header('location:indexpending.php');
}

//fitur menambah barang masuk
if(isset($_POST['barangmasuk'])){
	$barangnya = $_POST['barangnya'];
	$suppliernya = $_POST['supplier'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);
	$stocksekarang = $ambildatanya['stock'];
	$tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;


	$addtomasuk = mysqli_query($conn,"insert into masuk (idbarang, idsup, keterangan, qty) values('$barangnya','$suppliernya','$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
	if($addtomasuk&&$updatestockmasuk){
		header('location:masuk.php');
	}else{
		echo 'gagal';
		header('location:masuk.php');
	}
}

//fitur ubah barang masuk
if(isset($_POST['updatebarangmasuk'])){
	$idb = $_POST['idb'];
	$idm = $_POST['idm'];
	$ids = $_POST['ids'];
	$supplier = $_POST['supplier'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from stock where idmasuk = '$idm'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if($qty>$qtyskrg){
		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg - $selisih;
			$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
			$updatenya = mysqli_query($conn, "update masuk set qty='$qty', idsup='$supplier'where idmasuk='$idm'");
			if($kurangistocknya&&$updatenya){
			header('location:masuk.php');
			}else{
			echo 'gagal';
			header('location:masuk.php');
	}
		
		
} else {
		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang = '$idb'");
		$updatenya = mysqli_query($conn, "update masuk set qty = '$qty', idsup = '$supplier' where idmasuk = '$idm'");

		if($kurangistocknya&&$updatenya){
			header('location:masuk.php');
		}else{
			echo 'gagal';
			header('location:masuk.php');
	}
  }
}

//fitur menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
	$idm = $_POST['idm'];

	$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data['stock'];

	$selish = $stok-$qty;

	$update = mysqli_query($conn, "update stock set stock='$selish' where idbarang='$idb'");
	$hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

	if($update&&$hapusdata){
		header('location:masuk.php');
	} else {
		header('location:masuk.php');
	}
}

//menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);
	$stocksekarang = $ambildatanya['stock'];

	if($stocksekarang >= $qty){
		//kalau barang cukup
	

	$tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;


	$addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
	if($addtokeluar&&$updatestockmasuk){
		header('location:keluar.php');
	}else{
		echo 'gagal';
		header('location:keluar.php');
	}
  } else {
  	//kalau barang tidak cukup
  	echo '
  	<script>
  		alert("Stock tidak cukup");
  		window.location.href="keluar.php";
  	</script>';
  }
}

//Ubah barang keluar
if(isset($_POST['updatebarangkeluar'])){
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar = '$idk'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if($qty>$qtyskrg){
		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg - $selisih;

		if($selisih <= $stockskrg){
			//stok cukup
			$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
			$updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
		if($kurangistocknya&&$updatenya){
			header('location:keluar.php');
		}else{
			echo 'gagal';
			header('location:keluar.php');
			}

		} else {
			//stok tak cukup
			echo '
			<script>alert("Stok tidak mencukupi");
			window.location.href="keluar.php";
			</script>';

				}
		
} else {
		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang = '$idb'");
		$updatenya = mysqli_query($conn, "update keluar set qty = '$qty', penerima = '$penerima' where idkeluar = '$idk'");
		if($kurangistocknya&&$updatenya){
			header('location:keluar.php');
		}else{
			echo 'gagal';
			header('location:keluar.php');
	}
  }
}

//menghapus brg keluar
if(isset($_POST['hapusbarangkeluar'])){
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
	$idk = $_POST['idk'];

	$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data['stock'];

	$selish = $stok+$qty;

	$update = mysqli_query($conn, "update stock set stock='$selish' where idbarang='$idb'");
	$hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

	if($update&&$hapusdata){
		header('location:keluar.php');
	} else {
		header('location:keluar.php');
	}
}

//admin
if(isset($_POST['addadmin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];

	$queryinsert = mysqli_query($conn, "insert into login (username, password, role) values ('$username', '$password', '$role')");

	if($queryinsert){
		header('location:admin2.php');
	}else {
		header('lcoation:admin2.php');
	}
}

//edit data admin
 if(isset($_POST['updateadmin'])){
 	$usernamebaru = $_POST['usernameadmin'];
 	$passwordbaru = $_POST['passwordbaru'];
 	$idnya = $_POST['id'];

 	$queryupdate = mysqli_query($conn, "update login set username='$usernamebaru', password='$passwordbaru' where iduser='$idnya'");

 	if($queryupdate){
 		header('location:admin2.php');
 	} else {
 		header('lcoation:admin2.php');
 	}
 }

 //hapusadmin
 if(isset($_POST['hapusadmin'])){
 	$id = $_POST['id'];

 	$querydelete = mysqli_query($conn, "delete from login where iduser = '$id'");
 	if($querydelete){
 		header('location:admin2.php');
 	} else {
 		header('location:admin2.php');
 	}

 }

//kategori tambah
if(isset($_POST['addnewkategori'])){
	$namabarang = $_POST['namabarang'];
	
	$queryinsert = mysqli_query($conn, "insert into kategori (kategori) values ('$namabarang')");

	if($queryinsert){
		header('location:kategori.php');
	}else {
		header('lcoation:kategori.php');
	}
}

//edit data kategori
 if(isset($_POST['updatekategori'])){
 	$namabarang = $_POST['namabarang'];
 	$idnya = $_POST['idb'];

 	$queryupdate = mysqli_query($conn, "update kategori set kategori='$namabarang' where idkategori='$idnya'");

 	if($queryupdate){
 		header('location:kategori.php');
 	} else {
 		header('lcoation:kategori.php');
 	}
 }

 //hapus kategori
 if(isset($_POST['hapuskategori'])){
 	$id = $_POST['idb'];

 	$querydelete = mysqli_query($conn, "delete from kategori where idkategori = '$id'");
 	if($querydelete){
 		header('location:kategori.php');
 	} else {
 		header('lcoation:kategori.php');
 	}

 }

 //supplier tambah
 if(isset($_POST['addnewsupplier'])){
	$supplier = $_POST['supplier'];
	
	$queryinsert = mysqli_query($conn, "insert into supplier (supplier) values ('$supplier')");

	if($queryinsert){
		header('location:supplier.php');
	}else {
		header('lcoation:supplier.php');
	}
}

//edit data Supplier
if(isset($_POST['updatesupplier'])){
    $supplier = $_POST['supplier'];
    $idnya = $_POST['idb'];

    $queryupdate = mysqli_query($conn, "update supplier set supplier='$supplier' where idsup='$idnya'");

    if($queryupdate){
        header('location:supplier.php');
    } else {
        header('lcoation:supplier.php');
    }
}

//hapus supplier
if(isset($_POST['hapussupplier'])){
    $id = $_POST['idb'];

    $querydelete = mysqli_query($conn, "delete from supplier where idsup = '$id'");
    if($querydelete){
        header('location:supplier.php');
    } else {
        header('lcoation:supplier.php');
    }

}

?>