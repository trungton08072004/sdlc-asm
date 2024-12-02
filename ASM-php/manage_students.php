<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO student (name, email, phone, date_of_birth, address, gender) 
            VALUES ('$name', '$email', '$phone', '$date_of_birth', '$address', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm sinh viên thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<h2>Thêm sinh viên</h2>
<form method="post">
    <input type="text" name="name" placeholder="Tên" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="phone" placeholder="Số điện thoại"><br>
    <input type="date" name="date_of_birth" placeholder="Ngày sinh"><br>
    <input type="text" name="address" placeholder="Địa chỉ"><br>
    <select name="gender">
        <option value="Male">Nam</option>
        <option value="Female">Nữ</option>
        <option value="Other">Khác</option>
    </select><br>
    <button type="submit">Thêm</button>
</form>

<!-- Nút quay về trang chính của Admin -->
<a href="admin_dashboard.php">
    <button>Quay về trang chính</button>
</a>

<h2>Danh sách sinh viên</h2>
<?php
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Tên</th><th>Email</th><th>Hành động</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>
                    <a href='edit_student.php?id={$row['id']}'>Sửa</a> | 
                    <a href='delete_student.php?id={$row['id']}'>Xóa</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Không có sinh viên nào.";
}
?>