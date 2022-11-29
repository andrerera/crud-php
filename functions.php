<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_penduduk');


function query($param) {
    global $conn;
    
    $query = mysqli_query($conn, $param);
    $rows = [];
    
    if (mysqli_num_rows($query) > 0) {
      while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
      }
    }
    
    return $rows;
  }

function set_flashdata($param1, $param2, $param3) {
  
  $message = trim(stripslashes(htmlspecialchars($param1)));
  $action = trim(rtrim(stripslashes(htmlspecialchars($param2))));
  $type = trim(rtrim(stripslashes(htmlspecialchars($param3))));
  
  return $_SESSION['flash'] = [
    'message' => $message,
    'action' => $action,
    'type' => $type
  ];
}

function flashdata() {
    
  if (isset($_SESSION['flash'])) {
    echo '<div class="alert alert-'. $_SESSION['flash']['type'] .' alert-dismissible fade show" role="alert">
            Data Kependudukan <strong>'. $_SESSION['flash']['message'] .'</strong> '. $_SESSION['flash']['action']  .'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
        
    unset($_SESSION['flash']);
  }
}

function set_userdata($param1, $param2) {

  $message = trim(stripslashes(htmlspecialchars($param1)));
  $type = trim(rtrim(stripslashes(htmlspecialchars($param2))));
  
  return $_SESSION['error'] = [
    'message' => $message,
    'type' => $type
  ];
}

function userdata() {
    
  if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-'. $_SESSION['error']['type'] .' alert-dismissible fade show" role="alert">
            '. $_SESSION['error']['message'] .'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';

    unset($_SESSION['error']);
  }
}

function set_value($nik, $nama, $tempat, $tanggal, $jk, $alamat, $agama, $pekerjaan) {
  
  return $_SESSION['value'] = [
    'nik' => $nik,
    'nama' => $nama,
    'tempat' => $tempat,
    'tanggal' => $tanggal,
    'jns_klmn' => $jk,
    'alamat' => $alamat,
    'agama' => $agama,
    'pekerjaan' => $pekerjaan
  ];
}

/* function list_jk() {
  
  $list = ['Laki-laki', 'Perempuan'];
  
  return $list;
}

function list_agama() {
  
  $list = ['Buddha', 'Hindu', 'Islam', 'Katolik', 'Konghucu', 'Kristen'];
  
  return $list;
} */

function tambah($nik, $nama, $tempat, $tanggal, $jk, $alamat, $agama, $pekerjaan) {
  global $conn;
  
  if (!validation($nik, $nama, $tempat, $tanggal, $jk, $alamat, $agama, $pekerjaan)) {
    
    header('Location: tambah.php');
    exit();
  } else {
        
    if (query("SELECT nik FROM tb_identitas WHERE nik = '$nik'")) {
      
      set_userdata('NIK telah terdaftar di Database', 'danger');

      header('Location: tambah.php');
      exit();
    }
        

    mysqli_query($conn, "INSERT INTO tb_identitas (nik, nm_lngkp, tmp_lhr, tgl_lhr, jns_klmn, alamat, agama, pekerjaan) VALUES ('$nik', '$nama', '$tempat', '$tanggal', '$jk', '$alamat', '$agama', '$pekerjaan')");
    
    
    return mysqli_affected_rows($conn);
  }
}

function validation($nik, $nama, $tempat, $tanggal, $jk, $alamat, $agama, $pekerjaan) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (empty($nik) && empty($nama) && empty($tempat) && empty($tanggal) && empty($jk) && empty($alamat) && empty($agama) && empty($pekerjaan)) {
      
      set_userdata('Isi semua data yang tersedia!', 'danger');
      
      return false;
    }
    
    if (empty($nik)) {
      
      set_userdata('Masukan NIK', 'danger');
      
      return false;
    } else if (!preg_match("/^[0-9]{16,16}/", $nik)) {
      
      set_userdata('Masukan 16 digit angka NIK', 'danger');
      
      return false;
    }
    
    if (empty($nama)) {

      set_userdata('Masukan Nama', 'danger');
      
      return false;
    } else if (!preg_match("/^[a-zA-Z ]*$/",$nama)) { 
      
      set_userdata('Nama hanya boleh diisi dengan huruf', 'danger');
      
      return false;
    }
    
    if (empty($tempat)) {

      set_userdata('Masukan Tempat Lahir', 'danger');
      
      return false;
    } else if (!preg_match("/^[a-zA-Z ]*$/",$tempat)) {
      
      set_userdata('Tempat hanya boleh diisi dengan huruf', 'danger');
      
      return false;
    } 
    
    if (empty($tanggal)) {
      
      set_userdata('Masukan tanggal lahir', 'danger');
      
      return false;
    }
    
    if (empty($jk)) {
      
      set_userdata('Masukan jenis kelamin', 'danger');
      
      return false;
    }
    
    if (empty($alamat)) {
      
      set_userdata('Masukan alamat', 'danger');
      
      return false;
    }
    
    if (empty($agama)) {
      
      set_userdata('Masukan agama', 'danger');
      
      return false;
    }

    if (empty($pekerjaan)) {
      
      set_userdata('Masukan pekerjaan', 'danger');
      
      return false;
    } else if (!preg_match("/^[a-zA-Z ]*$/",$pekerjaan)) {
      
      set_userdata('Pekerjaan hanya boleh diisi dengan huruf', 'danger');
      
      return false;
    }
    
    
    // jika lolos dari semua uji validasi, maka kembalikan nilai boolean true
    return true;
  }
}

function delete($id) {
  global $conn;
  
  $query = "DELETE FROM tb_identitas WHERE id = '$id'";
  

  mysqli_query($conn, $query);
    
  return mysqli_affected_rows($conn);
}

function edit($id, $nik, $nama, $tempat, $tanggal, $jk, $alamat, $agama, $pekerjaan) {
  global $conn;
  
  if (!validation($nik, $nama, $tempat, $tanggal, $jk, $alamat, $agama, $pekerjaan)) {
    
    
    header('Location: edit.php?id=' . $id);
    exit();
  } else {
        
            
    mysqli_query($conn, "UPDATE tb_identitas SET nik='$nik', nm_lngkp='$nama', tmp_lhr='$tempat', tgl_lhr='$tanggal', jns_klmn='$jk', alamat='$alamat', agama='$agama', pekerjaan='$pekerjaan' WHERE id = $id");
      
    return mysqli_affected_rows($conn);
  }
}

?>