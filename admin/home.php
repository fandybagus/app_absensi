<?php
session_start();
// Jika pengguna mencoba untuk login

if (isset($_SESSION['userlogin'])) {
    require_once('../config/koneksidb.php');
    require_once('../config/general.php');
    
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/style.css">
        <!-- icon bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    </head>
    <?php
    if (!isset($_GET['action'])) {
    ?>
        <body class="bg-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mt-5">
                        <h5 id="title">Welcome : <?php echo $_SESSION['loginname']; ?></h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="row"></div>
                        <a href="logout.php" class="btn btn-danger tombol">Logout</a>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <table class="table table-dark table-striped my-2">
                            <thead>
                                <a href="modul/add_absen.php" class="btn btn-primary mt-3">Tambah data</a>
                                <tr>
                                    <th>No</th>
                                    <th>tanggal</th>
                                    <th>nama mahasiswa</th>
                                    <th>matkul</th>
                                    <th>absensi</th>
                                    <th>keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                //untuk mendapatkan sql query 
                                $statement_sql = $cn_mysql->prepare("SELECT * FROM tst_absensi");
                                //untuk mengeksekusi kode sql 
                                $statement_sql->execute();
                                $result = $statement_sql->get_result();
                                while ($data = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $data['tgl_absensi']; ?></td>
                                        <td><?php echo strtoupper(ucwords(strtolower($data['nm_mahasiswa']))); ?></td>
                                        <td><?php echo $data['matkul']; ?></td>
                                        <td><?php
                                            if ($data['absensi'] == 1) {
                                                echo "Hadir";
                                            } elseif ($data['absensi'] == 2) {
                                                echo "Sakit";
                                            } elseif ($data['absensi'] == 0) {
                                                echo "Tidak Hadir";
                                            } else {
                                                echo "Status Absensi Tidak Diketahui";
                                            }
                                            ?>
                                        </td>
                                        <td><?php
                                            if ($data['absensi'] == 1) {
                                                echo "";
                                            } elseif ($data['absensi'] == 2) {
                                                echo $data['keterangan'];
                                            } elseif ($data['absensi'] == 0) {
                                                echo "alpha";
                                            } else {
                                                echo "Status Absensi Tidak Diketahui";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="modul/add_absen.php?edit_id=<?=$data['idabsensi'];?>" class="btn btn-primary" title="Ubah Data"><i class="bi bi-pencil-fill mx-2"></i></a>
                                            <a href="modul/prosesinput.php?action=delete&delete_id=<?=$data['idabsensi'];?>" class="btn btn-danger" title="Hapus Data"><i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    <?php
    }
       
}else{
    
}
?>
