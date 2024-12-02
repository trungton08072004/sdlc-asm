<?php
include 'db.php';

// Lấy ID khóa học từ URL
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Xóa khóa học khỏi cơ sở dữ liệu
    $sql_delete = "DELETE FROM course WHERE id = '$course_id'";

    if ($conn->query($sql_delete) === TRUE) {
        
        echo "Khóa học đã được xóa thành công!";
        header('Location: manage_classes.php');
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>