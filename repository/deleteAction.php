<?php

include '../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan NIK yang akan dihapus telah diterima dari permintaan POST
    if (isset($_POST['nik'])) {
        $nikToDelete = $_POST['nik'];

        // Selanjutnya, menjalankan kueri DELETE untuk menghapus data berdasarkan NIK
        $query = "DELETE FROM performance WHERE nik = '$nikToDelete'";

        if (mysqli_query($con, $query)) {
            // Data berhasil dihapus
            echo "success";
        } else {
            // Gagal menghapus data
            echo "Gagal menghapus data: " . mysqli_error($con);
        }
    } else {
        echo "NIK tidak ditemukan dalam permintaan.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
