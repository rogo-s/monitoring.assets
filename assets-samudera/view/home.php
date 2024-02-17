<!DOCTYPE html>
<html>

<head>
  <title>Website to-do</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    header img {
      width: auto;
      height: 50px;
      margin-right: 10px;
    }

    table {
      border-collapse: collapse;
      width: 400px;
      margin-top: 30px;
    }

    .table-responsive {
      overflow: hidden;
      max-height: 0;
      transition: max-height 0.3s ease;
      overflow: auto;
      /* Tambahkan ini */
    }

    .show-table .table-responsive {
      max-height: 1000px;
      /* Atur tinggi maksimum sesuai kebutuhan */
      transition: max-height 0.3s ease;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    /* punya button add */
    .btn-add {
      margin-right: 10px;
      background-color: #4caf50;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      -webkit-border-radius: 28px 28px 28px 28px;
      -moz-border-radius: 28px 28px 28px 28px;
      border-radius: 28px 28px 28px 28px;
      -webkit-box-shadow: 5px -5px 10px 2px rgba(194, 255, 215, 1);
      box-shadow: 5px -5px 10px 2px rgba(194, 255, 215, 1);
      transition: background-color 0.3s;
    }

    .btn-add:hover {
      background: #8e9de6;
      background: linear-gradient(39deg, #8e9de6 0%, #fb98ac 100%);
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="https://static.republika.co.id/uploads/images/inpicture_slide/logo-pt-samudera-indonesia-_170525165141-844.jpg" alt="Logo" style="width: 50px; height: 50px;">
          To-Do List
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container">
    <div class="row justify-content-left mt-5">
      <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
          <div class="card-body">Assets Monitoring</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <button class="small text-white stretched-link btn btn-transparent btn-sm assets-monitoring" style="color:white" id="toggleButton">Click to See</button>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">Device_id</th>
            <th scope="col">User_id</th>
            <th scope="col">Device_type</th>
            <th scope="col">Serial_number</th>
            <th scope="col">Brand_id</th>
            <th scope="col">Tipe_laptop</th>
            <th scope="col">Windows_id</th>
            <th scope="col">Domain_id</th>
            <th scope="col">Antivirus_id</th>
            <th scope="col">Status_device</th>
            <th scope="col">Bast_files</th>
            <th scope="col">Status</th>
            <th scope="col">Detail</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>user123</td>
            <td>laptop</td>
            <td>ABC123</td>
            <td>1</td>
            <td>ThinkPad X1 Carbon</td>
            <td>Windows 10</td>
            <td>example.com</td>
            <td>123456</td>
            <td>active</td>
            <td>files.pdf</td>
            <td>OK</td>
            <td>
              <a class="btn btn-primary btn-sm" href="profile.php">Detail</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <script>
    // Menangkap elemen tombol dan tabel
    var toggleButton = document.getElementById("toggleButton");
    var tableContainer = document.querySelector(".table-responsive");

    // Mendapatkan status terakhir dari local storage saat halaman dimuat
    var tableStatus = localStorage.getItem("tableStatus");

    // Memeriksa status terakhir dan mengatur tampilan tabel
    if (tableStatus === "hidden") {
      tableContainer.style.maxHeight = "0";
    } else {
      tableContainer.style.maxHeight = tableContainer.scrollHeight + "px";
    }

    // Menambahkan event listener saat tombol diklik
    toggleButton.addEventListener("click", function() {
      // Toggle class "show-table" pada elemen tabel container
      tableContainer.classList.toggle("show-table");

      // Mengupdate status terakhir pada local storage
      if (tableContainer.classList.contains("show-table")) {
        tableContainer.style.maxHeight = tableContainer.scrollHeight + "px";
        localStorage.setItem("tableStatus", "visible");
      } else {
        tableContainer.style.maxHeight = "0";
        localStorage.setItem("tableStatus", "hidden");
      }
    });
  </script>


  <footer>
    <p>&copy; 2023 Website Monitoring list. All rights reserved.</p>
  </footer>

</body>

</html>