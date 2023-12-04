<?php
include "../config/config.php"
?>
<?php
header('Content-Type:application/json');
if(isset($_POST['Acc_id']))
{
    $querry_donvi = 'SELECT donhang.id, `Ban_id`, `Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`, `thoiGianKetThuc`,
    `datBan`,account.name FROM `donhang`, account WHERE account.id=Acc_id and Acc_id='.$_POST['Acc_id'].' order by donhang.id';
    // echo $querry_donvi;
    $result_donvi =$connectMySql->query($querry_donvi);

    if (!($result_donvi->num_rows > 0)) {
        echo "1";
        exit;
    }
    /*** Chuyển định dạng từ Array sang Json ***/
    $donviarr = array();

    while ($row = $result_donvi->fetch_assoc()) {
        
        $donviarr[]=$row;                                                
    }
    $jsonData_donvi = json_encode($donviarr);
    $original_donvi = json_decode($jsonData_donvi, true);
    $option_donvi = array();
    foreach ($original_donvi as $key => $value_donvi) {
        $option_donvi[] = array(
            'STT' => $key + 1,
            'id' => $value_donvi['id'],
            'Ban_id'=> $value_donvi['Ban_id'],
            'ngayTao'=> $value_donvi['ngayTao'],
            'thoiGianGiao'=> $value_donvi['thoiGianGiao'],
            'ghiChu'=> $value_donvi['ghiChu'],
            'thanhToan'=> $value_donvi['thanhToan'],
            'thoiGianKetThuc'=> $value_donvi['thoiGianKetThuc'],
            'datBan'=> $value_donvi['datBan'],
            'name'=> $value_donvi['name'],
        );
    }
    $final_donvi = json_encode($option_donvi);
    echo $final_donvi;
}
/*---- POST Send Data ----*/

?>
