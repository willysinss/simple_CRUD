<html lang="en">
  <script
    type="module"
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js">
    new bootstrap.Popover(document.getElementById("popoverButton"));
  </script>

  <link rel="stylesheet" type="text/css" href="./index.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <div class="home--nav--container">
      <div class="w-100 mx-auto">
        <span class="home--nav--brand ms-5 fw-bold">Healthy Food</span>
      </div>
      <div class="w-100 mx-auto">
        <nav class="home--custom--nav me-4 nav h-100 fw-semibold mx-auto">
          <a
            class="home--nav--menu nav-link w-25 text-center"
            aria-current="page"
            href="#"
            >Home</a
          >
          <a class="home--nav--menu nav-link w-25" href="./performance.php">Performance</a>
        </nav>
      </div>
    </div>
  </head>
  <body>
    <?php
    include'db/connection.php';

    $query = "SELECT foto,nik,nama,posisi FROM performance WHERE status_kerja='tetap' AND grade IN ('c', 'd')";
    $result = mysqli_query($con, $query);
    if ($result) {
    $karyawan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
    echo 'Gagal mengambil data karyawan';
    }
    ?>
    <div class="home--content--container">
      <div class="home--content--left">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne"
                aria-expanded="false"
                aria-controls="flush-collapseOne">
                <span>Karyawan Tetap Dengan Performance C Dan D</span>
              </button>
            </h2>
            <div
              id="flush-collapseOne"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <table class="table table-striped">
                <thead>
                <tr id="table-headers">
                    <th scope="col">Foto</th>
                    <th scope="col">Nik</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Posisi</th>
                </tr>
                </thead>
                  <tbody id="data-table-body">
                        <?php foreach ($karyawan as $row) : ?>
                            <tr>
                            <td><img src="image/<?= $row['foto']; ?>" alt="Foto Karyawan" width="100" height="100"></td>
                            <td><?= $row['nik']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['posisi']; ?></td>
                            </tr>
                        <?php endforeach; ?>      
                   </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php
            $query = "SELECT foto,nik,nama,posisi FROM performance WHERE status_kerja='Tidak Tetap' AND grade IN ('c', 'd')";
            $result = mysqli_query($con, $query);
            if ($result) {
            $karyawan = mysqli_fetch_all($result, MYSQLI_ASSOC);
            } else {
            echo 'Gagal mengambil data karyawan';
            }
            ?>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo"
                aria-expanded="false"
                aria-controls="flush-collapseTwo">
                <span>Karyawan Tidak Tetap Dengan Performance C Dan D</span>
              </button>
            </h2>
            <div
              id="flush-collapseTwo"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
              <table class="table table-striped">
                <thead>
                <tr id="table-headers">
                    <th scope="col">Foto</th>
                    <th scope="col">Nik</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Posisi</th>
                </tr>
                </thead>
                  <tbody id="data-table-body">
                        <?php foreach ($karyawan as $row) : ?>
                            <tr>
                            <td><img src="image/<?= $row['foto']; ?>" alt="Foto Karyawan" width="100" height="100"></td>
                            <td><?= $row['nik']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['posisi']; ?></td>
                            </tr>
                        <?php endforeach; ?>      
                   </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


      <?php
      $karyawanTetap = 0;
      $karyawanTidakTetap = 0;
      $karyawanTetapA = 0;
      $karyawanTetapB = 0;
      $karyawanTetapC = 0;
      $karyawanTetapD = 0;
      $karyawanTidakTetapA = 0;
      $karyawanTidakTetapB = 0;
      $karyawanTidakTetapC = 0;
      $karyawanTidakTetapD = 0;
      $query = "SELECT * FROM performance";
      $result = mysqli_query($con, $query);
      if ($result) {
      $karyawan = mysqli_fetch_all($result, MYSQLI_ASSOC);
      } else {
      echo 'Gagal mengambil data karyawan';
      }

      foreach ($karyawan as $row){
        if ($row['status_kerja']=='Tetap'){
          $karyawanTetap +=1;
            if(strtoupper($row['grade'])==('A')){
              $karyawanTetapA +=1;
            }elseif(strtoupper($row['grade'])==('B')){
              $karyawanTetapB += 1;
            }elseif(strtoupper($row['grade'])==('C')){
              $karyawanTetapC += 1;
            }elseif(strtoupper($row['grade'])==('D')){
              $karyawanTetapD += 1;
            }
        } else{
          $karyawanTidakTetap +=1;
            if(strtoupper($row['grade'])==('A')){
              $karyawanTidakTetapA +=1;
            }elseif(strtoupper($row['grade'])==('B')){
              $karyawanTidakTetapB += 1;
            }elseif(strtoupper($row['grade'])==('C')){
              $karyawanTidakTetapC += 1;
            }elseif(strtoupper($row['grade'])==('D')){
              $karyawanTidakTetapD += 1;
            }
        }
      }


      ?>

      <div class="home--content--right">
        <div class="home--content--right--box">
          <div class="home--box--title">
            <span>Jumlah Karyawan</span>
          </div>
          <div class="home--box--datenow">
            <span class="date--now--dd-mm-yyyy"></span>
          </div>
          <div>
            <div class="home--box--dashed--line"></div>
          </div>
          <div class="home--box--info--a--a">
            <span>Tetap: <?=$karyawanTetap?></span>
          </div>
          <div class="home--box--info--a--b">
            <span>Tidak Tetap: <?=$karyawanTidakTetap?></span>
          </div>
        </div>

        <div class="home--content--right--box">
          <div class="home--box--title">
            <span
              >Hasil Performance <br />
              Karyawan Tetap</span
            >
          </div>
          <div class="home--box--datenow">
            <span class="date--now-yyyy">Tahun: </span>
          </div>
          <div>
            <div class="home--box--dashed--line"></div>
          </div>
          <div class="home--box--info--b">
            <div class="home--box--info--b--a">
              <span>A: <?=$karyawanTetapA?></span>
            </div>
            <div class="home--box--info--b--b">
              <span>B: <?=$karyawanTetapB?></span>
            </div>
            <div class="home--box--info--b--c">
              <span>C: <?=$karyawanTetapC?></span>
            </div>
            <div class="home--box--info--b--d">
              <span>D: <?=$karyawanTetapD?></span>
            </div>
          </div>
        </div>

        <div class="home--content--right--box">
          <div class="home--box--title">
            <span
              >Hasil Performance <br />
              Karyawan Tidak Tetap</span
            >
          </div>
          <div class="home--box--datenow">
            <span class="date--now-yyyy">Tahun: </span>
          </div>
          <div>
            <div class="home--box--dashed--line"></div>
          </div>
          <div class="home--box--info--c">
            <div class="home--box--info--c--a">
              <span>A: <?=$karyawanTidakTetapA?></span>
            </div>
            <div class="home--box--info--c--b">
              <span>B: <?=$karyawanTidakTetapB?></span>
            </div>
            <div class="home--box--info--c--c">
              <span>C: <?=$karyawanTidakTetapC?></span>
            </div>
            <div class="home--box--info--c--d">
              <span>D: <?=$karyawanTidakTetapD?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./index.js"></script>
  </body>
</html>
