<?php 
    include '../../../config/config.php';

    include '../../share/header.php';

    include '../../share/slide.php';

    if(isset($_SESSION['logged_in'])){
      if(isset($_SESSION['Per_id']))
      { 
        if($_SESSION['Per_id']==null)
        {
          echo '<script> window.location.href="'.$base_url.'/index.php"</script>';
        }
      }
    }else{
       echo '<script> window.location.href="'.$base_url.'/index.php"</script>';
    }

    $resultBanAn=array();
    $query_get_id = "SELECT `id`, `tenBan` FROM `banan`";

    $select_result = $connectMySql->query($query_get_id);

    if ($select_result->num_rows > 0) {
        while($row = $select_result->fetch_assoc())
        {
            $resultBanAn[] = $row;
        }  
    }
    
    $resultNguoiDung=array();
    $query_get_id = "SELECT `id`, `name`,userName FROM `account`";

    $select_result = $connectMySql->query($query_get_id);

    if ($select_result->num_rows > 0) {
        while($row = $select_result->fetch_assoc())
        {
            $resultNguoiDung[] = $row;
        }  
    }

?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tạo hóa đơn</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Tạo hóa đơn</a></li>
              <li class="breadcrumb-item active">Hải sản</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tạo Hóa Đơn</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <div class="form-group">
                    <label for="inputName">Chọn người dùng</label>
                   
                    <select id="Acc_id" class="form-control custom-select">
                      <?php 
                        foreach ($resultNguoiDung as $nguoidung2) {
                       
                          echo '<option value="'.$nguoidung2['id'].'">'.$nguoidung2['name'].'|'.$nguoidung2['userName'].'</option>'; 
                        }
                        
                      ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputName">Chọn Bàn</label>
                    <select id="Ban_id" class="form-control custom-select">
                      <?php 
                        foreach ($resultBanAn as $banan2) {
                         
                          echo '<option value="'.$banan2['id'].'">'.$banan2['tenBan'].'</option>'; 
                        }
                      ?>
                   
                   </select>
                </div>
                <div class="form-group">
                  <label for="inputName">Ghi chú</label>
                  <input type="text" id="ghiChu" name=""  class="form-control">
                </div>
            
                <div class="form-group">
                  <label for="inputName">Thời gian giao</label>
                  <input type="datetime-local" id="thoiGianGiao" name=""   class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Mã khuyến mãi</label>
                  <input type="text" id="maKhuyenMai" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Thanh toán</label>
                  <select id="thanhToan" class="form-control custom-select">
                  <option value="1">Tền Mặt</option>
                  <option value="2">Đã Thanh toán</option>
                  <option value="3">Chưa thanh toán</option>
                  <option value="4">Chuyển khoản</option>
                  
                  </select>
                </div>

                <div class="form-group">
                  <label for="inputName">Đặt bàn</label>
                  <select id="datBan" class="form-control custom-select">
                    <option value="false">Không</option>
                    <option value="true">Có</option>
                       
                
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
  
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success" id="createType">Tạo hóa đơn</a>
                <a  class="btn btn-danger" id="backHome">Quay Về</a>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
 
<script type="text/javascript">
  $("#backHome").click(()=>{
    window.location.href="index.php";
  });
  $("#createType").click(()=>{
    if(confirm("Bạn có chắc muốn thêm không"))
    {
      if($("#ghiChu").val()!=""){
        let dataCreate=
        {
          Acc_id:$("#Acc_id").val(),
          Ban_id:$("#Ban_id").val(),
          ghiChu:$("#ghiChu").val(),
          thoiGianGiao:$("#thoiGianGiao").val(),
          maKhuyenMai:$("#maKhuyenMai").val(),
          thanhToan:$("#thanhToan").val(),
          datBan:$("#datBan").val(),
        };
        $.ajax({
          type: "POST",
          url: "./js/CreateHoaDon.php",
          data: dataCreate,
          success: function(response) {
              if(response==1)
              {
                alert("Thêm thành công");
                window.location.href="index.php"; 
              }else if(response==2){
                alert("Thêm thất bại");
              }else{
                console.log(response);
                alert("Đã có lỗi xảy ra");
              }
          },
          error: function(response) {
            console.log(response);
            alert(response.responseText);
          }
        });
      }
        
    }
  });
</script>
  
<?php 
    include '../../share/footer.php';
?>