<?php
  include "ShareView/header.php";

  if(!isset($_GET['id']))
  {
    echo '<script> window.location.href="index.php"</script>';
  }

  $resultBV=array();
  $query_get_id = "SELECT baiviet.id, `Typ_id`, `ngayTao`, baiviet.isBlock, `Title`, `Detail`, `noiBat`, `imageURL` 
  ,typebaiviet.nameTypeBaiViet FROM `baiviet`, typebaiviet WHERE Typ_id=typebaiviet.id and baiviet.isBlock=0 and  baiviet.id=".$_GET['id'];

  $select_result = $connectMySql->query($query_get_id);

  if ($select_result->num_rows > 0) {
      while($row = $select_result->fetch_assoc())
      {
          $resultBV[] = $row;
      }  
  }
 

?>


</div>

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="<?php echo $resultBV[0]["imageURL"] ?>" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                
               <?php 
               echo $resultBV[0]['Title']; ?>
              </h2>
            </div>
         
          </div>
        </div>
        <div class="col-md-12">
          <div class="detail-box">
              <?php echo $resultBV[0]['Detail'] ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- footer section -->
<?php 
    include "ShareView/footer.php";

?>