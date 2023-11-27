<?php
include "../../../../config/config.php";

if(isset($_POST["id"]))
{
    $nameFood = $_POST["tenBan"];
    $selected_id = $_POST["id"];
    $isBlock = $_POST["isBlock"];
  
    try{
        $query = "UPDATE `banan` SET `tenBan`='$nameFood',`isBlock`=' $isBlock' WHERE id='$selected_id'";

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
