<?php
include "../../../../config/config.php";

if(isset($_POST["Acc_id"]))
{
    $Acc_id = $_POST["Acc_id"];
    $ghiChu = $_POST["ghiChu"];
    $Ban_id = $_POST["Ban_id"];
    $thoiGianGiao = $_POST["thoiGianGiao"];
    $maKhuyenMai = $_POST["maKhuyenMai"];
    $thanhToan = $_POST["thanhToan"];
    $datBan = $_POST["datBan"];

    try {
        $query_get_id = "SELECT id FROM donhang ORDER BY id DESC LIMIT 1";
        $select_result = $connectMySql->query($query_get_id);

        if ($select_result->num_rows > 0) {

            $row = $select_result->fetch_assoc();
            (int)$selected_id = $row['id'];
            (int)$selected_id++;
            date_default_timezone_set('Asia/Ho_Chi_Minh');     
            $today = date('Y-m-d H:i:s');
            try{
                $query = "INSERT INTO `donhang`(`id`, `Ban_id`, `Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`,  `datBan`)
                 VALUES ('$selected_id','$Ban_id','$Acc_id','$today','$thoiGianGiao','$ghiChu','$thanhToan','$maKhuyenMai','$datBan')";

                if ($connectMySql->query($query) === TRUE) {
            
                    echo "1";
                } else {
            
                    echo "Lỗi khi chèn dữ liệu: " . $query;
                }
            }catch(Exception $ex){
                echo $query;
            }
    
        } else if($select_result->num_rows == 0){
            date_default_timezone_set('Asia/Ho_Chi_Minh');     
            $today = date('Y-m-d H:i:s');

            try{
                $query = "INSERT INTO `donhang`(`id`, `Ban_id`, `Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`, `datBan`)
                 VALUES (1,'$Ban_id','$Acc_id','$today','$thoiGianGiao','$ghiChu','$thanhToan','$maKhuyenMai','$datBan')";

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
