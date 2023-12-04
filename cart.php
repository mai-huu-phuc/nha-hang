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


</div>

 

 

  <!-- about section -->

  <section class="food_section layout_padding">
    <div class="container  ">
        <div class="row">
            <div class="col-md-12">
            <center>
                <h2>Giỏ hàng</h2>
            </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <style>
                    table, td, th {
                        border: 1px solid;
                        }
                </style>
                <table class="col-md-12" style=" border-collapse: collapse;border: 1px solid;">
                    <thead>
                        <tr>
                            <th>
                                STT
                            </th>
                            <th>
                                Tên Sản phẩm
                            </th>
                            <th>
                                Hình ảnh
                            </th>
                            <th>
                                Số lượng
                            </th>
                            <th>
                                Giá
                            </th>
                            <th>
                               Tổng Giá
                            </th>
                            <th>
                               Chức năng
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                
                        <?php 
                       
                      if(isset($_SESSION['cart']))
                      {

                      
                            $stt=0;
                        foreach( $_SESSION['cart'] as $cart) {
                            try {
                                $stt++;
                                echo '
                                        <tr>
                                            <td>'.$stt.'</td>
                                            <td>'.$cart['name'].'</td>
                                            <td><img src="'.$cart['foodImage'].'" style="width:100px;height:100px;"></td>
                                            <td><input type="number" id="numbersl'.$cart['foodId'].'" value="'.$cart['foodSoLuong'].'"></td>
                                            <td>'.number_format($cart['foodPrice'], 2, '.', ',').'</td>
                                            <td>'.number_format(((int)$cart['foodPrice']*(int)$cart['foodSoLuong']), 2, '.', ',').' VND</td>
                                            <td><a onclick="Detele('.$cart['foodId'].')" class="btn btn-danger">Xóa</a>
                                            <a onclick="Update('.$cart['foodId'].')" class="btn btn-primary">Cập nhật</a>
                                            </td>
                                        </tr>';
                            }catch(Exception  $e)
                            {

                            }
                        } }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=4 >Tổng giá sau khi tính</td>
                            <td colspan=3 ><?php echo number_format((int)$_SESSION['Tong'], 2, '.', ',');?> VND</td>
                           
                        </tr>
                        <tr>
                            <td colspan=4  ><center>Trong đó đã bao gồm thuế VAT</center></td>
                            <td colspan=3 ><?php echo number_format(((float)$_SESSION['Tong']*0.1), 2, '.', ',');?> VND</td>
                        </tr>
                        <tr>
                            <td colspan=4 >Tống thành Tiền</td>
                            <td colspan=3 ><?php echo number_format((int)$_SESSION['Tong'], 2, '.', ',');?> VND</td>
                        </tr>
                        <tr>
                            <td colspan=4 >Đặt bàn Không nếu có vui lòng chọn</td>
                            <td colspan=3 ><select name="" id="getBanDat" class="form-control">
                                <option value="">Không đặt Ship theo địa chỉ của tài khoản</option>
                                <?php foreach($resultTable as $table){
                                    echo ' <option value="'.$table['id'].'">'.$table['tenBan'].'</option>';
                                }  ?>
                            </select></td>
                           
                        </tr>
                         <tr>
                            <td colspan=4 >Cách thanh toán</td>
                            <td colspan=3 ><select name="" id="thanhToan" class="form-control">
                            <option value="1">Thay toán tiền mặt tại cửa hàng</option>
                            <option value="2">Thanh Toán chuyển khoản</option>
                            <option value="3">Thanh Toán khi nhận hàng</option>
                            </select></td>
                           
                        </tr>
                        <tr>
                            <td colspan=4 >Ngày giao nếu Ship hàng</td>
                            <td colspan=3 >
                                <input type="datetime-local" id="ngaygiao" class="form-control">
                            </td>
                           
                        </tr>
                        <tr>
                            <td colspan=4 >Ghi chú </td>
                            <td colspan=3 >
                                <input type="text" id="ghiChu" class="form-control">
                            </td>
                           
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <?php 
                if(!isset($_SESSION['logged_in'])){
                    echo '  <a class="btn btn-primary" href="./login.php">Thanh Toán</a>';
                  }else{
                    echo '  <a class="btn btn-primary" onclick="ThanhToan();">Thanh Toán</a>';
                  }
            
            ?>
          
        </div>
    </div>
  </section>
  <script type="text/javascript">
    function Detele(id)
    {
        if(confirm("Bạn có chắc muốn xóa"))
        {
            let data={
                 delete:id
            }
            $.ajax({
            type: "POST",
            url: "./js/addCart.php",
            data:data,
            success: function(response) {
                location.reload();
            },error: function(response) {
                location.reload();
            }});
        }
       
    }
    function Update(id)
    {
        if(confirm("Bạn có chắc muốn Cập nhật"))
        {
            let data={
            update:id,
            foodSoLuong:$("#numbersl"+id).val(),
           
            }
            $.ajax({
            type: "POST",
            url: "./js/addCart.php",
            data:data,
            success: function(response) {
                location.reload();
            },error: function(response) {
                location.reload();
            }});
        }
        
    }
    function ThanhToan()
    {
        if(confirm("Bạn có chắc cần thanh toán"))
        {
            let data={
            getBanDat:$("#getBanDat").val(),
            ngaygiao:$("#ngaygiao").val(),
            ghiChu:$("#ghiChu").val()
            }
            $.ajax({
            type: "POST",
            url: "./thanhToan.php",
            data:data,
            success: function(response) {
                console.log(response);
                alert("Thanh Toán thành công");
                window.location.href="index.php";
            },error: function(response) {
                console.log(response);
                // location.reload();
            }});
        }
    }
    
  </script>

  <!-- end about section -->

  <!-- footer section -->
<?php 
    include "ShareView/footer.php";

?>