








<?php


session_start();
?>




<?php

$server = "localhost";
$user = "root";
$pass = "123456";
$db = "inner";

$id = $_GET['id'];





$conn = mysqli_connect($server, $user, $pass, $db);

$sql3 = "SELECT * FROM image WHERE  im_id = $id";
$result3 = mysqli_query($conn, $sql3);


$sql = "DELETE  FROM `person` where person.id =$id ";
$sql2 = "DELETE  FROM `image` where image.Im_id =$id";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);





while ($row2 = mysqli_fetch_assoc($result3)) {

    $file = $row2['media'];

    unlink("media/".$file);

  
}



    if($result2){
$_SESSION['status'] = "success";
header('Location:employee.php');
    }
  


?>



















<?php include('includes/footer.php')   ?>