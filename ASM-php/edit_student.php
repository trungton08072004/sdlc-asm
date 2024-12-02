<?php
include 'db.php';

// Lấy ID sinh viên từ URL
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Lấy thông tin sinh viên từ cơ sở dữ liệu
    $sql = "SELECT * FROM student WHERE id = '$student_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        $gender = $row['gender'];
    } else {
        echo "Sinh viên không tồn tại.";
        exit;
    }
}

// Xử lý form khi người dùng gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    // Cập nhật thông tin sinh viên
    $sql_update = "UPDATE student SET name = '$name', email = '$email', phone = '$phone', address = '$address', gender = '$gender' WHERE id = '$student_id'";

    if ($conn->query($sql_update) === TRUE) {
        // Sau khi cập nhật thành công, chuyển hướng về trang quản lý sinh viên
        header("Location: manage_students.php");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!-- Form chỉnh sửa thông tin sinh viên -->
<h2>Chỉnh sửa thông tin sinh viên</h2>
<form method="post">
    <label for="name">Tên sinh viên:</label>
    <input type="text" name="name" value="<?php echo $name; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $email; ?>" required><br>

    <label for="phone">Số điện thoại:</label>
    <input type="text" name="phone" value="<?php echo $phone; ?>" required><br>

    <label for="address">Địa chỉ:</label>
    <input type="text" name="address" value="<?php echo $address; ?>" required><br>

    <label for="gender">Giới tính:</label>
    <select name="gender">
        <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Nam</option>
        <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Nữ</option>
        <option value="Other" <?php echo ($gender == 'Other') ? 'selected' : ''; ?>>Khác</option>
    </select><br>

    <button type="submit">Cập nhật</button>
</form>