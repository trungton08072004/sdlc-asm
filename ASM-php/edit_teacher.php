<?php
include 'db.php';

// Kiểm tra nếu có tham số 'id' trong URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn dữ liệu giáo viên từ cơ sở dữ liệu
    $sql = "SELECT * FROM teachers WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy thông tin giáo viên
        $teacher = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy giáo viên với ID này.";
        exit();
    }
} else {
    echo "ID không hợp lệ.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];

    // Cập nhật thông tin giáo viên vào cơ sở dữ liệu
    $sql_update = "UPDATE teachers SET name = '$name', email = '$email', phone = '$phone', department = '$department' WHERE id = '$id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Cập nhật giáo viên thành công!";
        header('Location: manage_teachers.php'); 
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!-- Form sửa giáo viên -->
<h2>Sửa thông tin giáo viên</h2>
<form method="post">
    <label for="name">Tên:</label>
    <input type="text" name="name" value="<?php echo $teacher['name']; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $teacher['email']; ?>" required><br>

    <label for="phone">Số điện thoại:</label>
    <input type="text" name="phone" value="<?php echo $teacher['phone']; ?>"><br>

    <label for="department">Khoa:</label>
    <input type="text" name="department" value="<?php echo $teacher['department']; ?>"><br>

    <button type="submit">Cập nhật</button>
</form>