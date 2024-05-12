<?php 
  require_once('../config/koneksidb.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="../assets/style.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- internal javascript -->
</head>
<body class="bg-black t1">
  <div class="container d-flex flex-column align-items-center py-5 ptop100">
      <h2 id="judul">Halaman Login</h2>
      <form action="ceklogin.php" method="post" class="box">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <!-- <img id="gambar" > -->
            <input name= "inusername" type="text" class="form-control" id="username" aria-describedby="emailHelp" 
              oninvalid="this.setCustomValidity('Username belum diisi')" required
              oninput="setCustomValidity('')" 
              >
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="inpassword" type="password" class="form-control" id="password" required
              oninvalid="this.setCustomValidity('Password belum diisi')"
              oninput="setCustomValidity('')">
          </div>
          <button type="submit" class="btn btn-primary form-control">
            <i class="bi bi-lock-fill"></i> Login
          </button>
        </form>
  </div>  




  <!-- JS bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>