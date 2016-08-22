<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("mysql.hostinger.vn", "u109554928_data1", "97408530", "u109554928_data");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt update query execution
$ids = mysqli_real_escape_string($link, $_POST['ids']);
$tens = mysqli_real_escape_string($link, $_POST['tens']);
$gias = mysqli_real_escape_string($link, $_POST['gias']);
$tinhtrangs = mysqli_real_escape_string($link, $_POST['tinhtrangs']);
$hinhs = mysqli_real_escape_string($link, $_POST['hinhs']);
$loais = mysqli_real_escape_string($link, $_POST['loais']);

$sql = "UPDATE sanpham SET TenSP='$tens', Gia =$gias, TinhTrang ='$tinhtrangs', HinhSP ='$hinhs', ID_LSP =$loais WHERE ID_SP =$ids";
if(mysqli_query($link, $sql)){
    echo "Sửa Thành Công";
	header("Refresh:0;url=index.php");
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>