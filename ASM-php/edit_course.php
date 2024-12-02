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
    } else {
        echo "Khóa học không tồn tại.";
        exit;
    }
}

// Xử lý form khi người dùng gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Cập nhật thông tin khóa học
    $sql_update = "UPDATE course SET name = '$name', description = '$description' WHERE id = '$course_id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Cập nhật khóa học thành công!";
        header('Location: manage_courses.php');
        exit();

    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!-- Form chỉnh sửa khóa học -->
<h2>Chỉnh sửa khóa học</h2>
<form method="post">
    <label for="name">Tên khóa học:</label>
    <input type="text" name="name" value="<?php echo $name; ?>" required><br>

    <label for="description">Mô tả:</label>
    <textarea name="description" required><?php echo $description; ?></textarea><br>

    <button type="submit">Cập nhật</button>
</form>