<?php
  include "ShareView/header.php";

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
  if(isset($_GET['id']))
  {
    $query_get_id = "SELECT food.id, `Typ_id`, `tenMonAn`, `giaTien`, `moTa`, food.image_URL, food.isBlock, `soLuong`, `ngayThem`, `isNoiBat`, `giaTienMax`,typeoffood.nameFood
  FROM `food` ,typeoffood WHERE typeoffood.id=food.Typ_id and food.id = '".$_GET['id']."' and  food.isBlock<>true ";
  }else{
    $query_get_id = "SELECT food.id, `Typ_id`, `tenMonAn`, `giaTien`, `moTa`, food.image_URL, food.isBlock, `soLuong`, `ngayThem`, `isNoiBat`, `giaTienMax`,typeoffood.nameFood
  FROM `food` ,typeoffood WHERE typeoffood.id=food.Typ_id and  food.isBlock<>true ";
  }
  $select_result = $connectMySql->query($query_get_id);

  if ($select_result->num_rows > 0) {
      while($row = $select_result->fetch_assoc())
      {
          $resultFood[] = $row;
      }  
  }
?>


</div>

  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
        Menu Của Quán
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
              echo '  <li class="active" data-filter="*"><a href="menu.php?id='.$typeMonAn['id'].'">'.$typeMonAn['nameFood'].'</a></li>';
            }else{
              echo '  <li  data-filter="*"><a href="menu.php?id='.$typeMonAn['id'].'">'.$typeMonAn['nameFood'].'</a></li>';
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
  <!-- end food section -->

  <!-- footer section -->
  <?php
    include "ShareView/footer.php";
  
  ?>