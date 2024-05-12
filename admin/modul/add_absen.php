<?php
session_start();

// Fungsi untuk mengarahkan pengguna kembali ke halaman home.php
function redirectToHome() {
    echo "window.location.href = '../home.php';";
}

if (isset($_SESSION['userlogin'])) {
    require_once('../../config/koneksidb.php');
    require_once('../../config/general.php');

    // Check if edit mode is activated
    $edit_mode = false;
    $data_to_edit = []; // Initialize an empty array to hold data if in edit mode

    if (isset($_GET['edit_id'])) {
        // Fetch data to be edited from the database based on the edit_id
        $edit_mode = true;
        $edit_id = $_GET['edit_id'];

        // Perform database query to fetch data based on edit_id, replace this with your actual query
        $query = "SELECT * FROM tst_absensi WHERE idabsensi = $edit_id";
        $result = mysqli_query($cn_mysql, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $data_to_edit = mysqli_fetch_assoc($result);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/add.css">
    <!-- icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body class="bg-info">
    <div class="container d-flex flex-column align-items-center box">
        <h2><?php echo $edit_mode ? 'Form Edit Absensi' : 'Form Input Absensi'; ?></h2>
        <form action="prosesinput.php" method="POST" class="">
            <input type="hidden" name="action" value="<?php echo $edit_mode ? 'edit' : 'add'; ?>">
            <?php if ($edit_mode) : ?>
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
            <?php endif; ?>
            <div class="row mb-3">
                <label for="tanggal" class="col-sm-5 col-form-label">Tanggal:</label>
                <div class="col-sm-7">
                    <input type="datetime-local" class="form-control" id="tanggal" name="tgl_absensi" required value="<?php echo $edit_mode ? $data_to_edit['tgl_absensi'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="nama_mahasiswa" class="col-sm-5 col-form-label">Nama Mahasiswa:</label>
                <div class="col-sm-7">
                    <select class="form-select" id="nama_mahasiswa" name="nm_mahasiswa" required>
                        <option selected disabled>Pilih Nama Mahasiswa</option>
                        <?php
                        // Assuming $data_to_edit contains data fetched from the database
                        $mahasiswa_options = ["dimas", "aditya", "fajar saputra", "doni setiawan", "anggun citra"];
                        foreach ($mahasiswa_options as $option) {
                            $selected = ($data_to_edit['nm_mahasiswa'] == $option) ? "selected" : "";
                            echo "<option value=\"$option\" $selected>$option</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="nama_dosen" class="col-sm-5 col-form-label">Nama Dosen:</label>
                <div class="col-sm-7">
                    <select class="form-select" id="nama_dosen" name="nm_dosen" required>
                        <option selected disabled>Pilih Nama Dosen</option>
                        <?php
                        // Assuming $data_to_edit contains data fetched from the database
                        $dosen_options = ["defranka", "panji putra", "vena aulia"];
                        foreach ($dosen_options as $option) {
                            $selected = ($data_to_edit['nm_dosen'] == $option) ? "selected" : "";
                            echo "<option value=\"$option\" $selected>$option</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="matakuliah" class="col-sm-5 col-form-label">Matakuliah:</label>
                <div class="col-sm-7">
                    <select class="form-select" id="matakuliah" name="matkul" required>
                        <option selected disabled>Pilih Matakuliah</option>
                        <?php
                        // Assuming $data_to_edit contains data fetched from the database
                        $matkul_options = [
                            ["value" => "programming", "label" => "programming"],
                            ["value" => "bahasa inggris", "label" => "bahasa inggris"],
                            ["value" => "database", "label" => "database"],
                            ["value" => "akutansi", "label" => "akutansi"],
                            ["value" => "design graphic", "label" => "design graphic"],
                        ];
                        foreach ($matkul_options as $option) {
                            $selected = ($data_to_edit['matkul'] == $option['value']) ? "selected" : "";
                            echo "<option value=\"{$option['value']}\" $selected>{$option['label']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="absensi" class="col-sm-5 col-form-label">Absensi:</label>
                <div class="col-sm-7">
                    <select class="form-select" id="absensi" name="absensi" required>
                        <option selected disabled>Pilih Absensi</option>
                        <?php
                        // Assuming $data_to_edit contains data fetched from the database
                        $absensi_options = [
                            ["value" => "1", "label" => "Hadir"],
                            ["value" => "2", "label" => "Sakit"],
                            ["value" => "0", "label" => "Alpha"]
                        ];
                        foreach ($absensi_options as $option) {
                            $selected = ($data_to_edit['absensi'] == $option['value']) ? "selected" : "";
                            echo "<option value=\"{$option['value']}\" $selected>{$option['label']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="keterangan" class="col-sm-5 col-form-label">Keterangan:</label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="keterangan" id="keterangan"><?php echo $edit_mode ? $data_to_edit['keterangan'] : ''; ?></textarea>
                </div>
            </div>

            <input type="hidden" name="createdby" value="<?php echo $_SESSION['loginname']; ?>">

            <div class="row mb-3">
                <div class="col-sm-5"></div>
                <div class="col-sm-7">
                    <button type="button" class="btn btn-danger" onclick="<?php redirectToHome(); ?>">Batal</button>
                    <button type="submit" class="btn btn-primary"><?php echo $edit_mode ? 'Update' : 'Simpan'; ?></button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
} else {
    // Handle when user is not logged in
    // Redirect or show an error message
}
?>
