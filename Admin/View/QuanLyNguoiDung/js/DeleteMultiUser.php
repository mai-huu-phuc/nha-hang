<?php
include "../../../../config/config.php";

if(isset($_POST["idArray"]))
{
    
    try{
        $idsToDelete = $_POST["idArray"]; // Replace with the actual array of IDs you want to delete
        $idsString = implode(',', $idsToDelete); // Convert the array to a comma-separated string
        
        $sql = "DELETE FROM account WHERE id IN ($idsString)";
        
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