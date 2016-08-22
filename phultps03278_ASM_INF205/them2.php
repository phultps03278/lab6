<?php

$link = mysqli_connect("mysql.hostinger.vn", "u109554928_data1", "97408530", "u109554928_data");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$id = mysqli_real_escape_string($link, $_POST['id']);
$ten = mysqli_real_escape_string($link, $_POST['ten']);
$gia = mysqli_real_escape_string($link, $_POST['gia']);
$tinhtrang = mysqli_real_escape_string($link, $_POST['tinhtrang']);
$hinh = mysqli_real_escape_string($link, $_POST['hinh']);
$loai = mysqli_real_escape_string($link, $_POST['loai']);
 

$sql = "INSERT INTO sanpham (ID_SP, TenSP, Gia, TinhTrang, HinhSP, ID_LSP) 
	VALUES('$id', '$ten', '$gia', '$tinhtrang', '$hinh', '$loai')";
if(mysqli_query($link, $sql)){
    echo "Thêm Thành Công.";
	header("Refresh:0;index.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

mysqli_close($link);
?>