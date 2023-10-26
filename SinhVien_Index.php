
    
<div class="row">
    <div class="col-sm-12">
        <a id="linkAdd" class="btn btn-primary" href="Admin.php?Renderbody=SinhVien_Add&page=<?php if(isset($_GET['page'])) echo $_GET['page']; else echo 1; ?>" style="margin-bottom: 20px;">Thêm sinh viên</a>
        <table class="table table-bordered  col-sm-12">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Date Of Birth</th>
                <th>Sex</th>
                <th>Score</th>
                <th>Action</th>
            </tr>
            <?php 
                require("SinhVien_DB.php");
                // Define the number of records to display per page and get the current page from the query string
                $recordsPerPage = 3;// số ban ghi tren 1 trang
                if (isset($_GET['page'])) 
                {
                    $currentPage = $_GET['page'];

                } else {
                    $currentPage = 1;
                }
                
                // Calculate the LIMIT clause for SQL query
                $limit = ($currentPage - 1) * $recordsPerPage;
                
                // Query to fetch records with pagination
                $stmt = $conn->prepare("SELECT * FROM sinhvien LIMIT $limit, $recordsPerPage");
                //$stmt = $conn->prepare("SELECT *  FROM sinhvien");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                // Get the total number of records
                $totalRecords = $conn->query("SELECT COUNT(*) FROM sinhvien")->fetchColumn();

                // Calculate the total number of pages
                $totalPages = ceil($totalRecords / $recordsPerPage);
                
                while($row = $stmt->fetch()){
            ?>
                    <tr>
                        <td><?php echo $row['Id']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><img src="Anh/<?php echo $row['Image']; ?>"  alt="lỗi ảnh" style="width: 50px;height:50px;"></td>
                        <td><?php echo $row['DateOfBirth']; ?></td>
                        <td><?php echo $row['Sex']; ?></td>
                        <td><?php echo $row['Score']; ?></td>
                        <td>
                            <a class="btn btn-warning" href="Admin.php?Renderbody=SinhVien_Update&page=<?php echo $currentPage; ?>
                            &Name=<?php echo $row['Name']; ?>
                            &Image=<?php echo $row['Image']; ?>
                            &DateOfBirth=<?php echo $row['DateOfBirth']; ?>
                            &Sex=<?php echo $row['Sex']; ?>
                            &Score=<?php echo $row['Score']; ?>
                            &Id=<?php echo $row['Id']; ?>"><i class="bi bi-pencil-fill"></i></a>
                            <!-- <input type="submit" class="btn btn-danger" value="Delete"> -->
                            <a id="deleteLink<?php echo $row['Id'];?>" href="SinhVien_Delete.php?Id=<?php echo $row['Id']; ?>&page=<?php echo $currentPage ?>" class="btn btn-danger" )"><i class="bi bi-x-square"></i></a> 
                            <!-- onclick="return checkDelete(<?php echo $row['Id']; ?> -->
                            
                        </td>
                    </tr>
            <?php } $conn = null;?>
        </table>
            <!-- Pagination links -->
        <?php if($totalPages > 1){ ?>
        <ul class="pagination">
            <?php
            if($currentPage!=1)
                echo '<li class="page-item "><a class="page-link" href="?page=' . $currentPage-1 . '"> Trước </a></li>'; 
            for ($i = 1; $i <= $totalPages; $i++) 
            {
                echo '<li class="page-item' . ($i == $currentPage ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }
            if($currentPage!=$totalPages)
                echo '<li class="page-item "><a class="page-link" href="?page=' . $currentPage+1 . '"> Sau </a></li>'; 
            ?>
        </ul>
        <?php } ?>
    </div>
</div>


<script> 
    function checkDelete(Id)
    {
        if(confirm("Bạn có muốn xóa không"))
            window.location.href = "SinhVien_Delete.php?Id=" + Id;
        
    }
        
</script>

