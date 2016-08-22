<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("mysql.hostinger.vn", "u109554928_data1", "97408530", "u109554928_data");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt update query execution
$idkhs = mysqli_real_escape_string($link, $_POST['idkhs']);
$tenkhs = mysqli_real_escape_string($link, $_POST['tenkhs']);
$sdts = mysqli_real_escape_string($link, $_POST['sdts']);
$emails = mysqli_real_escape_string($link, $_POST['emails']);
$diachis = mysqli_real_escape_string($link, $_POST['diachis']);
$sql = "UPDATE khachhang SET HoTen='$tenkhs', SDT =$sdts, Email ='$emails', DiaChi ='$diachis' WHERE ID_KH =$idkhs";
if(mysqli_query($link, $sql)){
    echo "Sửa Thành Công";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>