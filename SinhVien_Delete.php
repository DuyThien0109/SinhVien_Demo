<?php
if (isset($_GET['Id'])) {
    $studentId = $_GET['Id'];

    // Kết nối đến cơ sở dữ liệu
    require("SinhVien_DB.php");

    // Thực hiện truy vấn SQL để xóa sinh viên
    $deleteStmt = $conn->prepare("DELETE FROM sinhvien WHERE Id = :studentId");
    $deleteStmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);

    if ($deleteStmt->execute()) {
        // Xóa thành công, chuyển người dùng đến trang danh sách sinh viên hoặc cập nhật trang hiện tại.
        header("Location: Admin.php?page=".$_GET['page']); // Đổi thành URL phù hợp
        //exit();
        //echo '<script>window.location.href = SinhVien_Index.php?test=1;</script>';
    } else {
        echo "Lỗi khi xóa sinh viên.";
    }

    
} else {
    echo "Không có ID sinh viên để xóa.";
}
$conn = null;
?>
