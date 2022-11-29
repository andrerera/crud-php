<?php

session_start();
require_once 'functions.php';
//$data['jns_klmn'] = list_jk();
//$data['agama'] = list_agama();

$id = trim(rtrim(mysqli_real_escape_string($conn, $_GET['id'])));
$row = query("SELECT * FROM tb_identitas WHERE id = '$id'")[0];

if (isset($_POST['submit'])) {
  
  $nik = trim(stripslashes(htmlspecialchars($_POST['nik'])));
  $nama = trim(rtrim(stripslashes(htmlspecialchars($_POST['nama']))));
  $tempat = trim(stripslashes(htmlspecialchars($_POST['tempat'])));
  $tanggal = trim(stripslashes(htmlspecialchars($_POST['tanggal'])));
  $jk = trim(stripslashes(htmlspecialchars($_POST['jns_klmn'])));
  $alamat = trim(stripslashes(htmlspecialchars($_POST['alamat'])));
  $agama = trim(stripslashes(htmlspecialchars($_POST['agama'])));
  $pekerjaan = trim(stripslashes(htmlspecialchars($_POST['pekerjaan'])));
  
  set_value($nik, $nama, $tempat, $tanggal, $jk, $alamat, $agama, $pekerjaan);
    
  if (edit($id, $nik, $nama, $tempat, $tanggal, $jk, $alamat, $agama, $pekerjaan) > 0) {
    
    set_flashdata('berhasil', 'diubah', 'success');
    
    header('Location: index.php');
    exit();
  } else {
    
    set_flashdata('gagal', 'diubah', 'danger');
    
    header('Location: index.php');
    exit();
  }
}

?>

<!DOCTYPE html>
<html>
<head>	
	<title>Edit Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.0/sweetalert2.min.css" integrity="sha512-zEmgzrofH7rifnTAgSqWXGWF8rux/+gbtEQ1OJYYW57J1eEQDjppSv7oByOdvSJfo0H39LxmCyQTLOYFOa8wig==" crossorigin="anonymous" />
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
<div class="container" style="margin-top:20px">
		<h2 class="font"><b>Edit Data</b> Identitas Kependudukan</h2>
          <div class="flash-container">
            <?= userdata(); ?>
          </div>
		<hr>
				
		<form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIK</label>
				<div class="col-sm-10">
					<input type="text" name="nik" class="form-control" value="<?= $row['nik']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA LENGKAP</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" value="<?= $row['nm_lngkp']; ?>">
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">TEMPAT LAHIR</label>
				<div class="col-sm-10">
					<input type="text" name="tempat" class="form-control" value="<?= $row['tmp_lhr']; ?>">
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">TANGGAL LAHIR</label>
				<div class="col-sm-10">
					<input type="date" name="tanggal" class="form-control" value="<?= $row['tgl_lhr']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
                <?php $jk = $row['jns_klmn']; ?>
				<div class="col-sm-10">
					<select name="jns_klmn" class="form-control">
                        <option <?php echo ($jk == 'Laki-laki') ? "selected": "" ?>>Laki-laki</option>
                        <option <?php echo ($jk == 'Perempuan') ? "selected": "" ?>>Perempuan</option>
					</select>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">ALAMAT</label>
				<div class="col-sm-10">
				<input type="text" name="alamat" class="form-control" value="<?= $row['alamat']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">AGAMA</label>
                <?php $agama = $row['agama']; ?>
				<div class="col-sm-10">
					<select name="agama" class="form-control">
                        <option <?php echo ($agama == 'Buddha') ? "selected": "" ?>>Buddha</option>
                        <option <?php echo ($agama == 'Hindu') ? "selected": "" ?>>Hindu</option>
                        <option <?php echo ($agama == 'Islam') ? "selected": "" ?>>Islam</option>
                        <option <?php echo ($agama == 'Katolik') ? "selected": "" ?>>Katolik</option>
                        <option <?php echo ($agama == 'Konghucu') ? "selected": "" ?>>Konghucu</option>
						<option <?php echo ($agama == 'Kristen') ? "selected": "" ?>>Kristen</option>
					</select>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">PEKERJAAN</label>
				<div class="col-sm-10">
					<input type="text" name="pekerjaan" class="form-control" value="<?= $row['pekerjaan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
				<button type="submit" name="submit" class="btn btn-primary font">
              			<span>SIMPAN</span>
            	</button>
                    <a href="index.php" class="btn btn-outline-danger font">BATAL</a>
				</div>
			</div>
		</form>
	</div>
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	
</body>
</html>