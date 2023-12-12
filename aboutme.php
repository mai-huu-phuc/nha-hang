<?php
  include "ShareView/header.php";
    $resultTpyeFood=array();
    $query=" SELECT  `name`, `userName`, `phone`, `address`, `age`, `email`, `CCCD` FROM `account` WHERE userName='admin'";

    $select_result = $connectMySql->query($query);

    if ($select_result->num_rows > 0) {
        while($row = $select_result->fetch_assoc())
        {
            $resultTpyeFood[] = $row;
        }  
    }
  ?>
</div>
    <section class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Thông tin liên hệ</h1>
                 
                    <p>Số điện thoại liên hệ: <?php echo  $resultTpyeFood[0]['phone']; ?></p>
                    <p>Địa chỉ liên hệ: <?php echo  $resultTpyeFood[0]['address']; ?></p>
                    <p>Thư điện tử của chúng tôi: <?php echo  $resultTpyeFood[0]['email']; ?></p>

                   

                </div>
            </div>

        </div>
    </section>  
  
  
  <!-- footer section -->
  <?php 
    include "ShareView/footer.php";

?>