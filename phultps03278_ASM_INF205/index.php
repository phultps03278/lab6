<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PS03278</title>
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
	background: #CCFFFF;

}
#menu a{
	margin : 100px;
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
#footer{
	background: #CCFFFF;
	text-align:center;
	padding :20px;
	margin-top :10px;
}

</style>

<body>


<div data-role="page" id="index">
<div id="body">
<div id="menu"><img src="img/logo.jpg" width="100" height="50" align="left"/><a href="#index">Quản lý sản phẩm</a> |
 <a href="#qlkh">Quản lý khách hàng</a> | <a href="#hoadon">Quản lý hoá đơn</a> </div>

<div id="content">
<div data-role="tabs" id="tabs">
  <div data-role="navbar">
    <ul>
      <li><a href="#one" data-ajax="false">Danh sách sản phẩm</a></li>
      <li><a href="#two" data-ajax="false">Thêm sản phẩm</a></li>
      <li><a href="#three" data-ajax="false">Sửa sản phẩm</a></li>
    </ul>
  </div>
  <div id="one" class="ui-body-d ui-content">
  <h3>Danh sách sản phẩm</h3>
    <?php


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("mysql.hostinger.vn", "u109554928_data1", "97408530", "u109554928_data");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
	
}
if(isset($_POST['delete'])){
$idx = $_POST['idx'];
$sql = "DELETE FROM sanpham WHERE ID_SP = '$idx'";
if(mysqli_query($link, $sql)){
    echo "Xoá thành công '$idx'";
	header("Refresh:0;url=index.php;");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
} 

}
// Attempt select query execution
$sql = "SELECT * FROM sanpham";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		echo "<form method='post' action='index.php' >";
        echo "<center><table  border='1' >";
		
            echo "<tr>";
                echo "<th>Mã Sản Phẩm</th>";
                echo "<th>Tên sản phẩm</th>";
                echo "<th>Hình sản phẩm</th>";
                echo "<th>Giá </th>";
				echo "<th>Tình trạng</th>";
				echo "<th>Loại sản phẩm</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
			
			
            echo "<tr>";
				
                echo "<td><center>" . $row['ID_SP'] . "</center></td>";
                echo "<td>" . $row['TenSP'] . "</td>";
                echo "<td>";?> <img src="img/<?php  echo  $row['HinhSP'] ;?> "height="100" width="120" /><?php "</td>";
                echo "<td>" . $row['Gia'] . "</td>";
				echo "<td>" . $row['TinhTrang'] . "</td>";
				echo "<td><center>" . $row['ID_LSP'] . "</center></td>";
				echo "<input type='hidden' name = 'idx' id='idx' value ='".$row['ID_SP']."'>";
				echo "<td><input type='submit' id='delete' name='delete' value='Xóa' ></td></center>"; 
				
				
            echo "</tr>";
			
        }
		
        echo "</table><center></center>";
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
  <div id="two">
    <script>
		function myFunction() {
    	location.reload();
		}
        function onSuccess1(data, status)
        {
            data = $.trim(data);
            $("#notification1").text(data);
			myFunction();
			
        }
  
        function onError(data, status)
        {
            // handle an error
        }        
  
        $(document).ready(function() {
            $("#submit1").click(function(){
  
                var formData = $("#callAjaxForm1").serialize();
  
                $.ajax({
                    type: "POST",
                    url: "them2.php",
                    cache: false,
                    data: formData,
                    success: onSuccess1,
                    error: onError
					
                });
  
                return false;
            });
        });
    </script>
    <div id="box">
    <h3>Thêm sản phẩm</h3>
	<form id="callAjaxForm1" action="index.php">
    	<input type="text" name="id"  placeholder="Mã sản phẩm" />
        <input type="text" name="ten" placeholder="Tên sản phẩm"/>
        <input type="text" name="gia" placeholder="Giá"/>
        <input type="text" name="tinhtrang" placeholder="Tình trạng"/>
        <input type="text" name="hinh" placeholder="Hình ảnh"/>
        <input type="text" name="loai" placeholder="Loại sản phẩm từ 1 -> 5"/>
  		<h3 id="notification1"></h3>
        <input type="submit" value="Thêm" id="submit1" />
        <button type="reset" >Huỷ</button>
    </form>
