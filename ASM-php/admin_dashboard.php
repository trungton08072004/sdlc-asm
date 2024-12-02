<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

echo "<h1>Chào mừng Admin</h1>";
echo "<a href='manage_students.php'>Quản lý sinh viên</a><br>";
echo "<a href='manage_teachers.php'>Quản lý giáo viên</a><br>";
echo "<a href='manage_classes.php'>Quản lý lớp học</a><br>";
echo "<a href='manage_courses.php'>Quản lý khóa học</a><br>";
echo "<a href='logout.php'>Đăng xuất</a>";
?>