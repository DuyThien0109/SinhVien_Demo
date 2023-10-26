
<?php
    require("SinhVien_DB.php");

    // Xử lý khi người dùng nhấp vào nút "Update"
    if (isset($_POST['CapNhat']) && isset($_POST['Id'])) 
    {
        $Id = $_POST['Id'];
        $name = $_POST['name'];
        $image = basename($_FILES["image"]["name"]);
        $dateOfBirth = $_POST['DateOfBirth'];
        $sex = $_POST['Sex'];
        $score = $_POST['score'];
        
        // Thực hiện truy vấn SQL để cập nhật thông tin sinh viên
        $updateStmt = $conn->prepare("UPDATE sinhvien SET Name = :name, Image = :image, DateOfBirth = :dateOfBirth, Sex = :sex, Score = :score WHERE Id = $Id");
        $updateStmt->bindParam(':name', $name);
        $updateStmt->bindParam(':image', $image);
        $updateStmt->bindParam(':dateOfBirth', $dateOfBirth);
        $updateStmt->bindParam(':sex', $sex);
        $updateStmt->bindParam(':score', $score);
  
        if ($updateStmt->execute()) 
        {
            
            // Xóa ảnh cũ
            unlink("Anh/".trim($_GET['Image']));

            // Upload tệp mới
            $target_dir = "Anh/";
            $target_file = $target_dir . $image;
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo 'Upload file error: ' . $image;
                exit();
            } 
            
            header("Location: Admin.php?page=" . $_GET['page']);
            
        } else {
            echo "Lỗi khi cập nhật dữ liệu.";
        }
    }
    
?>
<div class="col-sm-5" style="margin: auto;">
    <form method="POST"  class="was-validated" enctype="multipart/form-data">
        
        <div class="mb-3 mt-3">
            <label  id="lableId" for="name" class="form-label">Id</label>
            <input type="text" name="Id" class="form-control" readonly value="<?php echo trim($_GET['Id']); ?>">
        </div>

        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter username" name="name" required value="<?php echo trim($_GET['Name']); ?>">
            <div class="invalid-feedback">Vui lòng nhập tên</div>
        </div>
        
        <div class="mb-3 mt-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" placeholder="Enter image" name="image" required>
            <div class="invalid-feedback">Vui lòng chọn ảnh </div>
            <img id="previewImage" src="Anh/<?php echo $_GET['Image']?>" alt="Preview Image" style="max-width: 100%;max-height: 100%;">
        </div>
        
        <div class="mb-3 mt-3">
            <label for="DateOfBirth" class="form-label">Date Of Birth</label>
            <input type="date" class="form-control" id="DateOfBirth" placeholder="Enter Date Of Birth" name="DateOfBirth" required value="<?php echo trim($_GET['DateOfBirth']); ?>">
            <div class="invalid-feedback">Vui lòng nhập ngày tháng năm sinh</div>
        </div>
        
        <div class="mb-3 mt-3">
            <label for="" class="form-label" style="display: block;">Sex: </label>

            <label for="Male" class="form-check-label">Male</label>
            <input type="radio" class="form-check-input" id="Male" name="Sex" value="Male" <?php if(trim($_GET['Sex'])==="Male") echo "checked"; ?> >

            <label for="Female" class="form-check-label">Female</label>
            <input type="radio" class="form-check-input" id="Female" name="Sex" value="Female" <?php if(trim($_GET['Sex'])==="Female")  echo"checked"; ?> required>

            <div class="invalid-feedback">Vui lòng chọn giới tính</div>
        </div>
        
        <div class="mb-3 mt-3">
            <label for="score" class="form-label">Score</label>
            <input type="number" min="0" max="10" class="form-control" id="score" placeholder="Enter Score" name="score" value="<?php echo trim($_GET['Score']); ?>" required>
            <div class="invalid-feedback">Vui lòng nhập điểm<meta></div>
        </div>
        
        <input type="submit" class="btn btn-primary" name="CapNhat" value="Cập nhật"> 
        <a href="Admin.php?page=<?php echo $_GET["page"] ?>" class="btn btn-dark">Quay lại</a> 
    </form>
</div>
<script>
    document.getElementById('image').onchange = function (e) 
    {
        const previewImage = document.getElementById('previewImage');
        const fileInput = e.target;
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
        else
            previewImage.style.display = 'none';
    };
</script>


