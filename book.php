<?php
      include "ShareView/header.php";
     
      $resultTable=array();
      $query_get_id = "SELECT `id`, `tenBan`, `isBlock` FROM `banan` where isBlock<>true";
    
      $select_result = $connectMySql->query($query_get_id);
    
      if ($select_result->num_rows > 0) {
          while($row = $select_result->fetch_assoc())
          {
              $resultTable[] = $row;
          }  
      }


?>
    <!-- end header section -->
  </div>

  <!-- book section -->
  <section class="offer_section layout_padding-bottom">

    <div class="container">
      <div class="heading_container">
        <h2>
         Đặt bàn
        </h2>
      </div>
    
      
        
        <div class="filters-content">
          <div class="row grid" style="position: relative; height: 406.5px;">
          <?php
                foreach($resultTable as $table)
                {

                

              ?>
            <div class="col-sm-6 col-lg-4 all pizza" >
             
              <div class="box">
              
                  <div class="img-box">
                    <img src=" images/banan.jpg" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                    <?php echo $table['tenBan'] ?>               </h5>
                   
                    <div class="options">
                      <h6>
                         Đặt ngay
                      </h6>
                      <a href="bookdatban.php?id=<?php echo $table['id']; ?>&&name=<?php echo  $table['tenBan']; ?>">
                        <i class="fa fa-shopping-cart" style="font-size:24px;color:white"> </i>
                      </a>
                    </div>
                  </div>
               </div>
                 
            </div> <?php } ?>
          </div>
      
      </div>
    </div>
    
  </section>
  <!-- end book section -->

  <!-- footer section -->
  <?php
    include "ShareView/footer.php";
  
  ?>