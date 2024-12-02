<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Thêm khóa học vào cơ sở dữ liệu
    $sql = "INSERT INTO course (name, description) VALUES ('$name', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm khóa học thành công!";
        header('Location: manage_classes.php');
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!-- Form Thêm khóa học -->
<form method="post">
    <label for="name">Tên khóa học:</label>
    <input type="text" name="name" required><br>

    <label for="description">Mô tả:</label>
    <textarea name="description" required></textarea><br>

    <button type="submit">Thêm</button>
</form>