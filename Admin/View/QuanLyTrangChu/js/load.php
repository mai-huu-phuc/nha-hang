<?php
include "../../../../config/config.php"
?>
<?php
header('Content-Type:application/json');
/*---- POST Send Data ----*/
$querry_donvi = 'SELECT id, name, isBlock,linkURL   FROM menu order by id';
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
        'linkURL'=> $value_donvi['linkURL'],
        'name'=> $value_donvi['name'],
        'isBlock'=> $value_donvi['isBlock'],
        'isHidden'=> ($value_donvi['isBlock']==null||$value_donvi['isBlock']==false)?'Hiện':'Ẩn',
    );
}
$final_donvi = json_encode($option_donvi);
echo $final_donvi;
?>
