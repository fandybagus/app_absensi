<?php
session_start();

if (isset($_SESSION['userlogin'])) {
    require_once('../../config/koneksidb.php');
    require_once('../../config/general.php');

    // Check if data is submitted via GET method for delete action
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['delete_id'])) {
        // If it's a delete action, retrieve delete_id
        $delete_id = $_GET['delete_id'];

        // Prepare and execute DELETE statement
        $query = "DELETE FROM tst_absensi WHERE idabsensi = ?";
        $statement = $cn_mysql->prepare($query);
        $statement->bind_param("i", $delete_id);

        if ($statement->execute()) {
            // If successful, show alert and redirect
            echo "<script>alert('Data berhasil dihapus'); window.location.href='../home.php';</script>";
            exit();
        } else {
            // If error, show alert and redirect
            echo "<script>alert('Terjadi kesalahan saat menghapus data'); window.location.href='../home.php';</script>";
            exit();
        }
    }

    // Check if data is submitted via POST method for add or edit action
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Initialize variables
        $process = "add"; // This might be used for other purposes in this file
        $edit_id = null;

        // Retrieve form data
        $tgl_absensi = $_POST['tgl_absensi'];
        $nm_mahasiswa = $_POST['nm_mahasiswa'];
        $nm_dosen = $_POST['nm_dosen'];
        $matkul = $_POST['matkul'];
        $absensi = $_POST['absensi'];
        $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : ''; // Tetapkan nilai default jika tidak ada yang dikirimkan
        $createdby = $_POST['createdby'];
        // $original_keterangan = $_POST['original_keterangan'];

        // Check if all form fields are filled
        if (empty($tgl_absensi) || empty($nm_mahasiswa) || empty($nm_dosen) || empty($matkul) || $absensi == "" || empty($createdby)) {
            // Show alert if any field is empty
            echo "<script>alert('Semua kolom harus diisi'); window.location.href='add_absen.php';</script>";
            exit();
        }

        // Determine if it's an add or edit action
        if ($_POST['action'] == 'edit' && isset($_POST['edit_id'])) {
            // If it's an edit action, retrieve edit_id
            $edit_id = $_POST['edit_id'];
            $process = "edit";
          
        } elseif ($_POST['action'] == 'delete' && isset($_POST['delete_id'])) {
            // If it's a delete action, retrieve delete_id
            $delete_id = $_POST['delete_id'];

            // Prepare and execute DELETE statement
            $query = "DELETE FROM tst_absensi WHERE idabsensi = ?";
            $statement = $cn_mysql->prepare($query);
            $statement->bind_param("i", $delete_id);

            if ($statement->execute()) {
                // If successful, show alert and redirect
                echo "<script>alert('Data berhasil dihapus'); window.location.href='../home.php';</script>";
                exit();
            } else {
                // If error, show alert and redirect
                echo "<script>alert('Terjadi kesalahan saat menghapus data'); window.location.href='../home.php';</script>";
                exit();
            }
        }
        
        // Perform database operation based on process type
        if ($process == "add") {
            // Perform insertion
            $query = "INSERT INTO tst_absensi (tgl_absensi, nm_mahasiswa, nm_dosen, matkul, absensi, keterangan, createdby) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $statement = $cn_mysql->prepare($query);
            $statement->bind_param("ssssiss", $tgl_absensi, $nm_mahasiswa, $nm_dosen, $matkul, $absensi, $keterangan, $createdby);
        } elseif ($process == "edit" && $edit_id) {
            // Perform update
            $query = "UPDATE tst_absensi SET tgl_absensi=?, nm_mahasiswa=?, nm_dosen=?, matkul=?, absensi=?, keterangan=?, createdby=? WHERE idabsensi=?";
            $statement = $cn_mysql->prepare($query);
            $statement->bind_param("ssssissi", $tgl_absensi, $nm_mahasiswa, $nm_dosen, $matkul, $absensi, $keterangan, $createdby, $edit_id);
        }
        
        // Execute query
        if ($statement->execute()) {
            // If successful, show alert and redirect
            echo "<script>alert('Data berhasil disimpan'); window.location.href='../home.php';</script>";
            exit();
        } else {
            // If error, show alert and redirect
            echo "<script>alert('Terjadi kesalahan saat menyimpan data'); window.location.href='add_absen.php';</script>";
            exit();
        }
        
    } else {
        // If no data is submitted via POST, show error message
        echo "<script>alert('Terjadi kesalahan saat menyimpan data'); window.location.href='add_absen.php';</script>";
    }
}

?>
