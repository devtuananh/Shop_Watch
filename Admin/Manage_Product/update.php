<?php
// MySQLi connection
   require_once("../../database/connect.php"); 

if(isset($_GET['edit'])){
	$edit_id = $_GET['edit'];
	$get_user = "select * from product where product_id='$edit_id'";
	$run_user = mysqli_query($con, $get_user);
	$row_user = mysqli_fetch_array($run_user);
	$p_id = $row_user['product_id'];
	$p_name = $row_user['product_name'];		
	$c_id = $row_user['category_id'];
	$p_display = $row_user['display'];
	$p_price = $row_user['price'];
	$p_image = $row_user['image'];
}

	if(isset($_POST['update']))
	{
		    $new_cate = $_POST['category_id2'];
            $new_name = $_POST['product_name2'];
            $new_display = $_POST['display2'];
            $new_price = $_POST['price2'];
            $image_dir = 'images';
            $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;        
            if (isset($_FILES['file2'])) {
            $filename = $_FILES['file2']['name'];
            $source = $_FILES['file2']['tmp_name'];
            $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
            move_uploaded_file($source, $target);
            }
            $image2 = $_FILES['file2']['name'];
            unlink('./images/'.$p_image);
			$update_users = "update product 
			                 set product_name='$new_name',category_id='$new_cate',display='$new_display',
			                 image='$image2',price='$new_price' 
			                 where product_id='$edit_id' ";
			$run_update = mysqli_query($con,$update_users);
			if($run_update)
			{
			echo "<script>alert('A user has been Updated!')</script>";
            header('Location: view.php');	
			}
	}
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Cập nhật thông tin </title>
  	        <style>
            select,label{
                float: left;
                width: 100px;
            }
            input{
                margin-bottom: 10px;
            }
        </style>
</head>
<body>
	 
     <form method="post" enctype="multipart/form-data">
        
        <h3>Thông tin về mặt hàng <?php echo $p_name ?> </h3>
        <label>Mã hàng:</label>
        <input type="text" name="product_id2" value="<?php echo $edit_id ?>" />
        <br>
		<label>Tên hàng:</label>
        <input type="text" name="product_name2" value="<?php echo $p_name ?>"/>
        <br>
        <?php 
            $query1 = "SELECT * FROM category";
            $KQ2 = mysqli_query($con,$query1); 
        ?>
        <label>Hãng:</label>
        <select name="category_id2">
        <?php
         while($category = mysqli_fetch_array($KQ2))
         {
         ?>
         <option <?php if($category['category_id']==$c_id) echo "selected=\"selected\""?>
         value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?>
         </option>
         <?php 
          } 
         ?>
        </select>
        <br>
        <label>Cấu hình:</label>
        <input type="text" name="display2" value="<?php echo $p_display ?>"/>
        <br>
        <label>Giá:</label>
        <input type="text" name="price2" value="<?php echo $p_price ?>"/>
        <br>
        
        <label>Ảnh:</label>
        <?php echo "<img height='170' width='190' src='images/".$p_image."'/>" ?>
        <br>
        Ảnh mới: <input type="file" name="file2" >
        <br>
        
		<input type="submit" name="update" value="Cập nhật"/>
	</form>
</body>
</html>