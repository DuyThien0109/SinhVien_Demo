

<?php 
   
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "SinhVien_DB";

   try {
       $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       //C1
    //    $stmt = $conn->prepare("SELECT *  FROM sinhvien");
    //    $stmt->execute();
    // Thiết lập chế độ trả về dữ liệu kiểu mảng kết hợp (associative array)
    //    $stmt->setFetchMode(PDO::FETCH_ASSOC);
       

        //C2
       // $results = $stmt->fetchAll(PDO::FETCH_OBJ);
       // foreach($results as $result)
       // {
       //     echo $result->Id." - ".$result->name;
       // }

       

   }
   catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
   }
   
//    $conn = null;
?>