<?php
      $resultBaiViet=array();
      $query_get_id = "SELECT baiviet.id, `Typ_id`, `ngayTao`, baiviet.isBlock, `Title`, `Detail`, `noiBat`, `imageURL` 
,typebaiviet.nameTypeBaiViet FROM `baiviet`, typebaiviet WHERE Typ_id=typebaiviet.id and baiviet.isBlock=0";
    
      $select_result = $connectMySql->query($query_get_id);
    
      if ($select_result->num_rows > 0) {
          while($row = $select_result->fetch_assoc())
          {
              $resultBaiViet[] = $row;
          }  
      }
?>

<section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        <?php 
        $bientam=0;
        foreach($resultBaiViet as $BV)
        {
            
         ?> 
        <div class="carousel-item <?php if($bientam==0) echo 'active'; ?> ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                     <?php echo $BV['Title']; ?>
                    </h1>
                    <p>
                    <?php echo $BV['nameTypeBaiViet']; ?>
                    </p>
                    <div class="btn-box">
                      <a href="./about.php?id=<?php echo $BV['id']; ?>" class="btn1">
                        Xem
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php $bientam=1; }?>
        </div>
        <div class="container">
          <ol class="carousel-indicators">
          <?php
          $bientam=0;
          foreach($resultBaiViet as $click)
          {
            if($bientam==0)
            echo '<li data-target="#customCarousel1" data-slide-to="0" class="active"></li>';
            else
            echo '<li data-target="#customCarousel1" data-slide-to="'.$bientam.'" ></li>';
            $bientam++;
          }    
          
          ?>
          
          </ol>
        </div>
      </div>

    </section>
    <!-- end slider section -->
