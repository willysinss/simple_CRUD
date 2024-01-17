const now = new Date();


function dateNow() {
  const dateNowElements = document.getElementsByClassName("date--now--dd-mm-yyyy")

  Array.from(dateNowElements).forEach((element) => {
    element.textContent += formatDate(now, "-");
  })

}

function getYear() {
  const dateNowElements = document.getElementsByClassName("date--now-yyyy")

  Array.from(dateNowElements).forEach((element) => {
    element.textContent += now.getFullYear()
  })
}

function formatDate(date, separator) {
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();
  return `${day}${separator}${month}${separator}${year}`;
}


function getDataByNik(nikToEdit) {
  for (var i = 0; i < karyawan.length; i++) {
    if (karyawan[i].nik === nikToEdit) {
      return karyawan[i];
    }
  }
  return null; // Mengembalikan null jika data tidak ditemukan
}


    var karyawan = [];

    function editData(button) {
        // Ambil data yang sesuai dari baris yang sesuai
        var nikToEdit = button.getAttribute('data-nik');
        var fotoPath = button.getAttribute('data-foto');
        //merubah tombol simpan menjadi tombol update
        document.getElementById('operation').value = 'update';

        // Cari data yang sesuai berdasarkan NIK
        var dataToEdit = karyawan.find(function (data) {
            return data.nik === nikToEdit;
        });

        if (dataToEdit) {


            // Isi formulir dengan data yang sesuai
            document.getElementById('editForm').setAttribute('data-nik', nikToEdit);
            document.getElementById('nik').value = dataToEdit.nik;
            document.getElementById('nama').value = dataToEdit.nama;
            document.getElementById('tanggalPenilaian').value = dataToEdit.tgl_penilaian;
            document.getElementById('statusKerja').value = dataToEdit.status_kerja;
            document.getElementById('posisi').value = dataToEdit.posisi;
            document.getElementById('responsibility').value = dataToEdit.responsibility;
            document.getElementById('teamWork').value = dataToEdit.teamwork;
            document.getElementById('time').value = dataToEdit.management_time;
            document.getElementById('total').value = dataToEdit.total;
            document.getElementById('grade').value = dataToEdit.grade;

            // Tampilkan gambar profil yang sesuai
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('imagePreview').src = fotoPath;

            // Sembunyikan tabel
            document.getElementById('data-table').style.display = 'none';

            // Ubah teks tombol "Simpan"
          }
          document.getElementById('simpan').innerHTML = 'Update';
    }

    function viewData(button) {
      // Ambil data yang sesuai dari baris yang sesuai
      var nikToView = button.getAttribute('data-nik');
      var fotoPath = button.getAttribute('data-foto');
  
      // Cari data yang sesuai berdasarkan NIK
      var dataToView = karyawan.find(function (data) {
          return data.nik === nikToView;
      });
  
      if (dataToView) {
          // Isi formulir dengan data yang sesuai
          document.getElementById('nik').value = dataToView.nik;
          document.getElementById('nama').value = dataToView.nama;
          document.getElementById('tanggalPenilaian').value = dataToView.tgl_penilaian;
          document.getElementById('statusKerja').value = dataToView.status_kerja;
          document.getElementById('posisi').value = dataToView.posisi;
          document.getElementById('responsibility').value = dataToView.responsibility;
          document.getElementById('teamWork').value = dataToView.teamwork;
          document.getElementById('time').value = dataToView.management_time;
          document.getElementById('total').value = dataToView.total;
          document.getElementById('grade').value = dataToView.grade;
  
          // Tampilkan gambar profil yang sesuai
          document.getElementById('imagePreview').style.display = 'block';
          document.getElementById('imagePreview').src = fotoPath;

          // hilangkan tombol simpan dan clear
          document.getElementById('simpan').style.display='none';
          document.getElementById('clear').style.display='none';
  
          // Menonaktifkan semua elemen dalam formulir
          var inputFoto = document.getElementById('fileInput');
          inputFoto.disabled=true;

          var formElements = document.getElementById('editForm').elements;
          for (var i = 0; i < formElements.length; i++) {
              formElements[i].readOnly = true;

              // Nonaktifkan elemen select
              if (formElements[i].tagName === 'SELECT') {
                  formElements[i].disabled = true;
              }
          }
          document.getElementById('data-table').style.display = 'none';
        }
    }
  
      // Tampilkan konfirmasi penghapusan
      function deleteData(button) {
        var nik = button.getAttribute('data-nik');
    
        if (confirm('Menghapus data dengan NIK: ' + nik)) {
            fetch('./repository/deleteAction.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'nik=' + nik,
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    var row = button.closest('tr');
                    row.parentNode.removeChild(row);
                } else {
                    alert('Gagal menghapus data:\n' + data);
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan saat menghapus data:\n' + error);
                console.error(error);
            });
        }
    }
    
    
    
    
  
  
     function showTable() {

      document.getElementById('operation').value = 'simpan';


        // Tampilkan kembali tabel
        document.getElementById('data-table').style.display = 'table';
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('simpan').style.display='block';
        document.getElementById('clear').style.display='block';

        // mengaktifkan kembali semua elemen dalam formulir
        var inputFoto = document.getElementById('fileInput');
          inputFoto.disabled=false;
        var formElements = document.getElementById('editForm').elements;
        for (var i = 0; i < formElements.length; i++) {
            formElements[i].readOnly = false;

            // aktifkan elemen select
            if (formElements[i].tagName === 'SELECT') {
                formElements[i].disabled = false;
            }
        }
        // Set tombol "Simpan" kembali ke fungsi aslinya
        document.getElementById('simpan').innerHTML = 'Simpan';;
    }

// Fungsi untuk menghitung total dan grade
function calculateTotalAndGrade() {
  const responsibility = parseFloat(document.getElementById('responsibility').value) || 0;
  const teamWork = parseFloat(document.getElementById('teamWork').value) || 0;
  const time = parseFloat(document.getElementById('time').value) || 0;

  const total = (responsibility * 0.3) + (teamWork * 0.3) + (time * 0.4);
  document.getElementById('total').value = total.toFixed(2);

  let grade = '';
  if (total >= 80) {
    grade = 'A';
  } else if (total >= 70) {
    grade = 'B';
  } else if (total >= 50) {
    grade = 'C';
  } else {
    grade = 'D';
  }
  document.getElementById('grade').value = grade;
}

// Menambahkan event listener ke kolom-kolom input
document.getElementById('responsibility').addEventListener('input', calculateTotalAndGrade);
document.getElementById('teamWork').addEventListener('input', calculateTotalAndGrade);
document.getElementById('time').addEventListener('input', calculateTotalAndGrade);

window.onload = () => {
  show();
  dateNow();
  getYear();
};
