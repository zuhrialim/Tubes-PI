<!DOCTYPE html>
<html>
<head>
    <!-- CSS only -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<title>Inventaris Jepara</title>
</head>
<body>

<nav class="navbar navbar-expand-xl bg-dark navbar-dark">
  <ul class="navbar-nav left">
    <li class="nav-item active">
        <a class="navbar-brand" href="#">Pesona Jepara Medan</a>
    </li>
        <form class="form-inline" action="/action_page.php">
            <button class="btn btn-light" type="submit">Riwayat Keluar Masuk Barang</button>
        </form>
  </ul>
</nav>


    <center><h1 style="margin-top: 50px">Data Barang</h1></center>
     &nbsp; 

    <div class="container">
	 <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jenis Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th></th>
                    </tr>
        </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-primary" style="margin-right : 10px" data-toggle="modal" data-target="#ambilBarang">Ambil Barang
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahBarang">Tambah Barang
                        </td>
                    </tr>
                </tbody>
      </table>
    </div>

    <!-- The Modal Ambil Barang -->
        <div class="modal fade" id="ambilBarang">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ambil Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!-- Modal body -->
            <div class="modal-body">
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="jenisBarang">Jenis Barang</label>
                    <input type="text" class="form-control" id="jenisBarang" placeholder=" " name="jenisBarang">
                </div>
                <div class="form-group">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" class="form-control" id="namaBarang" placeholder=" " name="namaBarang">
                </div>
                <div class="form-group">
                    <label for="stokBarang">Stok Barang Saat Ini</label>
                    <input type="text" class="form-control" id="stokBarang" placeholder=" " name="stokBarang">
                </div>
                <button type="submit" class="btn btn-primary">Ambil Barang</button>
                </form>
            </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

            </div>
        </div>
        </div>
    
    <!-- The Modal Tambah Barang-->
    <div class="modal fade" id="tambahBarang">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Stok Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="jenisBarang">Jenis Barang</label>
                    <input type="text" class="form-control" id="jenisBarang" placeholder=" " name="jenisBarang">
                </div>
                <div class="form-group">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" class="form-control" id="namaBarang" placeholder=" " name="namaBarang">
                </div>
                <div class="form-group">
                    <label for="stokBarang">Stok Barang Saat Ini</label>
                    <input type="text" class="form-control" id="stokBarang" placeholder=" " name="stokBarang">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Stok</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

            </div>
        </div>
        </div>





</body>
</html>