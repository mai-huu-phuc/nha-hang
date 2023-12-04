<?php
include "../config/config.php";

if(isset($_POST["name"]))
{
    
    $selected_id = $_POST["id"];
    $name = $_POST["name"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    
    $Age = $_POST["Age"];
    $Address = $_POST["Address"];
    $CCCD = $_POST["CCCD"];

 
     
    try{
        $query = "UPDATE `account` SET `name`='$name',
       `phone`='$Phone',`address`='$Address',`age`='$Age',`email`='$Email',`CCCD`='$CCCD',
         Where `id`='$selected_id'";

        if ($connectMySql->query($query) === TRUE) {
    
            echo "1";
        } else {
    
            echo "Lỗi khi chèn dữ liệu: " . $query;
        }
    }catch(Exception $ex){
        echo $query;
    }

      
}
if(isset($_POST["passwordOld"]))
{
    
    $passwordOld = $_POST["passwordOld"];
    $idAccount = $_POST["idAccount"];
    $password = $_POST["password"];

 
    try{
        $query_get_id = "SELECT `id` FROM `account` where password='".$passwordOld."' and id='".$idAccount."' LIMIT 1";
        $select_result = $connectMySql->query($query_get_id);

        if ($select_result->num_rows > 0) {

            $row = $select_result->fetch_assoc();
            try{
                
                $query = "UPDATE `account` SET `password`='$password'
               
                  Where `id`='$idAccount'";

                if ($connectMySql->query($query) === TRUE) {
            
                    echo "1";
                } else {
            
                    echo "Lỗi khi chèn dữ liệu: " . $query;
                }
            }catch(Exception $ex){
                echo $query;
            }
    
        }
    }catch(Exception $ex){
        echo $query;
    }

      
}
/*---- POST Send Data ----*/

?>
