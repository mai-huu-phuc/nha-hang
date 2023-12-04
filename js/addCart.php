<?php


include "../config/config.php";

if (!isset($_SESSION['cart'])) {
    $_SESSION['Tong']=0;
    $_SESSION['cart'] = array();
}
if(isset($_POST['name'])){
  
    if(sizeof($_SESSION['cart'])==0)
    {
        $add['name']=$_POST['name'];
        $add['foodPrice']=$_POST['foodPrice'];
        $add['foodSoLuong']=$_POST['foodSoLuong'];
        $add['foodImage']=$_POST['foodImage'];
        $add['foodId']=$_POST['foodId'];
        $_SESSION['cart'][] =$add;
        $_SESSION['Tong']=(int)$_POST['foodPrice']*(int)$_POST['foodSoLuong'];
       
        
    }else if(sizeof($_SESSION['cart'])>0){
        $check=0;
        $sumPrice=0;
        for ($i=0; $i < sizeof($_SESSION['cart']); $i++) { 
           
           if($_SESSION['cart'][$i]['foodId']==$_POST["foodId"])
            {
                $check=1;
                $_SESSION['cart'][$i]['foodSoLuong'] =(int)$_SESSION['cart'][$i]['foodSoLuong']+ (int)$_POST['foodSoLuong'];
            }
            $sumPrice+=(int)$_SESSION['cart'][$i]['foodSoLuong']*(int)$_SESSION['cart'][$i]['foodPrice'];
        }
        if($check==0)
        {
            $add['name']=$_POST['name'];
            $add['foodPrice']=$_POST['foodPrice'];
            $add['foodSoLuong']=$_POST['foodSoLuong'];
            $add['foodImage']=$_POST['foodImage'];
            $add['foodId']=$_POST['foodId'];
            $_SESSION['cart'][] =$add;
            $sumPrice+=(int)$_POST['foodPrice']*(int)$_POST['foodSoLuong'];
            
        }
        $_SESSION['Tong']=$sumPrice;

    }
    var_dump(  $_SESSION['cart']);
}
if(isset($_POST['delete']))
{
    $sumPrice=0;
    for ($i=0; $i < sizeof($_SESSION['cart']); $i++) { 
           
        if($_SESSION['cart'][$i]['foodId']==$_POST["delete"])
         {
            unset($_SESSION['cart'][$i]);
         }
         $sumPrice+=(int)$_SESSION['cart'][$i]['foodSoLuong']*(int)$_SESSION['cart'][$i]['foodPrice'];
     }
     $_SESSION['Tong']=$sumPrice;
}
if(isset($_POST['update']))
{
    $sumPrice=0;
    for ($i=0; $i < sizeof($_SESSION['cart']); $i++) { 
           
        if($_SESSION['cart'][$i]['foodId']==$_POST["update"])
         {
             
             $_SESSION['cart'][$i]['foodSoLuong'] =(int)$_POST['foodSoLuong'];
         }
         $sumPrice+=(int)$_SESSION['cart'][$i]['foodSoLuong']*(int)$_SESSION['cart'][$i]['foodPrice'];
     }
     $_SESSION['Tong']=$sumPrice;
}


/*---- POST Send Data ----*/


?>
