<?php
include "../../../../config/config.php";

if(isset($_POST["id_Monan"]))
{
    $Foo_id=$_POST["id_Monan"];
    $Don_id=$_POST["id_HoDon"];
    $soluongDonHang=$_POST['soLuong'];

    try {
        $query_get_id = "SELECT id FROM ct_donhang ORDER BY id DESC LIMIT 1";
        $select_result = $connectMySql->query($query_get_id);

        if ($select_result->num_rows > 0) {

            $row = $select_result->fetch_assoc();
            (int)$selected_id = $row['id'];
            (int)$selected_id++;
         
            try{
                $query = "INSERT INTO `ct_donhang`(`id`, `Foo_id`, `Don_id`, `soluongDonHang`) 
                VALUES ('$selected_id','$Foo_id','$Don_id','$soluongDonHang')";

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
                $query = "INSERT INTO `ct_donhang`(`id`, `Foo_id`, `Don_id`, `soluongDonHang`) 
                VALUES (1,'$Foo_id','$Don_id','$soluongDonHang')";
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