</div>
  </div>
  <div id="three" >
    <script>
		function myFunction() {
    		location.reload();
		}
        function onSuccess2(data, status)
        {
            data = $.trim(data);
            $("#notification2").text(data);
			myFunction()
        }
  
        function onError(data, status)
        {
            // handle an error
        }        
  
        $(document).ready(function() {
            $("#submit2").click(function(){
  
                var formData = $("#callAjaxForm2").serialize();
  
                $.ajax({
                    type: "POST",
                    url: "update.php",
                    cache: false,
                    data: formData,
                    success: onSuccess2,
                    error: onError
                });
  
                return false;
            });
        });
    </script>
    <div id="box">
    <h3>Sửa sản phẩm</h3>
	<form id="callAjaxForm2" action="index.php">
    	<input type="text" name="ids"  placeholder="Mã sản phẩm"/>
        <input type="text" name="tens" placeholder="Tên sản phẩm"/>
        <input type="text" name="gias" placeholder="Giá"/>
        <input type="text" name="tinhtrangs" placeholder="Tình trạng"/>
        <input type="text" name="hinhs" placeholder="Hình ảnh"/>
        <input type="text" name="loais" placeholder="Loại sản phẩm từ 1 -> 5"/>
        <h3 id="notification2"></h3>
        <button type="submit" id="submit2"  >Hoàn tất</button>
        <button type="reset" >Huỷ</button>
    </form>
</div>
  </div>
</div>
</div>
<div id="footer">
<div class="text">Tên : <b>Lồ Thành Phú</b>  |  MSSV : <b>PS03278</b>  |  
Lớp : <b>PT10307</b></div>
</div>
</div>
</div>

<div data-role="page" id="qlkh">
<div id="body">
<div id="menu"><img src="img/logo.jpg" width="100" height="50" align="left"/><a href="#index">Quản lý sản phẩm</a> |
 <a href="#qlkh">Quản lý khách hàng</a> | <a href="#hoadon">Quản lý hoá đơn</a> </div>

<div id="content">
<div data-role="tabs" id="tabs">
  <div data-role="navbar">
    <ul>
      <li><a href="#mot" data-ajax="false">Danh sách khách hàng</a></li>
      <li><a href="#hai" data-ajax="false">Thêm khách hàng</a></li>
      <li><a href="#ba" data-ajax="false">Sửa khách hàng</a></li>
    </ul>
  </div>
  <div id="mot" class="ui-body-d ui-content">
  <h3>Danh sách khách hàng</h3>
     <?php


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("mysql.hostinger.vn", "u109554928_data1", "97408530", "u109554928_data");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
	
}
if(isset($_POST['deleted'])){
$idp = $_POST['idp'];
$sql1 = "delete from khachhang where ID_KH = '$idp'";
if(mysqli_query($link, $sql1)){
    echo "Xoá thành công";
	header("Refresh:0;url=index.php#qlkh;");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
} 

}
// Attempt select query execution
$sql1 = "SELECT * FROM khachhang";
if($result = mysqli_query($link, $sql1)){
    if(mysqli_num_rows($result) > 0){
		echo "<form method='post' action='index.php#qlkh' >";
        echo "<center><table border='1'>";
		
            echo "<tr>";
                echo "<th>Mã khách hàng</th>";
                echo "<th>Tên khách hàng</th>";
                echo "<th>Số điện thoại</th>";
                echo "<th>Email</th>";
				echo "<th>Địa chỉ</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
			
			echo "<input type='hidden' id='idp' name = 'idp' value ='".$row['ID_KH']."'>";
            echo "<tr>";
                echo "<td><center>" . $row['ID_KH'] . "</center></td>";
                echo "<td>" . $row['HoTen'] . "</td>";
                echo "<td>" . $row['SDT'] . "</td>";
				echo "<td>" . $row['Email'] . "</td>";
				echo "<td>" . $row['DiaChi'] . "</td>";
				echo "<td><input type='submit' id='deleted' name='deleted' value='Xóa' ></td>"; 
				
            echo "</tr>";
			
        }
		
        echo "</table></center>";
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
	function myFunction() {
    		location.reload();
		}
        function onSuccess3(data, status)
        {
            data = $.trim(data);
            $("#notification3").text(data);
			myFunction();
			
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
                    success: onSuccess3,
                    error: onError
					
                });
  
                return false;
            });
        });
    </script>
    <div id="box">
    <h3>Thêm Khách Hàng</h3>
	<form id="callAjaxForm3" action="index.php">
    	<input type="text" name="idkh"  placeholder="Mã khách hàng"/>
        <input type="text" name="tenkh" placeholder="Tên khách hàng"/>
        <input type="text" name="sdt" placeholder="Số điện thoại"/>
        <input type="text" name="email" placeholder="Email"/>
        <input type="text" name="diachi" placeholder="Địa chỉ"/>
  		<h3 id="notification3"></h3>
        <button type="submit" id="submit3" >Hoàn tất</button>
        <button type="reset" >Huỷ</button>
    </form>

    
  </div>
