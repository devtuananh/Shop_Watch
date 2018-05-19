<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Đăng ký thành viên</title>
<?php
// Tải file mysql.php lên
require_once("../database/connect.php");

if ( $_GET['act'] == "do" )
{
    // Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
    $username = addslashes( $_POST['username'] );
    $password = md5( addslashes( $_POST['password'] ) );
    $verify_password = md5( addslashes( $_POST['verify_password'] ) );
    $email = addslashes( $_POST['email'] );
    $ten = addslashes( $_POST['name'] );
    $sinhnhat = addslashes( $_POST['sn'] );
   
	
    // Kiểm tra 7 thông tin, nếu có bất kỳ thông tin chưa điền thì sẽ báo lỗi
    if ( ! $username || ! $_POST['password'] || ! $_POST['verify_password'] || ! $email || ! $ten || ! $sinhnhat )
    {
        print "Xin vui lòng nhập đầy đủ các thông tin. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
        exit;
    }
    // Kiểm tra username nay co nguoi dung chua
    if ( mysqli_num_rows(mysqli_query($con,"SELECT username FROM members WHERE username='$username'"))>0)
    {
        print "Username này đã có người dùng, Bạn vui lòng chọn username khác. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
        exit;
    }

    // Kiểm tra email nay co nguoi dung chua
    if ( mysqli_num_rows(mysqli_query($con,"SELECT email FROM members WHERE email='$email'"))>0)
    {
        print "Email này đã có người dùng, Bạn vui lòng chọn Email khác. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
        exit;
    }
    // Kiểm tra mật khẩu, bắt buộc mật khẩu nhập lúc đầu và mật khẩu lúc sau phải trùng nhau
    if ( $password != $verify_password )
    {
        print "Mật khẩu không giống nhau, bạn hãy nhập lại mật khẩu. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
        exit;
    }
    // Tiến hành tạo tài khoản
    $a= mysqli_query($con,"INSERT INTO members (username, password, email,Name,Birthday) VALUES ('{$username}', '{$password}', '{$email}', '{$ten}', '{$sinhnhat}')");
    // Thông báo hoàn tất việc tạo tài khoản
    if ($a)
        print "Tài khoản {$username} đã được tạo. <a href='login.php'>Nhấp vào đây để đăng nhập</a>";
    else
        print "Có lỗi trong quá trình đăng kí, Vui lòng liên hệ BQT";
}
else
{
// Form đăng ký
print <<<EOF
<form action="register.php?act=do" method="post">
    <table border="1" width="400" cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0">
        <tr>
            <td>Tên truy nhập:</td>
            <td><input type="text" name="username" value=""></td>
        </tr>
        <tr>
            <td>Mật khẩu:</td>
            <td><input type="password" name="password" value=""></td>
        </tr>
        <tr>
            <td>Xác nhận mật khẩu:</td>
            <td><input type="password" name="verify_password" value=""></td>
        </tr>
        <tr>
            <td>Địa chỉ E-mail:</td>
            <td><input type="text" name="email" value=""></td>
        </tr>
        
        <tr>
            <td>Tên:</td>
            <td><input type="text" name="name" value=""></td>
        </tr>
        <tr>
            <td>Sinh nhật (Ngày/Tháng/Năm):</td>
            <td><input type="text" name="sn" value=""></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Đăng ký"></td>
            <td><Font size="5"> Shop Clock</Font></td>
        </tr>
    </table>
</form>
EOF;
}
?>