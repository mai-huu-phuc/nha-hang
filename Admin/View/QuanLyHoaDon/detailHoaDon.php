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
    $showthongtin=array();
    if (isset($_GET["id"])) {
      //show hien quy chuan tren tabulator
      
      $query_get_id = "SELECT donhang.id, `Ban_id`, `Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`, `thoiGianKetThuc`,
      `datBan`,banan.tenBan,account.name FROM `donhang`, banan, account WHERE banan.id=Ban_id and account.id=Acc_id order by donhang.id LIMIT 1";
      $select_result = $connectMySql->query($query_get_id);

      if ($select_result->num_rows > 0) {

          $row = $select_result->fetch_assoc();
          $showthongtin = $row;
          
      }
    }else{
      echo "<script> window.location.href='../index.php'</script>"
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
            <h1 class="m-0">Cập nhật Hóa Đơn</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cập nhật Hóa Đơn</a></li>
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
                <h3 class="card-title">Cập nhật Hóa Đơn</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <div class="form-group">
                    <label for="inputName">Chọn người dùng</label>
                    <input id="id_HoaDon" value="<?php echo  $_GET["id"]; ?>" type="hidden">
                    <select id="Acc_id" class="form-control custom-select">
                      <?php 
                        foreach ($resultNguoiDung as $nguoidung2) {
                          if($showthongtin["Acc_id"]==$nguoidung2['id']){
                            echo '<option selected value="'.$nguoidung2['id'].'">'.$nguoidung2['name'].'|'+$nguoidung2['userName']+'</option>'; 
                          }else
                          echo '<option value="'.$nguoidung2['id'].'">'.$nguoidung2['name'].'|'+$nguoidung2['userName']+'</option>'; 
                        }
                        
                      ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputName">Chọn Bàn</label>
                    <select id="Ban_id" class="form-control custom-select">
                      <?php 
                        foreach ($resultBanAn as $banan2) {
                          if($showthongtin["Ban_id"]==$nguoidung2['id']){
                            echo '<option selected value="'.$banan2['id'].'">'.$banan2['tenBan'].'</option>'; 
                          }else
                          echo '<option value="'.$banan2['id'].'">'.$banan2['tenBan'].'</option>'; 
                        }
                      ?>
                   
                   </select>
                </div>
                <div class="form-group">
                  <label for="inputName">Ghi chú</label>
                  <input type="text" id="ghiChu" name="" value="<?php echo $showthongtin['ghiChu']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Ngày tạo: <?php echo  $showthongtin["ngayTao"]; ?></label>
        
                </div>
                <div class="form-group">
                  <label for="inputName">Ngày kết thúc: <?php echo $showthongtin["thoiGianKetThuc"];?></label>
                  
                </div>
                <div class="form-group">
                  <label for="inputName">Thời gian giao</label>
                  <input type="date" id="thoiGianGiao" name="" value="<?php echo $showthongtin['thoiGianGiao']; ?>"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Mã khuyến mãi</label>
                  <input type="text" id="maKhuyenMai" value="<?php echo $showthongtin['maKhuyenMai']; ?>" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Thanh toán</label>
                  <select id="thanhToan" class="form-control custom-select">
                    <?php
                        switch ($showthongtin['maKhuyenMai']) {
                          case 1:
                              echo "  <option value="1">Tền Mặt</option>";
                              break;
                          case 2:
                              echo " <option value="2">Đã Thanh toán</option>";
                              break;
                          case 3:
                              echo "<option value="3">Chưa thanh toán</option>";
                              break;
                          case 4:
                            echo "<option value="4">Chuyển khoản</option>";
                            break;
                        }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="inputName">Đặt bàn</label>
                  <select id="datBan" class="form-control custom-select">
                        <?php 
                          switch($showthongtin['datBan'])
                          {
                            case 0:
                              echo "  <option value="false">Không</option>";
                              break;
                            case 1:
                              echo "<option value="true">Có</option>";
                              break;
                          }
                        
                        ?>
                
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tạo hóa đơn</h3>

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
                          echo '<option value="'.$nguoidung2['id'].'">'.$nguoidung2['name'].'|'+$nguoidung2['userName']+'</option>'; 
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
                  <input type="text" id="ghiChu" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Thời gian giao</label>
                  <input type="date" id="thoiGianGiao" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Mã khuyến mãi</label>
                  <input type="text" id="maKhuyenMai" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Thanh toán</label>
                  <select id="thanhToan" class="form-control custom-select">
                    <option value="1">Thay toán tiền mặt tại cửa hàng</option>
                    <option value="2">Thanh Toán chuyển khoản</option>
                    <option value="3">Thanh Toán khi nhận hàng</option>
                   
                    <option value="4">Đã Thanh toán</option>
                    <option value="5">Chưa thanh toán</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="inputName">Đặt bàn</label>
                  <select id="datBan" class="form-control custom-select">
                    <option value="true">Có</option>
                    <option value="false">Không</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
        </div>
        <div class="row">
          <div class=col-md-6>
              <h1>danh sách món ăn</h1>    

          </div>
          <div class=col-md-6>
              <h1>Món ăn</h1>
          </div>
        </div>
        <div class="row">
          <div class=col-md-6>
              <table id="danhSachMonAn" class="row-border">
                  <thead>
                      <tr>
                          <th class="select-checkbox"><input id="checkBox" type="checkbox"></th>
                          <th>STT</th>
                          <th>Hình Ảnh</th>
                          <th>Loại món ăn</th>
                          <th>Tên món ăn</th>
                          <th>giá Tiền </th>
                          <th>Số Lượng</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>

                  </tfoot>
              </table>
          </div>
          <div class=col-md-6>
              <table id="loadMonAn" class="row-border">
                  <thead>
                      <tr>
                          <th class="select-checkbox"><input id="checkBox" type="checkbox"></th>
                          <th>STT</th>
                          <th>Hình Ảnh</th>
                          <th>Tên món ăn</th>
                          <th>giá Tiền </th>
                          <th>Số lượng</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  </tfoot>
              </table>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success" id="createType" > Thêm</a>
                <a class="btn btn-success" id="successBill" > Hoàn thành Đơn</a>
                <a  class="btn btn-danger" id="backHome" herf="./index.php"> Quay Về</a>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
 
<script type="text/javascript">
    $( document ).ready(function() {
        let table2 = $('#danhSachMonAn').DataTable({});
        table2.on('click', 'button', function (e) {
            table2 = $('#danhSachMonAn').DataTable();

                let data = table2.row(e.target.closest('tr')).data();
               console.log( $("#Soluong"+data['id']).val());
                let messengerData = {
                    id_HoDon:$("#id_HoaDon").val(),
                    id_Monan: data["id"],
                    soLuong:  $("#Soluong"+data['id']).val()
                }

                if (data["id"] != null) {
                if(confirm("Bạn có chắc muốn xóa: "+data["title"]))
                {
                    $.ajax({
                        type: "POST",
                        url: "./js/AddMonAn.php",
                        data: messengerData,
                        success: function (response) {
                            LoadDataSend();
                            if (response == 11) {
                                LoadDataSend();
                            } else {
                                alert("Lỗi không thể thêm được");
                                console.log(response);
                            }
                        }, error: function (response) {
                            console.log(response.responseText);
                        }
                    });
                }               
            }
        });

        let table = $('#loadMonAn').DataTable({});
        table.on('click', 'button', function (e) {
          table = $('#loadMonAn').DataTable();

                let data = table.row(e.target.closest('tr')).data();
               console.log( $("#Soluong"+data['id']).val());
                let messengerData = {
                    id: data["id"],
                }

                if (data["id"] != null) {
                if(confirm("Bạn có chắc muốn xóa: "+data["tenMonAn"]))
                {
                    $.ajax({
                        type: "POST",
                        url: "./js/DeleteMonAn.php",
                        data: messengerData,
                        success: function (response) {
                            LoadDataSend();
                            if (response == 11) {
                                LoadDataSend();
                            } else {
                                alert("Lỗi không thể thêm được");
                                console.log(response);
                            }
                        }, error: function (response) {
                            console.log(response.responseText);
                        }
                    });
                }               
            }
        });
        LoadDataSend();
    });
   
    function LoadDataSend() { 
      $.ajax({
          type: "POST",
          url: "../QuanLyFood/js/LoadF.php",
          success: function(response) {
        
              if ($.fn.dataTable.isDataTable('#danhSachMonAn')) {

                  $('#danhSachMonAn').DataTable().clear().destroy();
                  let stt = 0;
                  table2 = $('#danhSachMonAn').DataTable({
                      language: {
                          emptyTable: "Không có dữ liệu",
                          sSearch: "Tìm kiếm",
                      },
                      oLanguage: {
                          oPaginate: {

                              "sLast": "Trang Cuối",
                              "sNext": "Trang Kế Tiếp",
                              "sPrevious": "Trang Sau",
                              "sFirst": "Trang Đầu",
                              "sLoadingRecords": "Đang tải vui lòng đợi...",
                              "sInfo": "_START_ đến _END_ của tổng _TOTAL_"
                          }
                      },
                      select: {
                          style: 'os',
                          selector: 'td:first-child',
                          style: 'multi',

                      },
                      data: response,
                      columnDefs: [{
                              orderable: false,
                              className: 'select-checkbox',
                              targets: 0
                          },
                         
                          {
                              data: null,
                              defaultContent: '<button class="btn btn-primary"> Thêm </button>',
                              targets: -1
                          }
                      ],
                      order: [
                          [1, 'asc']
                      ],
                      columns: [{
                              data: null,
                            
                              render: function() { return null; },
                              width: "2%",
                          },
                          {
                              data: null,
                              render: function() {
                                  if (stt > response.length) {
                                      return null;
                                  } else {
                                      stt = stt + 1;
                                      return stt;
                                  }
                              },
                              width: "5%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.image_URL != null) {
                                      id_active = row.image_URL;
                                  }
                                  return '<img src="../../../'+id_active+'">';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.nameFood != null) {
                                      id_active = row.nameFood;
                                  }
                                
                                  return '<b>' + id_active + '</b>';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.tenMonAn != null) {
                                      id_active = row.tenMonAn;
                                  }
                                  return '<b>' + id_active + '</b>';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.giaTien != null) {
                                      id_active = row.giaTien;
                                  }
                                  return '<b>' + id_active + '</b>';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.id != null) {
                                      id_active = row.id;
                                  }
                                  return '<input type="number" id="Soluong'+id+'" >';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                          },
                      ],
                  });
              }
          },
          error: function(response) {
              console.log(response.responseText);
          }
      });
    }
    function LoadMonAn() { 
      let id_HoaDon={
        id_HoaDon:$("#id_HoaDon").val()
      }
      $.ajax({
          type: "POST",
          url: "../QuanLyFood/js/LoadF.php",
          data: id_HoaDon,
          success: function(response) {
        
              if ($.fn.dataTable.isDataTable('#loadMonAn')) {

                  $('#loadMonAn').DataTable().clear().destroy();
                  let stt = 0;
                  table2 = $('#loadMonAn').DataTable({
                      language: {
                          emptyTable: "Không có dữ liệu",
                          sSearch: "Tìm kiếm",
                      },
                      oLanguage: {
                          oPaginate: {

                              "sLast": "Trang Cuối",
                              "sNext": "Trang Kế Tiếp",
                              "sPrevious": "Trang Sau",
                              "sFirst": "Trang Đầu",
                              "sLoadingRecords": "Đang tải vui lòng đợi...",
                              "sInfo": "_START_ đến _END_ của tổng _TOTAL_"
                          }
                      },
                      select: {
                          style: 'os',
                          selector: 'td:first-child',
                          style: 'multi',

                      },
                      data: response,
                      columnDefs: [{
                              orderable: false,
                              className: 'select-checkbox',
                              targets: 0
                          },
                          {
                              data: null,
                              defaultContent: '<button class="btn btn-danger"> Xóa </button>',
                              targets: -1
                          }
                      ],
                      order: [
                          [1, 'asc']
                      ],
                      columns: [{
                              data: null,
                            
                              render: function() { return null; },
                              width: "2%",
                          },
                          {
                              data: null,
                              render: function() {
                                  if (stt > response.length) {
                                      return null;
                                  } else {
                                      stt = stt + 1;
                                      return stt;
                                  }
                              },
                              width: "5%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.image_URL != null) {
                                      id_active = row.image_URL;
                                  }
                                  return '<img src="../../../'+id_active+'">';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.tenMonAn != null) {
                                      id_active = row.tenMonAn;
                                  }
                                  return '<b>' + id_active + '</b>';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.giaTien != null) {
                                      id_active = row.giaTien;
                                  }
                                  return '<b>' + id_active + '</b>';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.soluongDonHang != null) {
                                      id_active = row.soluongDonHang;
                                  }
                                  return '<b>' + id_active + '</b>';
                              },
                              width: "15%",
                          },
                          {
                              data: null,
                          },
                      ],
                  });
              }
          },
          error: function(response) {
              console.log(response.responseText);
          }
      });
    }
      
  $("#backHome").click(()=>{
    window.location.href="index.php";
  });
  $("#successBill").click(()=>{
    if(confirm("Bạn có chắc muốn hoàn thành đơn không"))
    {
      let succsess={
        id:$("#id_HoaDon").val(),
        suc:true,
      }
      $.ajax({
          type: "POST",
          url: "./js/updateHoaDon.php",
          data:dataCreate,
          success: function(response) {
            window.location.href="index.php"; 
          },
          error: function(response) {}
        });

    }
  })
  $("#createType").click(()=>{
    if(confirm("Bạn có chắc muốn cập nhật không"))
    {
      if($("#nameFood").val()==""){
        let dataCreate={
          Acc_id:$("#Acc_id").val(),
          Ban_id:$("#Ban_id").val(),
          ghiChu:$("#ghiChu").val(),
          thoiGianGiao:$("#thoiGianGiao").val(),
          maKhuyenMai:$("#maKhuyenMai").val(),
          thanhToan:$("#thanhToan").val(),
          datBan:$("#datBan").val(),
          id:$("#id_HoaDon").val(),
        };
        $.ajax({
          type: "POST",
          url: "./js/updateHoaDon.php",
          data:dataCreate,
          success: function(response) {
              if(response==1)
              {
                alert("Cập nhật thành công ");
                window.location.href="index.php"; 
              }else if(response==2){
                alert("Cập nhật thất bại");
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