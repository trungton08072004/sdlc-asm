<?php
include 'db.php';

echo "<h2>Quản lý giáo viên</h2>";

// Thêm giáo viên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO teachers (name, email, phone) VALUES ('$name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm giáo viên thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!-- Form Thêm Giáo Viên -->
<form method="post">
    <input type="text" name="name" placeholder="Tên giáo viên" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="phone" placeholder="Số điện thoại"><br>
    <button type="submit">Thêm</button>
</form>

<!-- Nút quay về trang admin -->
<a href="admin_dashboard.php"><button>Quay về trang Admin</button></a>

<!-- Danh sách giáo viên -->
<h3>Danh sách giáo viên</h3>
<?php
$sql = "SELECT * FROM teachers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr><th>ID</th><th>Tên</th><th>Email</th><th>Hành động</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>
                    <a href='edit_teacher.php?id={$row['id']}'>Sửa</a> | 
                    <a href='delete_teacher.php?id={$row['id']}'>Xóa</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Không có giáo viên nào.";
}
?>