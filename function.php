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

			$addtotable = mysqli_query($conn, "insert into stock (idkategori, namabarang, deskripsi, stock, image) values('$kategorinya','$namabarang','$deskripsi','$stock','$image')");
			if($addtotable){
				
				header('location:index.php');
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

?>