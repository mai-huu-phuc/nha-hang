<?php
include "../../../../config/config.php"
?>
<?php
header('Content-Type:application/json');
if(!isset($_POST['id_HoaDon']))
{
    return null;
}else{



/*---- POST Send Data ----*/
    $querry_donvi = 'SELECT ct_donhang.id, `Foo_id`, `Don_id`, `soluongDonHang`,food.tenMonAn,food.giaTien,food.image_URL 
    FROM `ct_donhang`,food, donhang WHERE donhang.id=Don_id and Foo_id=food.id and Don_id='.$_POST['id_HoaDon'];
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
            'Foo_id'=> $value_donvi['Foo_id'],
            'Don_id'=> $value_donvi['Don_id'],   
            'soluongDonHang'=> $value_donvi['soluongDonHang'],
            'tenMonAn'=> $value_donvi['tenMonAn'],
            'image_URL'=> $value_donvi['image_URL'],
            'giaTien'=> $value_donvi['giaTien'],
        );
    }
    $final_donvi = json_encode($option_donvi);
    echo $final_donvi;
}
?>
