<?php
include 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $course_id = $_POST['course_id'];

    // Kiểm tra xem course_id có tồn tại trong bảng course không
    $checkCourse = "SELECT * FROM course WHERE id = '$course_id'";
    $result = $conn->query($checkCourse);

    if ($result->num_rows > 0) {
        // Nếu course_id tồn tại trong bảng course, thêm vào bảng class
        $sql = "INSERT INTO class (name, course_id) VALUES ('$name', '$course_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Thêm lớp học thành công!";
            header('Location: manage_classes.php');
            exit();
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        // Nếu course_id không tồn tại, báo lỗi
        echo "Lỗi: Mã khóa học không tồn tại. Vui lòng chọn mã hợp lệ.";
    }
}
?>

<!-- Form Thêm Lớp Học -->
<h2>Thêm lớp học mới</h2>

<head>
    <link rel="stylesheet" href="add_class.css">

</head>
<form method="post">
    <label for="name">Tên lớp:</label>
    <input type="text" name="name" required><br>

    <label for="course_id">Mã khóa học:</label>
    <input type="number" name="course_id" required><br>

    <button type="submit">Thêm</button>
</form>