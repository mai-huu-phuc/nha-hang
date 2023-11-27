<?php
include "../../../../config/config.php";

if(isset($_POST["id"]))
{
    $selected_id=$_POST["id"];
    $name=$_POST["UserName"];
    $UserName = $_POST["UserName"];
    $Password = $_POST["Password"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    $Age = $_POST["Age"];
    $Address = $_POST["Address"];
    $CCCD = $_POST["CCCD"];
    $isBlock = $_POST["isBlock"];
    $permission=$_POST["permission"];
  
    try{
        $query = "UPDATE `account` SET `Per_id`='$permission',`name`='$name',`userName`='$UserName',
        `password`='$Password',`phone`='$Phone',`address`='$Address',`age`='$Age',`email`='$Email',`CCCD`='$CCCD',`isBlock`='$isBlock' Where `id`='$selected_id'";

        if ($connectMySql->query($query) === TRUE) {
    
            echo "1";
        } else {
    
            echo "Lỗi khi chèn dữ liệu: " . $query;
        }
    }catch(Exception $ex){
        echo $query;
    }
   
}
/*---- POST Send Data ----*/

?>
