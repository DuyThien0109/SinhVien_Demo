<div class="col-sm-5" style="margin: auto;">
    <form method="POST"   class="was-validated" enctype="multipart/form-data">

        <div class="mb-3 mt-3">
            <label hidden id="lableId" for="name" class="form-label">Id</label>
            <input type="hidden" name="Id" class="form-control" readonly>
        </div>


        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter username" name="name" required>
            <!-- <div class="invalid-feedback">Vui lòng nhập tên</div> -->
        </div>

        <div class="mb-3 mt-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" placeholder="Enter image" name="image" required>
            
            <img id="previewImage" src="" alt="Preview Image" style="width: 100%;max-height: 500px; display: none; margin-top: 10px;">
        </div>

        <div class="mb-3 mt-3">
            <label for="DateOfBirth" class="form-label">Date Of Birth</label>
            <input type="date" class="form-control" id="DateOfBirth" placeholder="Enter Date Of Birth" name="DateOfBirth" required>
           
        </div>



        <div class="mb-3 mt-3">
            <label for="" class="form-label" style="display: block;">Sex: </label>

            <label for="Male" class="form-check-label">Male</label>
            <input type="radio" class="form-check-input" id="Male" name="Sex" value="Male">

            <label for="Female" class="form-check-label">Female</label>
            <input type="radio" class="form-check-input" id="Female" name="Sex" value="Female" required>

            
        </div>

        <!-- <label class='form-label'>Gender</label>
        <div class='mb-2 form-control' id='checkValidGender'>
            <input class='form-check-input' type='radio' id='rd-male' name='gender' value='Nam'>
            <label class='form-check-label' for='rd-male'>Male</label>
            <input class='form-check-input' type='radio' id='rd-female' name='gender' value='Nữ'>
            <label class='form-check-label' for='rd-female'>Female</label>
        </div>
        <span style='color: red' id='errorGender'></span> -->
        

        

        <div class="mb-3 mt-3">
            <label for="score" class="form-label">Score</label>
            <input type="number" min="0" max="10" class="form-control" id="score" placeholder="Enter Score" name="score" required >
            
        </div>

        <input type="submit" class="btn btn-primary" name="Them" value="Thêm">
        <a href="Admin.php?page=<?php echo $_GET['page'] ?>" class="btn btn-dark">Quay lại</a>
    </form>
</div>

<script>
    document.getElementById('image').onchange = function (e) {
        const previewImage = document.getElementById('previewImage');
        const fileInput = e.target;
        const selectedFile = fileInput.files[0];
        
        if (!selectedFile) {
            // Không có tệp nào được chọn
            previewImage.style.display = 'none';
            return;
        }

        // Kiểm tra định dạng tệp (hình ảnh)
        const allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/bmp', 'image/webp', 'image/tiff', 'image/svg+xml'];
        if (allowedImageTypes.indexOf(selectedFile.type) === -1) 
        {
            alert('Chỉ cho phép tải lên hình ảnh');
            fileInput.value = ''; // Xóa lựa chọn tệp
            previewImage.style.display = 'none';
            return;
        }

        // Kiểm tra dung lượng (không quá 5MB)
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (selectedFile.size > maxSize) 
        {
            alert('Dung lượng tệp quá lớn. Vui lòng chọn tệp dưới 5MB.');
            fileInput.value = ''; // Xóa lựa chọn tệp
            previewImage.style.display = 'none';
            return;
        }

        // Hiển thị hình ảnh xem trước
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };
        reader.readAsDataURL(selectedFile);
    };

    document.getElementById('score').oninput = function (e) {
    const score = e.target.value;
    if(e.target.value!='') 
    {
        if (score > 10 || score <1) {
            
            alert('Điểm không thể lớn hơn 10 hoặc nhỏ hơn 1');
            e.target.value = ''; 
        }
    }
};
</script>

<?php
// Xử lý khi người dùng nhấp vào nút "Update"
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $Id = 1;
    $name = $_POST['name'];
    $image = basename($_FILES["image"]["name"]);
    $dateOfBirth = $_POST['DateOfBirth'];
    $sex = $_POST['Sex'];
    $score = $_POST['score'];
    
    require("SinhVien_DB.php");
    // Truy vấn để lấy sinh viên có ID lớn nhất
    $stmt = $conn->prepare("SELECT * FROM sinhvien ORDER BY Id DESC LIMIT 1");
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($student) {
        $Id = $student['Id'] + 1;
    }
    $sql = "INSERT INTO sinhvien (Id, Name, Image, DateOfBirth, Sex, Score)
        VALUES ($Id, '$name', '$image', '$dateOfBirth', '$sex', $score)";
    // use exec() because no results are returned
    $conn->exec($sql);
    $conn = null;
    // upload file


    $target_dir = "Anh/";
    $target_file = $target_dir . $image;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))// di chuyển file ảnh từ $_FILES["image"]["tmp_name"] sang thư mục $target_file
    {
        echo '<script>alert("Thêm thành công!");</script>';
        header("Location: Admin.php?page=" . $_GET['page']);
    }
    


}
else {
   
}
?>