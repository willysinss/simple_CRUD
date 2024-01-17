<?php
$con = mysqli_connect('localhost', 'root', '', 'karyawan');
if (mysqli_connect_errno()  ) {
  echo 'Gagal terhubung ke database'.mysqli_connect_error();
}
?>
