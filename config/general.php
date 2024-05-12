<?php 
$date_today = date("d-m-Y");
$date_day = date("D");
$company = "PT. ASE Software House";

//fungsi denga parameter yang mempunyai default/nilai awal 
function title ($tl= NULL){
    if ($tl == NULL){
        echo "tanggal hari ini : ".$GLOBALS["date_day"],",".$GLOBALS["date_today"];
    }
    else 
        echo $tl;
}
function back($url){
    echo "<meta http-equiv=\"REFRESH\" content=\"0;url=".$url."\">";
}
function notif($pesan){
    echo "<script>alert('$pesan');</script>";
}
?>
