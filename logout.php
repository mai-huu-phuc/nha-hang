<?php
session_start();

// Hủy phiên làm việc
session_destroy();

// Chuyển hướng đến trang đăng nhập hoặc trang chính
header('Location: login.php');
exit();
?>