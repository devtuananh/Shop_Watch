<!DOCTYPE html> 
<html>
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Quản lý hãng</title>
        <link rel="stylesheet" href="../../lib/css/hide.css">
        <script language="JavaScript" type="text/javascript">
           function checkDelete(){
           return confirm('Are you sure?');
          }
        </script> 
  </head>
  <body>
   <button><a href='../../index.php'><h4>Trang chủ</h4></a></button>
   <button><a href='../admin_page.php'><h4>Quay lại</h4></a></button>
<br>
<h2>Quản lý hãng</h2>


<?php

// MySQLi connection
   require_once("../../database/connect.php");

// getting categories form the table
  
  echo "<table width='800' border='1' bgcolor='#add8e6'>
      <tr align='center'>
        <th>Category ID</th>
        <th>Category Name</th>
        <th>Delete</th>
        <th>Update</th>
      </tr> 
  ";
  
  $sel_cates = "select * from category";
  $run_cates = mysqli_query($con, $sel_cates);
  while($row = mysqli_fetch_array($run_cates)){
    $category_id = $row['category_id'];
    $category_name = $row['category_name'];
  echo "<tr align='center'>
        <td>$category_id</td>
        <td>$category_name</td>
        <td><a href='manage_category.php?del=$category_id' onclick='return checkDelete()'>Delete</a></td>
        <td><a href='manage_category.php?edit=$category_id' >Edit</a></td>
      </tr>";
  }
  echo "</table>";

//Deleting from the table
  if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $delete_cate = "delete from category where category_id='$del_id'";
    $run_delete = mysqli_query($con, $delete_cate); 
    if($run_delete){
      echo "<script>alert('A user has been deleted!')</script>";
      echo "<script>window.open('manage_category.php','_self')</script>";
    }  
  }

//Inserting data into table
if(isset($_POST['add'])) {
       
       if (empty($_POST['category_id'])){
            $error_ma = "Vui lòng nhập mã hãng";
        }
        else{
            $category_id = $_POST['category_id'];
        }
  
        if (empty($_POST['category_name'])){
            $error_name = "Vui lòng nhập tên sản phẩm";
        }else{
            $category_name = $_POST['category_name'];
        }

        if ( ! $category_id ||  ! $category_name)
        {
         $error= "Vui lòng nhập đầy đủ các thông tin";
        
        }else{
    //creating mysqli query
   $query = "insert into category(category_id,category_name) 
                    values ('$category_id','$category_name')";
   $insert_query = mysqli_query($con, $query);
  if($insert_query){
  echo "<h2>Thêm thành công</h2>"; echo "<script>window.open('manage_category.php','_self')</script>";
  }
        }   

}

//Script for Editing the Categorys
if(isset($_GET['edit'])){
  $edit_id = $_GET['edit'];
  $get_cate = "select * from category where category_id='$edit_id' ";
  $run_cate = mysqli_query($con, $get_cate);
  $row_cate = mysqli_fetch_array($run_cate);
  $category_id = $row_cate['category_id'];
  $category_name = $row_cate['category_name'];    
    echo "
    <form method='post' action=''>
      <b>Edit ID</b><input type='text' name='category_id' value='$category_id'/><br>
      <b>Edit Name</b><input type='text' name='category_name' value='$category_name'/><br>
      <input type='submit' name='update' value='Update'/> 
    </form> 
    ";
}
//Updating data code
  if(isset($_POST['update']))
  {
      $update_id = $category_id;
      $category_name = $_POST['category_name'];

      $update_cates = "update category set category_name='$category_name' where category_id='$update_id'";
      $run_update = mysqli_query($con,$update_cates);
      if($run_update)
      {
      echo "<script>alert('A category has been Updated!')</script>";
      echo "<script>window.open('manage_category.php','_self')</script>";  
      }
  }
?><br>
  <form action="manage_category.php" method="post">
        <label>Mã hãng:</label>
        <input type="text" name="category_id"/>
        <span id="error_id" class="error_id" style="color:#F70101"><?php echo isset($error_ma) ? $error_ma: ""; ?></span>
        <br>
        <label>Tên hãng:</label>
        <input type="text" name="category_name" />
        <span id="error_name" class="error_name" style="color:#F70101"><?php echo isset($error_name) ? $error_name: ""; ?></span>
        <br>
    <input type="submit" name="add" value="Thêm hãng"/>
    <span class="error" style="color:#F70101"><?php echo isset($error) ? $error: ""; ?></span>
  </form>
</body> 
</html>