</div>
<div id="ba">
<script>
	function myFunction() {
    		location.reload();
		}
        function onSuccess4(data, status)
        {
            data = $.trim(data);
            $("#notification4").text(data);
			myFunction();
		
			
        }
  
        function onError(data, status)
        {
            // handle an error
        }        
  
        $(document).ready(function() {
            $("#submit4").click(function(){
  
                var formData = $("#callAjaxForm4").serialize();
  
                $.ajax({
                    type: "POST",
                    url: "updatekh.php",
                    cache: false,
                    data: formData,
                    success: onSuccess4,
                    error: onError
					
                });
  
                return false;
            });
        });
    </script>
    <div id="box">
    <h3>Sửa Khách Hàng</h3>
	<form id="callAjaxForm4" action="index.php">
    	<input type="text" name="idkhs"  placeholder="Mã khách hàng"/>
        <input type="text" name="tenkhs" placeholder="Tên khách hàng"/>
        <input type="text" name="sdts" placeholder="Số điện thoại"/>
        <input type="text" name="emails" placeholder="Email"/>
        <input type="text" name="diachis" placeholder="Địa chỉ"/>
  		<h3 id="notification4"></h3>
        <button type="submit" id="submit4" >Hoàn tất</button>
        <button type="reset" >Huỷ</button>
    </form>
    </div>
</div>
</div>
</div>
<div id="footer"><div class="text">Tên : <b>Lồ Thành Phú</b>  |  MSSV : <b>PS03278</b>  |  
Lớp : <b>PT10307</b></div></div>
</div>
</div>

<div data-role="page" id="hoadon">
<div id="body">
<div id="menu"><img src="img/logo.jpg" width="100" height="50" align="left"/><a href="#index">Quản lý sản phẩm</a> |
 <a href="#qlkh">Quản lý khách hàng</a> | <a href="#hoadon">Quản lý hoá đơn</a> </div>

<div id="content">

  <h3>Danh sách hoá đơn</h3>
     <?php


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "quanlymatkinh_ps03278");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
	
}
// Attempt select query execution
$sql1 = "SELECT * FROM hoadon";
if($result = mysqli_query($link, $sql1)){
    if(mysqli_num_rows($result) > 0){
		echo "<form>";
        echo "<center><table border='1'>";
		
            echo "<tr>";
                echo "<th>Mã hoá đơn</th>";
                echo "<th>Mã khách hàng</th>";
                echo "<th>Tổng tiền hoá đơn</th>";
                echo "<th>Ngày xuất hoá đơn</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
			
            echo "<tr>";
                echo "<td>" . $row['ID_HD'] . "</td>";
                echo "<td>" . $row['ID_KH'] . "</td>";
				echo "<td>" . $row['TongTienHD'] . "</td>";
				echo "<td>" . $row['NgayHD'] . "</td>";
            echo "</tr>";
			
        }
		
        echo "</table></center>";
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
  <div id="footer"><div class="text">Tên : <b>Lồ Thành Phú</b>  |  MSSV : <b>PS03278</b>  |  
Lớp : <b>PT10307</b></div></div>
</div>
</body>
</html>