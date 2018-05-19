<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Mua bán đồng hồ Online</title>
        <style>


input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
        <link rel="stylesheet" href="../../lib/css/hide.css">
   <?php
// MySQLi connection
   require_once("../../database/connect.php");

//Inserting data into table
if(isset($_POST['add'])) {
        if (empty($_POST['product_id'])){
            $error_ma = "Vui lòng nhập mã sản phẩm";
        }
        else{
            $p_id = $_POST['product_id'];
        }
        if ($_POST['category_id'] == 0){
            $error_cate = "Vui lòng chọn hãng sản phẩm";
        }else{
            $c_id = $_POST['category_id'];
        }

        if (empty($_POST['product_name'])){
            $error_name = "Vui lòng nhập tên sản phẩm";
        }
        else{
            $p_name = $_POST['product_name'];
        }

        if (empty($_POST['display'])){
            $error_display = "Vui lòng nhập cấu hình cho sản phẩm";
        }
        else{
            $p_display = $_POST['display'];
        }
        if (empty($_POST['price'])){
            $error_price = "Vui lòng nhập giá sản phẩm";
        }
        else{
            $p_price = $_POST['price'];
        }
        
        $image_dir = 'images';
        $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;        
        
        $filename = $_FILES['file1']['name'];
        if (empty($filename)) {
        $error_image = "Vui lòng đưa ảnh";
        }else{
        $source = $_FILES['file1']['tmp_name'];
        $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
        move_uploaded_file($source, $target);
        }
        
        $image = $_FILES['file1']['name'];
        
        if ( ! $p_id || ! $c_id || ! $p_name || ! $p_display || ! $filename || ! $p_price)
        {
         $error= "Vui lòng nhập đầy đủ các thông tin";
        }else{
             $query = "insert into product(product_id,category_id,product_name,display,image,price) 
                    values('$p_id','$c_id','$p_name','$p_display','$image','$p_price')";
             $insert_query = mysqli_query($con, $query);
             if($insert_query){
                        echo "<h2>Thêm hàng thành công</h2>";
                        header('Location: view.php');
              }   
        }      

}
?>

</head>
<body>	 
     <form method="post"  enctype="multipart/form-data">
       <fieldset>
        <legend>BẢNG NHẬP HÀNG</legend>
        <br>
        <label>Mã hàng:</label>
        <input type="text" name="product_id" />
        <span id="error_ma" class="error_ma" style="color:#F70101"><?php echo isset($error_ma) ? $error_ma: ""; ?></span>
        <br>
		<label>Tên hàng:</label>
        <input type="text" name="product_name" />
         <span id="error_name" class="error_name" style="color:#F70101"><?php echo isset($error_name) ? $error_name: ""; ?></span>
        <br>
        <?php 
            $query1 = "SELECT * FROM category";
            $KQ2 = mysqli_query($con,$query1); 
        ?>
        <label>Hãng:</label>
        <select name="category_id">
        <option value="Chọn">Chọn</option>
        <?php
         while($category = mysqli_fetch_array($KQ2))
         {
         ?>
         <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
         <?php 
          } 
         ?>
        </select>
        <span id="error_cate" class="error_cate" style="color:#F70101"><?php echo isset($error_cate) ? $error_cate: ""; ?></span>
        <br><br>
        <label>Cấu hình:</label>
        <textarea cols="50" rows="8" name="display" ></textarea>
         <span id="error_display" class="error_display" style="color:#F70101"><?php echo isset($error_display) ? $error_display: ""; ?></span>
        <br>
        <label>Giá:</label>
        <input type="text" name="price"/>
         <span id="error_price" class="error_price" style="color:#F70101"><?php echo isset($error_price) ? $error_price: ""; ?></span>
        <br>
        <label>Ảnh:</label>
        <input type="file" name="file1">
        <span id="error_image" class="error_image" style="color:#F70101"><?php echo isset($error_image) ? $error_image: ""; ?></span>
        <br>
		<input type="submit" name="add" value="Thêm sản phẩm"/>
        <span class="error" style="color:#F70101"><?php echo isset($error) ? $error: ""; ?></span>
	</fieldset>
</form>
    
</body>	 
</html>