<?php
include 'db.php';

// Lấy danh sách lớp học
$sql = "SELECT * FROM class";
$result = $conn->query($sql);

echo "<h2>Danh sách lớp học</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Tên lớp</th>
                <th>Mã khóa học</th>
                <th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th>Hành động</th>
            </tr>";

    // Hiển thị danh sách lớp học
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['course_id']}</td>
                <td>{$row['created_at']}</td>
                <td>{$row['updated_at']}</td>
                <td>
                    <a href='edit_class.php?id={$row['id']}'>Sửa</a> | 
                    <a href='delete_class.php?id={$row['id']}'>Xóa</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Không có lớp học nào.";
}

?>

<!-- Thêm lớp học -->
<a href="add_class.php">Thêm lớp học mới</a><br><br>

<!-- Nút quay về trang chính của Admin -->
<a href="admin_dashboard.php">
    <button>Quay về trang chính</button>
</a>