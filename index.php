

<?php 
  include "ShareView/header.php";
  include "ShareView/slider.php";

  $resultTpyeFood=array();
  $query_get_id = "SELECT `id`, `nameFood`, `imageURL`, `isBlock` FROM `typeoffood` where isBlock<>true";

  $select_result = $connectMySql->query($query_get_id);

  if ($select_result->num_rows > 0) {
      while($row = $select_result->fetch_assoc())
      {
          $resultTpyeFood[] = $row;
      }  
  }
  $resultFood=array();
  if(isset($_GET["id"]))
  {
    $query_get_id = "SELECT food.id, `Typ_id`, `tenMonAn`, `giaTien`, `moTa`, food.image_URL, food.isBlock, `soLuong`, `ngayThem`, `isNoiBat`, `giaTienMax`,typeoffood.nameFood
    FROM `food` ,typeoffood WHERE typeoffood.id=food.Typ_id and food.id = '".$_GET["id"]."' and  food.isBlock<>true and isNoiBat=true";
  
  }else{
    $query_get_id = "SELECT food.id, `Typ_id`, `tenMonAn`, `giaTien`, `moTa`, food.image_URL, food.isBlock, `soLuong`, `ngayThem`, `isNoiBat`, `giaTienMax`,typeoffood.nameFood
    FROM `food` ,typeoffood WHERE typeoffood.id=food.Typ_id and  food.isBlock<>true and isNoiBat=1";
  
  }
 
  $select_result = $connectMySql->query($query_get_id);

  if ($select_result->num_rows > 0) {
      while($row = $select_result->fetch_assoc())
      {
          $resultFood[] = $row;
      }  
  }

      $resultBaiViet2=array();
      $query_get_id = "SELECT baiviet.id, `Typ_id`, `ngayTao`, baiviet.isBlock, `Title`, `Detail`, `noiBat`, `imageURL` 
,typebaiviet.nameTypeBaiViet FROM `baiviet`, typebaiviet WHERE Typ_id=typebaiviet.id and baiviet.isBlock=0 and noiBat=1";
    
      $select_result = $connectMySql->query($query_get_id);
    
      if ($select_result->num_rows > 0) {
          while($row = $select_result->fetch_assoc())
          {
              $resultBaiViet2[] = $row;
          }  
      }


?>
</div>
  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="row">
          <?php foreach($resultBaiViet2 as $content) {?>
          <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
                <img src="<?php echo $content["imageURL"]; ?>" alt="">
              </div>
              <div class="detail-box">
                <h5>
                <?php echo $content["Title"]; ?>
                </h5>
                <h6>
                 <?php echo $content["nameTypeBaiViet"]; ?>
                </h6>
                <a href="">
                  Mua Ngay 
                </a>
              </div>
            </div>
          </div>
          <?php } ?> 
          <!-- <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
                <img src="images/o2.jpg" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Ngày ABC 
                </h5>
                <h6>
                  <span>15%</span> Giảm
                </h6>
                <a href="">
                 Mua Ngay <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                    <g>
                      <g>
                        <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                     c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                      </g>
                    </g>
                    <g>
                      <g>
                        <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                     C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                     c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                     C457.728,97.71,450.56,86.958,439.296,84.91z" />
                      </g>
                    </g>
                    <g>
                      <g>
                        <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                     c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                      </g>
                    </g>
                 
                  </svg>
                </a>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </section>



  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
            Menu Nổi bật Của Quán
        </h2>
      </div>

      <ul class="filters_menu">
       
         <?php
          if(isset($_GET['id']))
          {
            echo ' <li data-filter="*">Tất cả</li>';
          }else{
            echo ' <li class="active" data-filter="*">Tất cả</li>';
          }
          foreach($resultTpyeFood as $typeMonAn)
          {
            if(isset($_GET['id'])&&$_GET['id']==$typeMonAn['id'])
            { 
              echo '  <li class="active" data-filter="*"><a href="index.php?id='.$typeMonAn['id'].'">'.$typeMonAn['nameFood'].'</a></li>';
            }else{
              echo '  <li  data-filter="*"><a href="index.php?id='.$typeMonAn['id'].'">'.$typeMonAn['nameFood'].'</a></li>';
            }
          }
         ?>
      </ul>

      <div class="filters-content">
        <div class="row grid">
          <?php 
          foreach($resultFood as $food)
          {

          
          
          ?>
          <div class="col-sm-6 col-lg-4 all pizza">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src=" <?php echo $food['image_URL']; ?>" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                  <input type="hidden" id="foodName<?php echo $food['id']?>" value="<?php echo $food['tenMonAn']; ?>" >
                    <input type="hidden" id="foodPrice<?php echo $food['id']?>" value="<?php echo $food['giaTien']; ?>" >
                    <input type="hidden" id="foodSoLuong<?php echo $food['id']?>" value="<?php echo $food['soLuong']; ?>" >
                    <input type="hidden" id="foodImage<?php echo $food['id']?>" value="<?php echo $food['image_URL']; ?>" >
                    <input type="hidden" id="foodId<?php echo $food['id']?>" value="<?php echo $food['id']; ?>" >
                    <?php echo $food['tenMonAn']; ?>
                  </h5>
                  <p>
                    <?php echo $food['moTa']; ?>
                  
                  </p>
                  <div class="options">
                    <h6>
                    <?php echo number_format($food['giaTien'], 2, '.', ','); ?> VND
                    </h6>
                    <a  onclick="AddCart(<?php  echo $food['id']; ?>);"  >
                      <i class="fa fa-shopping-cart" style="font-size:24px;color:white"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <!-- <div class="btn-box">
        <a href="">
         Xem thêm 
        </a>
      </div> -->
    </div>
  </section>
  <script type="text/javascript">
  function AddCart(id)
  {
    if(confirm("bạn có muốn thêm vao giỏ hàng không"))
    {
      let data={
      name:$("#foodName"+id).val(),
      foodPrice:$("#foodPrice"+id).val(),
      foodSoLuong:$("#foodSoLuong"+id).val(),
      foodImage:$("#foodImage"+id).val(),
      foodId:$("#foodId"+id).val(),
    }
  // console.log(data);
    $.ajax({
        type: "POST",
        url: "./js/addCart.php",
        data:data,
        success: function(response) {
          console.log(response);
        },error: function(response) {
            console.log(response.responseText);
        }});
    }
   
  }
</script>
 <?php
  include "ShareView/footer.php"
 ?>