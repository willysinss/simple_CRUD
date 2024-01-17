<!doctype html>
<html lang="en">
<script
    type="module"
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js">
    new bootstrap.Popover(document.getElementById("popoverButton"));
  </script>
<link rel="stylesheet" type="text/css" href="./index.css" />
<link rel="stylesheet" type="text/css" href="./style.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />

  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="index.js"></script>
    
    <title>Healthy FOOD</title>
    <div class="home--nav--container">
        <div class="w-100 mx-auto">
          <span class="home--nav--brand ms-5 fw-bold">Healthy Food</span>
        </div>
        <div class="w-100 mx-auto">
          <nav class="home--custom--nav me-4 nav h-100 fw-semibold mx-auto">
            <a
              class="home--nav--menu nav-link w-25 text-center"
              aria-current="page"
              href="index.php"
              >Home</a
            >
            <a class="home--nav--menu nav-link w-25" href="./performance.php">Performance</a>
          </nav>
        </div>
      </div>
  </head>
  <body>
  
  <?php      
        include("./repository/action.php");
        include("./db/connection.php");
        action();
        ?>
    <div class="container">
      <div class="row">
        <div class="col-9">
        <form action="performance.php" method="POST" enctype="multipart/form-data" id="editForm">
        <input type="hidden" name="editNik" id="editNik" value="">
        <input type="hidden" name="operation" id="operation" value="insert">
            <div class="form-group form-inline">
                <label for="fileInput">Foto:</label>
                <input type="file" class="form-control" id="fileInput" name="fileInput" Required>
                <img id="imagePreview" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;">
            </div>
        </div>
        <div class="col-3 mx-auto">
        <div class="btn-group-vertical">
            <button type="submit" class="btn btn-primary" id="simpan" >Simpan</button>
            <button type="reset" class="btn btn-default" id="clear" >Clear</button>
            <button type="reset" class="btn btn-danger" onclick="showTable()" id="cancel" >Cancel</button>
        </div>
        </div>


        <div class="w-100"></div>

        <div class="col-6">
          <div class="form-group">
                <label for="tanggalPenilaian" class="custom-form-label">Tanggal Penilaian:</label>
                <input type="date" class="form-control custom-form-input" id="tanggalPenilaian" name="tanggalPenilaian" Required>
            </div>
            <div class="form-group">
                <label for="nik" class="custom-form-label">NIK:</label>
                <input type="text" class="form-control custom-form-input" id="nik" name="nik" Required>
            </div>
            <div class="form-group">
                <label for="nama" class="custom-form-label">Nama:</label>
                <input type="text" class="form-control custom-form-input" id="nama" name="nama" Required>
            </div>
            <div class="form-group">
                <label for="statusKerja" class="custom-form-label">Status Kerja:</label>
                <select  class="form-control custom-form-input" name="statusKerja" id="statusKerja" Required>
                  <option value="Tetap">Tetap</option>
                  <option value="Tidak Tetap">Tidak Tetap</option>
                </select>
            </div>
            <div class="form-group">
                <label for="posisi" class="custom-form-label">Posisi:</label>
                <input type="text" class="form-control custom-form-input" id="posisi" name="posisi" Required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="responsibility" class="custom-form-label">Responsibility(30%):</label>
                <input type="text" class="form-control custom-form-input" id="responsibility" name="responsibility" oninput="calculateTotalAndGrade();" Required>
            </div>
            <div class="form-group">
                <label for="teamWork" class="custom-form-label">Team Work(30%):</label>
                <input type="text" class="form-control custom-form-input" id="teamWork" name="teamWork" oninput="calculateTotalAndGrade();" Required>
            </div>
            <div class="form-group">
                <label for="time" class="custom-form-label" >Management Time(40%):</label>
                <input type="text" class="form-control custom-form-input" id="time" name="time" oninput="calculateTotalAndGrade();" Required>
            </div>
            <div class="form-group">
                <label for="total" class="custom-form-label">Total:</label>
                <input type="text" class="form-control custom-form-input" style="background-color: orange;" id="total" name="total"  readonly>
            </div>
            <div class="form-group">
                <label for="grade" class="custom-form-label">Grade:</label>
                <input type="text" class="form-control custom-form-input" style="background-color: lightblue" id="grade" name="grade" readonly>
            </div>
          </form>
        </div>
      </div>
      <div class="tabel">
        <div class="row">
          <table class="table table-striped table-hover table-bordered" id="data-table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Status Kerja</th>
                <th>Posisi</th>
                <th>Total</th>
                <th>Grade</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody id="data-table-body">
              <?php 
              include("repository/selectAllData.php");
              showData($con);
              ?>
              </tbody>
            </table>
            
          </div>
          
        </div>
        
      </div>

      <script>
          var karyawanData = <?= json_encode($karyawan); ?>;
          karyawan = karyawanData;
      </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   </body>
</html>