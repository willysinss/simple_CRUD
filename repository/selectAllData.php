<?php



$query = "SELECT * FROM performance";
$result = mysqli_query($con, $query);
if ($result) {
    $karyawan = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'Gagal mengambil data karyawan';
}
function showData($con)
{
    $query = "SELECT * FROM performance";
    $result = mysqli_query($con, $query);
    if ($result) {
        $karyawan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo 'Gagal mengambil data karyawan';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['editId']) && !empty($_POST['editId'])) {
            // Edit existing data
            $editId = $_POST['editId'];

            // Retrieve data from the database based on $editId
            $query = "SELECT * FROM performance WHERE tgl_penilaian = '$editId'";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Populate form fields with data from the database
                $tglPenilaian = $row['tgl_penilaian'];
                $nik = $row['nik'];
                $nama = $row['nama'];
                $statusKerja = $row['status_kerja'];
                $posisi = $row['posisi'];
                $responsibility = $row['responsibility'];
                $teamWork = $row['teamwork'];
                $time = $row['management_time'];
                $total = $row['total'];
                $grade = $row['grade'];

                // Continue processing or rendering the form with this data
            }
        } else {
            
        }
    }
    

    foreach ($karyawan as $row): ?>
        <tr>
            <td>
                <?= $row['tgl_penilaian'] ?>
            </td>
            <td>
                <?= $row['nik']; ?>
            </td>
            <td>
                <?= $row['nama']; ?>
            </td>
            <td>
                <?= $row['status_kerja']; ?>
            </td>
            <td>
                <?= $row['posisi']; ?>
            </td>
            <td>
                <?= $row['total']; ?>
            </td>
            <td>
                <?= $row['grade']; ?>
            </td>
            <td>
                <a href="#" class="btn btn-warning" onclick="viewData(this);" data-nik="<?= $row['nik'] ?>"
                    data-foto="image/<?= $row['foto'] ?>">View</a>
                <a href="#" class="btn btn-danger" data-nik="<?= $row['nik'] ?>" data-foto="image/<?= $row['foto'] ?>"
                    onclick="editData(this);">Edit</a>
                <a href="#" class="btn btn-primary" onclick="deleteData(this);" data-nik="<?= $row['nik'] ?>">Hapus</a>
            </td>
        </tr>

    <?php endforeach;
}
?>