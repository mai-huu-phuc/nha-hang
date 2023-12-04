<?php
include "../../../../config/config.php";

if(isset($_POST["id"]))
{
    try{
        $sql = "DELETE FROM ct_donhang WHERE id =".$_POST["id"];

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