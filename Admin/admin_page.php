<?php 
session_start();
header('Content-Type: text/html; charset=UTF-8');
require_once("../database/connect.php"); 
if ( !$_SESSION['user_id'] )
{ 
    echo "Bạn chưa đăng nhập! <a href='../Account/login.php'>Nhấp vào đây để đăng nhập</a> hoặc <a href='register.php'>Nhấp vào đây để đăng ký</a>"; 
}
else
{ 
    $user_id = intval($_SESSION['user_id']);
    $sql_query = mysqli_query($con,"SELECT * FROM members WHERE id='{$user_id}'");
    $member = mysqli_fetch_array( $sql_query ); 
    echo "Bạn đang đăng nhập với tài khoản {$member['username']}."; 
    echo "<br><a href='../Account/logout.php'>Thoát ra</a><hr>";
    if ($member['admin']!="1")  
        echo "Bạn ko phải là admin";
    else
    {
        echo "<br>
             <style>
table, th, td {
    border: 1px solid black;
}
</style>
             <table align='center'>
            <tr>
            <td bgcolor='#ccff99' align='center' width='25%' height='50'><a href='Manage_Category/manage_category.php'>Quản lý hãng sản phẩm</a></td>
            <td bgcolor='#ccff99' align='center' width='25%' height='50'><a href='Manage_Product/view.php'>Quản lý sản phẩm</a></td>
            </tr>
            <tr>
            <td bgcolor='#ccff99' align='center' width='25%' height='50' ><a href='Manage_User/manage_user.php'>Quản lý tài khoản</a></td>
            <td bgcolor='#ccff99' align='center' width='25%' height='50' ><a href='../index.php'>Trang chu</a></td>
            </tr>
       </table>

        ";
    }
 
} 
?>