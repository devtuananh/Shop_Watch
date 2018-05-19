<!DOCTYPE html> 
<html>
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Quản lý tài khoản</title>

        <script language="JavaScript" type="text/javascript">
           function checkDelete(){
           return confirm('Are you sure?');
          }
        </script>
  </head>
  <body>
   <button><a href='../../index.php'><h4>Trang chủ</h4></a></button>
   <button><a href='../admin_page.php'><h4>Quay lại</h4></a></button><br>
<h2>Quản lý tài khoản</h2>


<?php
// MySQLi connection
  // MySQLi connection
   require_once("../../database/connect.php");

// getting users form the table
  
  echo "<table width='800' border='1' bgcolor='#add8e6'>
      <tr align='center'>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Birth Day</th>
        <th>Admin</th>
        <th>Delete</th>
        <th colspan='2'>Quyền Admin</th>

      </tr> 
  ";
  $sel_cates = "select * from members";
  $run_cates = mysqli_query($con, $sel_cates);
  while($row=mysqli_fetch_array($run_cates)){
    $id = $row['id'];
    $name = $row['Name'];
    $email = $row['email'];
    $birthday = $row['Birthday'];
    if ($row['admin'] == 1) {
      $admin = 'có';
    }else $admin = 'không';
    
  echo "<tr align='center'>
          <td>$id</td>
          <td>$name</td>
          <td>$email</td>
          <td>$birthday</td>
          <td>$admin</td>
          <td><a href='manage_user.php?del=$id' onclick='return checkDelete()'>Delete</a></td>
          <td><a href='manage_user.php?set_admin=$id'>Gán</a></td>
          <td><a href='manage_user.php?del_admin=$id'>Hủy</a></td>
        </tr>";
  }
  echo "</table> <br>";

//deleting a user from the table
  if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $delete_cate = "delete from members where id='$del_id'";
    $run_delete = mysqli_query($con, $delete_cate); 
    if($run_delete){
      echo "<script>alert('A user has been deleted!')</script>";
      echo "<script>window.open('manage_user.php','_self')</script>";
    }  
  }

//Updating data code
  if(isset($_GET['set_admin']))
  {
      $update_id = $_GET['set_admin'];
      $update_cates = "update members set admin='1' where id='$update_id'";
      $run_update = mysqli_query($con,$update_cates);
      if($run_update)
      {
      echo "<script>alert('Gán quyền thành công')</script>";
      echo "<script>window.open('manage_user.php','_self')</script>";  
      }
  }

    if(isset($_GET['del_admin']))
  {
      $update_id = $_GET['del_admin'];
      $update_cates = "update members set admin='0' where id='$update_id'";
      $run_update = mysqli_query($con,$update_cates);
      if($run_update)
      {
      echo "<script>alert('Hủy quyền thành công')</script>";
      echo "<script>window.open('manage_user.php','_self')</script>";  
      }
  }
?>
</body> 
</html>