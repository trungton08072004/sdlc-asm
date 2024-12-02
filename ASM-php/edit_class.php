<?php
include 'db.php';

$id = intval($_GET['id']); // Chuyển đổi id thành số nguyên để tránh lỗi Injection

// Lấy thông tin lớp học cần sửa
$sql = "SELECT * FROM class WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$class = $result->fetch_assoc();

if (!$class) {
    echo "Lớp học không tồn tại.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $course_id = intval($_POST['course_id']);

    // Cập nhật lớp học vào cơ sở dữ liệu với prepared statements
    $update_sql = "UPDATE class SET name = ?, course_id = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sii", $name, $course_id, $id);

    if ($update_stmt->execute()) {
        echo "Cập nhật lớp học thành công!";
        header('Location: manage_classes.php');
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!-- Form Sửa Lớp Học -->
<h2>Sửa lớp học</h2>
<form method="post">
    <label for="name">Tên lớp:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($class['name']); ?>" required><br>

    <label for="course_id">Khóa học:</label>
    <select name="course_id" required>
        <option value="">-- Chọn khóa học --</option>
        <?php
        $course_query = "SELECT id, name FROM course";
        $courses = $conn->query($course_query);

        while ($course = $courses->fetch_assoc()) {
            $selected = ($course['id'] == $class['course_id']) ? "selected" : "";
            echo "<option value='{$course['id']}' $selected>{$course['name']}</option>";
        }
        ?>
    </select><br>

    <button type="submit">Cập nhật</button>
</form>