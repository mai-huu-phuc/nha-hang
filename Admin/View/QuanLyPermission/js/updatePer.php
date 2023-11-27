<?php
include "../../../../config/config.php";

if(isset($_POST["id"]))
{
    $selected_id=$_POST["id"];
    $name=$_POST["name"];
   
    try{
        $query = "UPDATE `permission` SET `name`='$name' WHERE `id`='$selected_id'";

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
