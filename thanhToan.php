<?php


include "./config/config.php";

if(isset($_POST['getBanDat']))
{
    if(isset($_SESSION['logged_in']))
    {
        $query_get_id = "SELECT id FROM donhang ORDER BY id DESC LIMIT 1";
        $select_result = $connectMySql->query($query_get_id);

        if ($select_result->num_rows > 0) {

            $row = $select_result->fetch_assoc();
            (int)$selected_id = $row['id'];
            (int)$selected_id++;
            
            date_default_timezone_set('Asia/Ho_Chi_Minh');     
            $today = date('Y-m-d H:i:s');
    
            try{
                if($_POST['getBanDat']==""||$_POST['getBanDat']==null)
                {
                    $query = "INSERT INTO `donhang`(`id`, `Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`,  `datBan`) 
                    VALUES ('$selected_id'
                    ,'".$_SESSION['id']."',
                    '$today',
                    '".$_POST['ngaygiao']."',
                    '".$_POST['ghiChu']."',1,'',0)";
                   
                }else{
                    $query = "INSERT INTO `donhang`(`id`, Ban_id,`Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`, `thoiGianKetThuc`, `datBan`) 
                    VALUES ('$selected_id','".$_POST['getBanDat']."','".$_SESSION['id']."','$today','".$_POST['ngaygiao']."','".$_POST['ghiChu']."',1,'','',0)";
                }
             
                if ($connectMySql->query($query) === TRUE) {

                    for ($i=0; $i < sizeof($_SESSION['cart']); $i++) { 
           
                            $query_get_id2 = "SELECT id FROM ct_donhang ORDER BY id DESC LIMIT 1";
                            $select_result = $connectMySql->query($query_get_id2);
                    
                            if ($select_result->num_rows > 0) {
                    
                                $row = $select_result->fetch_assoc();
                                (int)$selected_id2 = $row['id'];
                                (int)$selected_id2++;
                             
                                try{
                                    $query = "INSERT INTO `ct_donhang`(`id`, `Foo_id`, `Don_id`, `soluongDonHang`) 
                                    VALUES ('$selected_id2','".$_SESSION['cart'][$i]['foodId']."','$selected_id','".$_SESSION['cart'][$i]['foodSoLuong']."')";
                    
                                    if ($connectMySql->query($query) === TRUE) {
                                
                                      
                                    } else {
                                
                                        echo "Lỗi khi chèn dữ liệu: " . $query;
                                    }
                                }catch(Exception $ex){
                                    echo $query;
                                }
                        
                            } else if($select_result->num_rows == 0){
                                
                                try{
                                    $query = "INSERT INTO `ct_donhang`(`id`, `Foo_id`, `Don_id`, `soluongDonHang`) 
                                    VALUES (1,'".$_SESSION['cart'][$i]['foodId']."','$selected_id','".$_SESSION['cart'][$i]['foodSoLuong']."')";
                                    if ($connectMySql->query($query) === TRUE) {
                                
                                       echo "Loi";
                                    } else {
                                
                                        echo "Lỗi khi chèn dữ liệu: " . $query;
                                    }
                                }catch(Exception $ex)
                                {
                                    echo $query;
                                }
                            }
                     }
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
                if($_POST['getBanDat']==""||$_POST['getBanDat']==null)
                {
                    $query = "INSERT INTO `donhang`(`id`, `Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`, `thoiGianKetThuc`, `datBan`) 
                    VALUES (1,'".$_SESSION['id']."','$today ','".$_POST['ngaygiao']."','".$_POST['ghiChu']."',1,'','',0)";
                }else{
                    $query = "INSERT INTO `donhang`(`id`, Ban_id,`Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`, `thoiGianKetThuc`, `datBan`) 
                    VALUES (1,'".$_POST['getBanDat']."','".$_SESSION['id']."','$today ','".$_POST['ngaygiao']."','".$_POST['ghiChu']."',1,'','',0)";
                }
                if ($connectMySql->query($query) === TRUE) {
            
                    for ($i=0; $i < sizeof($_SESSION['cart']); $i++) { 
           
                        $query_get_id2 = "SELECT id FROM ct_donhang ORDER BY id DESC LIMIT 1";
                        $select_result = $connectMySql->query($query_get_id2);
                
                        if ($select_result->num_rows > 0) {
                
                            $row = $select_result->fetch_assoc();
                            (int)$selected_id2 = $row['id'];
                            (int)$selected_id2++;
                         
                            try{
                                $query = "INSERT INTO `ct_donhang`(`id`, `Foo_id`, `Don_id`, `soluongDonHang`) 
                                VALUES ('$selected_id2','".$_SESSION['cart'][$i]['foodId']."',1,'".$_SESSION['cart'][$i]['foodSoLuong']."')";
                
                                if ($connectMySql->query($query) === TRUE) {
                            
                                  
                                } else {
                            
                                    echo "Lỗi khi chèn dữ liệu: " . $query;
                                }
                            }catch(Exception $ex){
                                echo $query;
                            }
                    
                        } else if($select_result->num_rows == 0){
                            
                            try{
                                $query = "INSERT INTO `ct_donhang`(`id`, `Foo_id`, `Don_id`, `soluongDonHang`) 
                                VALUES (1,'".$_SESSION['cart'][$i]['foodId']."',1,'".$_SESSION['cart'][$i]['foodSoLuong']."')";
                                if ($connectMySql->query($query) === TRUE) {
                            
                                   echo "Loi";
                                } else {
                            
                                    echo "Lỗi khi chèn dữ liệu: " . $query;
                                }
                            }catch(Exception $ex)
                            {
                                echo $query;
                            }
                        }
                 }
                echo "1";
                } else {
            
                    echo "Lỗi khi chèn dữ liệu: " . $query;
                }
            }catch(Exception $ex)
            {
                echo $query;
            }
        }

    
   
    }
     
}
   



/*---- POST Send Data ----*/


?>
