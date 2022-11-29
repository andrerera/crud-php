<?php

session_start();
require_once 'functions.php';


$batas = 5;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($conn,"select * from tb_identitas");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$rows = query("SELECT * FROM tb_identitas ORDER BY id DESC LIMIT $halaman_awal, $batas");
$nomor = $halaman_awal+1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="alert/css/sweetalert.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-fluid">
	<p id="success"></p>
        <div class="table-wrapper">
            <div>
            <div class="flash-container">
                <?= flashdata(); ?>
            </div>
            </div>
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-10">
						<h2 class="font">Data <b>Kependudukan</b></h2>
					</div>
					<div class="col-sm-2">
						<h3><a href="tambah.php" class="btn btn-success font"><i class="fa fa-fw fa-plus-circle"></i> Tambah Data</a></h3>				
					</div>
                </div>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-bordered table-hover table-striped">
                    <thead style="text-align: center" class="font">
                        <tr>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="font">

                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><small class="text-black-50"><?= $row['nik']; ?></small></td>
                            <td><small class="text-black-50"><?= $row['nm_lngkp']; ?></small></td>
                            <td><small class="text-black-50"><?= $row['tmp_lhr']; ?></small></td>
                            <td><small class="text-black-50"><?= $row['tgl_lhr']; ?></small></td>
                            <td><small class="text-black-50"><?= $row['jns_klmn']; ?></small></td>
                            <td><small class="text-black-50"><?= $row['alamat']; ?></small></td>
                            <td><small class="text-black-50"><?= $row['agama']; ?></small></td>
                            <td><small class="text-black-50"><?= $row['pekerjaan']; ?></small></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="edit.php?id=<?= $row['id']; ?>" class="badge badge-primary p-2 text-light mr-2">
                                        <small class="fa fa-fw fa-edit"></small>
                                    </a>
                                    <a href="hapus.php?id=<?= $row['id']; ?>" id="hapus" class="badge badge-danger p-2 text-light delete-link">
                                        <small class="fa fa-fw fa-trash"></small>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
			</div>
        </div>
        <nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav> 
    </div>
    <script type="text/javascript" src="alert/js/jquery-2.1.4.min.js"></script>
    <script src="alert/js/sweetalert.min.js"></script>
    <script src="alert/js/qunit-1.18.0.js"></script>

	<script>
        jQuery(document).ready(function($){
            $('.delete-link').on('click',function(){
                var getLink = $(this).attr('href');
                swal({
                        title: 'Alert',
                        text: 'Hapus Data?',
                        type: 'warning',
                        html: true,                                      
                        showCancelButton: true,
                        confirmButtonColor: '#3850C6',
                        confirmButtonText: 'Hapus', 
                        },function(){   
                        window.location.href = getLink
                    });
                return false;
            });
        });
    </script>
  <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
  -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script> 
</body>
</html>   