<?php
include "../../../../config/config.php";

if(isset($_POST["id"])&&!isset($_POST['suc']))
{
    $Acc_id = $_POST["Acc_id"];
    $ghiChu = $_POST["ghiChu"];
    $Ban_id = $_POST["Ban_id"];
    $thoiGianGiao = $_POST["thoiGianGiao"];
    $maKhuyenMai = $_POST["maKhuyenMai"];
    $thanhToan = $_POST["thanhToan"];
    $datBan = $_POST["datBan"];
  
    try{
        $query = "UPDATE `donhang` SET `Ban_id`='$Ban_id',`Acc_id`='$Acc_id',
        `thoiGianGiao`='$thoiGianGiao',`ghiChu`='$ghiChu',`thanhToan`='$thanhToan',`maKhuyenMai`='$maKhuyenMai',
        `datBan`='$datBan' WHERE `id`=".$_POST["id"];

        if ($connectMySql->query($query) === TRUE) {
    
            echo "1";
        } else {
    
            echo "Lỗi khi chèn dữ liệu: " . $query;
        }
    }catch(Exception $ex){
        echo $query;
    }
   
}
if(isset($_POST['suc']))
{
    try{
        date_default_timezone_set('Asia/Ho_Chi_Minh');     
        $today = date('Y-m-d H:i:s');
        $query = "UPDATE `donhang` SET `thoiGianKetThuc`='$today' WHERE `id`=".$_POST["id"];

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
