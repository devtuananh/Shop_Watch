<?php
session_start();
if (session_destroy()){
	echo "Thoát thành công!";
    header('Location: ../index.php');
} 
else
    echo "Không thể thoát được, có lỗi trong việc hủy session";  
?>