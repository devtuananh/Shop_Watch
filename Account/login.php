<?php

session_start();
header('Content-Type: text/html; charset=UTF-8');
echo '<title>Đăng nhập</title>';
// Tải file mysql.php lên
require_once("../database/connect.php");
if ($_GET['act'] == "do" )
{
    // Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
    $username = addslashes( $_POST['username'] );
    $password = md5( addslashes( $_POST['password'] ) );
    // Lấy thông tin của username đã nhập trong table members
    $query = "SELECT id, username, password FROM members WHERE username='{$username}'";
    $sql_query=mysqli_query($con,$query);
	$member = mysqli_fetch_array( $sql_query );
    // Nếu username này không tồn tại thì....
    if ( mysqli_num_rows( $sql_query ) <= 0 )
    {
        print "Tên truy nhập không tồn tại. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
        exit;
    }
    // Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
    if ( $password != $member['password'] )
    {
        print "Nhập sai mật khẩu. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
        exit;
    }
    // Khởi động phiên làm việc (session)
    $_SESSION['user_id'] = $member['id'];
    $_SESSION['user_admin'] = $member['admin'];
    // Thông báo đăng nhập thành công
    echo "<script>alert('Bạn đã đăng nhập với tài khoảnthành công')</script>";
    header('Location: ../index.php');
}
else
{
// Form đăng nhập
print <<<EOF

    <form method="POST" action="login.php?act=do">
    <fieldset>
        <legend>Đăng nhập</legend>
            <table>
                <tr>
                    <td>Tên truy cập: </td>
                    <td><input type="text" name="username" size="30" value=""></td>
                </tr>
                <tr>
                    <td>Mật khẩu: </td>
                    <td><input type="password" name="password" size="30" value=""></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"> <input type="submit" name="submit" value="Đăng nhập"></td>
                </tr>
            </table>
  </fieldset>
  </form>
EOF;
}
?>