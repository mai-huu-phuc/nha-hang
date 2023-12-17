<?php
include "../../../../config/config.php";

if(isset($_POST["name"]))
{
    $name = $_POST["name"];
    $isBlock = $_POST["isBlock"];
    $linkURL = $_POST["linkURL"];
    try {
        $query_get_id = "SELECT id FROM menu ORDER BY id DESC LIMIT 1";
        $select_result = $connectMySql->query($query_get_id);

        if ($select_result->num_rows > 0) {

            $row = $select_result->fetch_assoc();
            (int)$selected_id = $row['id'];
            (int)$selected_id++;
            try{
                $query = "INSERT INTO `menu`(`id`, `name`, linkURL,`isBlock`) VALUES ('$selected_id','$name','$linkURL','$isBlock')";

                if ($connectMySql->query($query) === TRUE) {
            
                    echo "1";
                } else {
            
                    echo "Lỗi khi chèn dữ liệu: " . $query;
                }
            }catch(Exception $ex){
                echo $query;
            }
    
        } else if($select_result->num_rows == 0){

            try{
                $query = "INSERT INTO `menu`(`id`, `name`, linkURL,`isBlock`) VALUES (1,'$name','$linkURL','$isBlock')";

                if ($connectMySql->query($query) === TRUE) {
            
                   echo "1";
                } else {
            
                    echo "Lỗi khi chèn dữ liệu: " . $query;
                }
            }catch(Exception $ex)
            {
                echo $query;
            }
        }
    }catch(Exception $ex)
    {
        echo "Lỗi ".$ex;
    }
}
/*---- POST Send Data ----*/

?>
