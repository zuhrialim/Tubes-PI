<?php
//Jika belum login

if (!isset($_SESSION['role'])) {
	session_start();
	session_destroy();
	return header('location:login.php?pesan=maaf session anda habis');
}

if(isset($_SESSION['log'])){

} else
	header('location:login.php');
?>