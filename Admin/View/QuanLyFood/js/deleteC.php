<?php
include "../../../../config/config.php";

if(isset($_POST["id"]))
{
    try{
        $sqlFind="SELECT `id`, `imageURL` FROM `baiviet` WHERE id=".$_POST["id"];
        $select_result = $connectMySql->query($sqlFind);
        if ($select_result->num_rows > 0) {
            while($row = $select_result->fetch_assoc())
            {
                if (file_exists("../../../../".$row['imageURL'])) {
                    // Attempt to delete the file
                    if (unlink("../../../../".$row['imageURL'])) {
                        echo "1";
                    } else {
                        echo "Error deleting file.";
                    }
                } else {
                    echo "File does not exist.";
                }  
                

            }  
        }
        $sql = "DELETE FROM baiviet WHERE id =".$_POST["id"];

        if ($connectMySql->query($sql) === TRUE) {
            echo "1";
        } else {
            echo "Error deleting records: " . $connectMySql->error;
        }
    }catch(Exception $ex)
    {
        echo $ex;
    }
}

?>