<!DOCTYPE html>
<html lang="en">
<head>
   <?php
   // MySQLi connection
   require_once("../../database/connect.php"); 
   ?>
   <script language="JavaScript" type="text/javascript">
           function checkDelete(){
           return confirm('Are you sure?');
          }
    </script>         
</head>
<body>
	 <h1>Quản lý sản phẩm</h1>

	 <br>
	 <button><a href='../../index.php'><h4>Trang chủ</h4></a></button>
	 <button><a href='../admin_page.php'><h4>Quay lại</h4></a></button>
	 <button><a href='add.php'><h4>Thêm một sản phẩm mới</h4></a></button>
	 <br><br>
<?php
	echo "<table  border='1' bgcolor='#add8e6'>
			<tr align='center'>
				<th>STT</th>
				<th>Tên sản phẩm</th>
				<th>Hãng</th>
				<th width='20%'>Cấu hình</th>
				<th>Ảnh</th>
				<th>Giá</th>
				<th>Xóa</th>
				<th>Sửa</th>
			</tr>	
	";
	$sel_users = "select product.product_id,product.product_name,category.category_name, product.display,product.image,product.price from product join category on product.category_id=category.category_id";
	$run_users = mysqli_query($con, $sel_users);
	while($row=mysqli_fetch_array($run_users)){
		$p_id = $row['product_id'];
		$c_name = $row['category_name'];
		$p_name = $row['product_name'];
		$p_display = $row['display'];
		$p_price = $row['price'];
		$p_image = $row['image'];
	echo "<tr align='center'>
				<td>$p_id</td>
				<td>$p_name</td>
				<td>$c_name</td>
				<td>$p_display</td>
				<td><img height='70' width='90' src='images/".$p_image."'/></td>
				<td>$p_price đ</td>
				<td><a href='delete.php?del=$p_id' onclick='return checkDelete()'>Delete</a></td>
				<td><a href='update.php?edit=$p_id'>Edit</a></td>
			</tr>";
	}
	echo "</table>";
?>
</body>
</html>