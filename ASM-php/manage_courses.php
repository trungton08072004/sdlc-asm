<?php
include 'db.php';

echo "<h2>Danh sách khóa học</h2>";

// Truy vấn lấy dữ liệu các khóa học
$sql = "SELECT * FROM course";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Tên khóa học</th>
                <th>Mô tả</th>
                <th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th>Hành động</th>
            </tr>";

    // Lặp qua các kết quả và hiển thị trong bảng
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                <td>{$row['created_at']}</td>
                <td>{$row['updated_at']}</td>
                <td>
                    <a href='edit_course.php?id={$row['id']}'>Sửa</a> | 
                    <a href='copy_course.php?id={$row['id']}'>Sao chép</a> | 
                    <a href='delete_course.php?id={$row['id']}'>Xóa</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu khóa học nào.";
}
?>

<!-- Liên kết thêm khóa học -->
<a href="add_course.php">Thêm khóa học mới</a><br><br>

<!-- Nút quay về trang chính của Admin -->
<a href="admin_dashboard.php">
    <button>Quay về trang chính</button>
</a>