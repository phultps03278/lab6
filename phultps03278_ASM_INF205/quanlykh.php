<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="js/jquery.mobile-1.4.5.min.css">
 

	<script src="js/jquery.js"></script>
	
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
</head>
<style>
#body{
	background:url(img/glasses.jpg);
	
	
}
#menu{
	padding : 20px;
	background: #CCFFCC;

}
#menu a{
	margin : 200px;
	text-decoration:none;
	text-shadow:none;
	color: black;
}
#menu img{
	margin-top : -15px;
}
#content{
	width:80%;
	margin:0 auto;
	padding :10px;
	background:skyblue;
	margin-top:10px;
	text-align:center;
	border-radius:10px;
}
#box{
	background : skyblue;
	padding:10px;
	width :80%;
	margin : 0 auto;
	border-radius:10px;
}
td input #delete{
	width:50px;
}

</style>
<body>
<div data-role="page" id="index">
<div id="body">
<div id="menu"><img src="img/logo.jpg" width="100" height="50" align="left"/><a href="index.php">Quản lý sản phẩm</a> |
 <a href="#qlkh">Quản lý khách hàng</a></div>

<div id="content">
<div data-role="tabs" id="tabs2">
  <div data-role="navbar">
    <ul>
      <li><a href="#mot" data-ajax="false">Danh sách khách hàng</a></li>
      <li><a href="#hai" data-ajax="false">Thêm khách hàng</a></li>
      <li><a href="#ba" data-ajax="false">Sửa khách hàng</a></li>
    </ul>
  </div>
  <div id="mot" class="ui-body-d ui-content">
     <?php


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "quanlymatkinh_ps03278");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
	
}
if(isset($_POST['deletekh'])){
$idkhx = $_POST['idkhx'];
$sql = "delete from khachhang where ID_KH = '$idkhx'";
if(mysqli_query($link, $sql)){
    echo "Xoá thành công";
	header("Refresh:0;url=index.php#qlkh;");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
} 

}
// Attempt select query execution
$sql = "SELECT * FROM khachhang";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		echo "<form method='post' action='index.php#qlkh' >";
        echo "<table>";
		
            echo "<tr>";
                echo "<th>Mã khách hàng</th>";
                echo "<th>Tên khách hàng</th>";
                echo "<th>Số điện thoại</th>";
                echo "<th>Email</th>";
				echo "<th>Địa chỉ</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
			
			echo "<input type='hidden' name = 'idkhx' value ='".$row['ID_KH']."'>";
            echo "<tr>";
                echo "<td>" . $row['ID_KH'] . "</td>";
                echo "<td>" . $row['HoTen'] . "</td>";
                echo "<td>" . $row['SDT'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
				echo "<td>" . $row['DiaChi'] . "</td>";
				echo "<td><input type='submit' id='deletekh' name='deletekh' value='Xóa' ></td>"; 
				
            echo "</tr>";
			
        }
		
        echo "</table>";
		echo "</form>";
        // Close result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

 
// Close connection
mysqli_close($link);
?>
  </div>
  <div id="hai">
    <script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
            $("#notification3").text(data);
			
			
        }
  
        function onError(data, status)
        {
            // handle an error
        }        
  
        $(document).ready(function() {
            $("#submit3").click(function(){
  
                var formData = $("#callAjaxForm3").serialize();
  
                $.ajax({
                    type: "POST",
                    url: "themkh.php",
                    cache: false,
                    data: formData,
                    success: onSuccess,
                    error: onError
					
                });
  
                return false;
            });
        });
    </script>
    <div id="box">
	<form id="callAjaxForm3" action="index.php">
    	<input type="text" name="idkh"  placeholder="Mã khách hàng"/>
        <input type="text" name="tenkh" placeholder="Tên khách hàng"/>
        <input type="text" name="sdt" placeholder="Số điện thoại"/>
        <input type="text" name="email" placeholder="Email"/>
        <input type="text" name="diachi" placeholder="Địa chỉ"/>
  
        <button type="submit" id="submit3" >Hoàn tất</button>
        <button type="reset" >Huỷ</button>
    </form>

    
  </div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>