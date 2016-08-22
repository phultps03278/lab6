<?php

$link = mysqli_connect("mysql.hostinger.vn", "u109554928_data1", "97408530", "u109554928_data");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$idkh = mysqli_real_escape_string($link, $_POST['idkh']);
$tenkh = mysqli_real_escape_string($link, $_POST['tenkh']);
$sdt = mysqli_real_escape_string($link, $_POST['sdt']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$diachi = mysqli_real_escape_string($link, $_POST['diachi']);
 

$sql = "INSERT INTO khachhang (ID_KH, HoTen, SDT, Email, DiaChi) 
	VALUES('$idkh', '$tenkh', '$sdt', '$email', '$diachi')";
if(mysqli_query($link, $sql)){
    echo "Thêm Thành Công.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

mysqli_close($link);
?>