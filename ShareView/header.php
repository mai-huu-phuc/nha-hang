<?php
   
    include "./config/config.php";
    $hostname = $_SERVER['HTTP_HOST'];
    $port = $_SERVER['SERVER_PORT'];

    $base_url = "http://".$hostname."/banhang";

    $resultMenu=array();
    $query_Menu = "SELECT name, linkURL FROM menu WHERE  isBlock=0";
  
    $select_result = $connectMySql->query($query_Menu);
  
    if ($select_result->num_rows > 0) {
        while($row = $select_result->fetch_assoc())
        {
            $resultMenu[] = $row;
        }  
    }

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/logo.png" type="">

  <title> Tiểu luận </title>
    <script src="<?php echo $base_url.'/js/jquery-3.7.1.min.js'; ?>"></script>
    
    <link href="<?php echo $base_url.'/js/jquery.dataTables.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo $base_url.'/js/select.dataTables.min.css'; ?>" rel="stylesheet">
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <script src="<?php echo $base_url.'/js/jquery.dataTables.min.js'; ?>"></script>
  <script src="<?php echo $base_url.'/js/dataTables.select.min.js'; ?>"></script>

</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/nen.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              Tiểu luận
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <?php 
              foreach($resultMenu as $item)
              {
                  echo '<li class="nav-item">
                  <a class="nav-link" href="'.$item['linkURL'].'">'.$item['name'].'</a>
                </li>';
              }
              ?>            
            </ul>
            <div class="user_option">
              <?php 
               if(isset($_SESSION['logged_in'])) {
                if(isset($_SESSION['Per_id'])&&$_SESSION['Per_id']!=null)
                {
                  echo '<a href="./Admin/index.php" class="user_link">
                    <i class="fa fa-user" aria-hidden="true"> '.$_SESSION['name'].'</i>
                    </a>
                    <a class="cart_link" href="#">
                      <i class="fa fa-key" style="color:white;" >Đổi mật khẩu</i>
                    </a>
                    <form action="logout.php" method="post">
                    <button type="submit"  class="order_online">
                        Đăng xuất
                    </button></form>';
                }else{
                  echo '<a href="changeAccount.php" class="user_link">
                    <i class="fa fa-user" aria-hidden="true"> '.$_SESSION['name'].'</i>
                    </a>
                    <a class="cart_link" href="changePassword.php">
                      <i class="fa fa-key" style="color:white;" >Đổi mật khẩu</i>
                    </a>
                  
                    <a class="cart_link" href="cart.php">
                        <i class="fa fa-shopping-cart" style="color:white;" ></i>
                    </a>
                    <form action="logout.php" method="post">
                    <button type="submit"  class="order_online">
                        Đăng xuất
                    </button></form>';
                }
              }else{
                echo '<a href="login.php" class="user_link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                      </a>
                      <a class="cart_link" href="cart.php">
                          <i class="fa fa-shopping-cart" style="color:white;" ></i>
                      </a> 
                      <a   href="login.php" class="order_online">
                            Đăng nhập
                      </a>';
                    
              }
              ?>
              
              
             
            </div>
          </div>
        </nav>
      </div>
    </header>
    
    <!-- end header section -->