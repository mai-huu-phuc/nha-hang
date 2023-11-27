<?php
include "../../../../config/config.php";

if(isset($_POST["name"]))
{
    $name=$_POST["UserName"];
    $UserName = $_POST["UserName"];
    $Password = $_POST["Password"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    
    $Age = $_POST["Age"];
    $Address = $_POST["Address"];
    $CCCD = $_POST["CCCD"];
    $isBlock = $_POST["isBlock"];

    $permission = $_POST["permission"];
    try {
        $query_get_id = "SELECT `id` FROM `account` ORDER BY id DESC LIMIT 1";
        $select_result = $connectMySql->query($query_get_id);

        if ($select_result->num_rows > 0) {

            $row = $select_result->fetch_assoc();
            (int)$selected_id = $row['id'];
            (int)$selected_id++;
            try{
                
                $query = "INSERT INTO `account`(`id`, `Per_id`, `name`, `userName`, `password`, `phone`, `address`, `age`, `email`, `CCCD`, `isBlock`)
                 VALUES ('$selected_id','$permission','$name','$UserName','$Password','$Phone','$Address','$Age','$Email','$CCCD','$isBlock')";

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
                 
                $query = "INSERT INTO `account`(`id`, `Per_id`, `name`, `userName`, `password`, `phone`, `address`, `age`, `email`, `CCCD`, `isBlock`)
                 VALUES (1,'$permission','$name','$UserName','$Password','$Phone','$Address','$Age','$Email','$CCCD','$isBlock')";
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
