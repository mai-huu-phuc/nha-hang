<?php
include "../../../../config/config.php"
?>
<?php
header('Content-Type:application/json');
/*---- POST Send Data ----*/
$querry_donvi = 'SELECT food.id, `Typ_id`, `tenMonAn`, `giaTien`, `moTa`, food.image_URL, food.isBlock, `soLuong`, `ngayThem`, `isNoiBat`, `giaTienMax`,typeoffood.nameFood FROM `food`, typeoffood where typeoffood.id=food.Typ_id';
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
        'tenMonAn'=> $value_donvi['tenMonAn'],
        'giaTien'=> $value_donvi['giaTien'],   
        'moTa'=> $value_donvi['moTa'],
        'image_URL'=> $value_donvi['image_URL'],
        'soLuong'=> $value_donvi['soLuong'],
        'ngayThem'=> $value_donvi['ngayThem'],
        'isNoiBat'=> $value_donvi['isNoiBat'],
        'giaTienMax'=> $value_donvi['giaTienMax'],
        'nameFood'=> $value_donvi['nameFood'],
        'Typ_id'=> $value_donvi['Typ_id'],
        'isNoiBat'=> ($value_donvi['isNoiBat']==null||$value_donvi['isNoiBat']==false)?'Không':'Nổi bật',
        'isHidden'=> ($value_donvi['isBlock']==null||$value_donvi['isBlock']==false)?'Hiện':'Ẩn',

    );
}
$final_donvi = json_encode($option_donvi);
echo $final_donvi;
?>
