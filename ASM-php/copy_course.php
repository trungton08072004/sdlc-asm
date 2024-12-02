<?php
include 'db.php';

// Lấy ID khóa học từ URL
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Lấy thông tin khóa học từ cơ sở dữ liệu
    $sql = "SELECT * FROM course WHERE id = '$course_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $description = $row['description'];

        // Sao chép khóa học và thêm vào cơ sở dữ liệu
        $sql_copy = "INSERT INTO course (name, description) VALUES ('$name', '$description')";

        if ($conn->query($sql_copy) === TRUE) {
            echo "Sao chép khóa học thành công!";
            
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Khóa học không tồn tại.";
    }
}
?>