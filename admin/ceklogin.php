<?php 
    require_once('../config/koneksidb.php');
    //mendapatkan value dari inputan form dengan method post
    $out_user = $_POST['inusername'];
    //mendapatkan value dari inputan form dengan method post
    $out_pass = $_POST['inpassword'];

    // echo $out_user . $out_pass;
    //cek ke database apakah username yang ditampung variabel ada atau tidak
    $statment_sql = $cn_mysql->prepare("select*from mst_admin where username=?");
    
    //bagian dari parameter query sql yang menggunakan parameter untuk menghindari serangan sql injection
    //parameter "s" maksudnya value dari parameter berupa string
    $statment_sql->bind_param("s", $out_user); //fungsi out_user untuk mengisi tanda tanya pada statment sql
    //untuk mengesksekusi perintah sql
    $statment_sql->execute();
    //untuk menampung hasil dari eksekusi statment sql pada varabel result
    $result = $statment_sql->get_result();
    //untuk menampilka result
    // var_dump($result);
    //untuk menampung hasil statment berupajumlah row/data/record 
    $result_count = $result->num_rows;
    echo "hasilnya",$result_count;
    if ($result_count == 1) {
        // echo "user ditemukan lanjut cek password";
        //metode ini mengambil satu baris hasil objek dari result 
        //dalam bentuk array asossiatif, dimana kunci array adalah nama kolom dan nilai array
        $data = $result->fetch_assoc();
        //proses verifikasi password yang di inputkan sesuai atau tidak dengan yang ada di tabel mst_user 
        if(password_verify($out_pass, $data['password'])){
            notifikasi("password benar, login berhasil");
            //mulai membuat session
            session_start();
            //mendeklarasikan variabel session 
            $_SESSION['userlogin'] = $data['username'];
            $_SESSION['loginname'] = $data['fullname'];
            //direct atau berpindah ke halaman 
            header("location: home.php");
        }
        else 
         notifikasi("password salah, login gagal");
        back();
    }
    else 
        notifikasi("username tidak ditemukan");
        back();

    //function tanpa parameter 
    // function notifikasi(){
    //     //untuk menyisipkan file di dalam javascript harus di antara tag script
    //     echo "<script>alert('username tidak ditemukan');</script>";
    // }
    //function dengan parameter
    function notifikasi($pesan){
        //untuk menyisipkan file di dalam javascript harus di antara tag script
        echo "<script>alert('$pesan');</script>";
    }
    //cara menyisipkan tag link html ke 
    function back(){
        echo '<a href ="login.php">login kembali</a>';
    }
?>