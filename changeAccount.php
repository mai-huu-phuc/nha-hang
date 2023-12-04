<?php
  include "ShareView/header.php";
  $resultAccount=array();
  if(!isset($_SESSION['logged_in'])){
    echo '<script> window.location.href="login.php"</script>';
  }else{

    $query_get_id = "SELECT * FROM `account` Where id=".$_SESSION['id']." limit 1";

    $select_result = $connectMySql->query($query_get_id);

    if ($select_result->num_rows > 0) {
        while($row = $select_result->fetch_assoc())
        {
            $resultAccount=$row;
        }  

    }else{
      echo '<script> alert("Đăng nhập đúng");</script>';
    }
  }
?>


</div>

  <!-- about section -->


  <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-6" style="margin:auto;">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cập tài khoản</h3>
              </div>
              <div class="card-body" style="display: block;">
                <div class="form-group">
                  <label >Tên</label>
                  <input type="text" id="nameU" name="" value="<?php echo $resultAccount['name'];?>" class="form-control">

                  <input type="hidden" id="idAccount" value="<?php echo $_SESSION['id']; ?>">
                </div>
                <div class="form-group">
                  <label >Email</label>
                  <input type="Email" id="Email" name="" value="<?php echo $resultAccount['email']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label >Phone</label>
                  <input type="number" id="Phone" name="" value="<?php echo $resultAccount['phone']; ?>" class="form-control">
                </div>
                 <div class="form-group">
                  <label >Address</label>
                  <input type="text" id="Address" name=""  value="<?php echo $resultAccount['address']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label >Age</label>
                  <input type="number" id="AgeU" name="" value="<?php echo $resultAccount['age']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label >CCCD</label>
                  <input type="number" id="CCCD" name="" value="<?php echo $resultAccount['CCCD']; ?>" class="form-control">
                </div>
                <div class="col-md-12">
                  <a class="btn btn-success" id="createType">Cập nhật</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
     
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <table id="loadHoaDon">
              <thead>
                <tr>
                  <th class="select-checkbox"><input id="checkBox" type="checkbox"></th>
                  <th>
                      STT
                  </th>
                  <th>
                      Mã Đơn
                  </th>
                  <th>
                     Ngày Đặt
                  </th>
                  <th>
                    Thời Gian Giao
                  </th>
                  <th>
                    Thời gian hoàn thành
                  </th>
                  <th>
                    
                  </th>
                </tr>
              </thead>
              <tbody>
               
              </tbody>
            </table>
          </div>
          <div class="col-md-12">
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
      </div>
    </section>

 <script type="text/javascript">
  $( document ).ready(function() {
    $.noConflict();
    let table2 = $('#loadHoaDon').DataTable({});
    let table = $('#loadMonAn').DataTable({});
    LoadDataSend();

    table2.on('click', 'button', function (e) {
              table2 = $('#loadHoaDon').DataTable();

                  let data = table2.row(e.target.closest('tr')).data(); 
                LoadMonAn(data['id']);
                
          });
    });

  $("#createType").click(()=>{
    if(confirm("Bạn có chắc muốn thêm không"))
    {
      if($("#nameU").val()!=""){
        let dataCreate=
        {
          name:$("#nameU").val(),
          id:$("#idAccount").val(),
          Phone:$("#Phone").val(),
          Email:$("#Email").val(),
          Age:$("#AgeU").val(),
          Address:$("#Address").val(),
          CCCD:$("#CCCD").val(),
        };
        $.ajax({
          type: "POST",
          url: "./js/UpdateUser.php",
          data: dataCreate,
          success: function(response) {
            console.log(response);
              if(response==1)
              {
                alert("cập nhật thành công");
                window.location.href="index.php"; 
              }else if(response==2){
                alert("cập nhật thất bại");
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
  

function LoadDataSend() {

  $.ajax({
      type: "POST",
      url: "./js/LoadHoaDon.php",
      data:{Acc_id:$("#idAccount").val()},
      success: function(response) {
                
          if ($.fn.dataTable.isDataTable('#loadHoaDon')) {

              $('#loadHoaDon').DataTable().clear().destroy();
              let stt = 0;
              table2 = $('#loadHoaDon').DataTable({
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
                          defaultContent: '<button class="btn btn-success"> Xem </button>',
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
                         // width: "5%",
                      },
                      {
                          data: null,
                          render: function(data, type, row) {
                              var id_active = '';
                              if (row.id != null) {
                                  id_active = row.id;
                              }
                              return '<a href="./detailTypeC.php?id='+row.id+'" >' + id_active + '<a >';
                          },
                        //  width: "15%",
                      },
                      {
                          data: null,
                          render: function(data, type, row) {
                              var id_active = '';
                              if (row.ngayTao != null) {
                                  id_active = row.ngayTao;
                              }
                              return '<b>' + id_active + '</b>';
                          },
                       //   width: "15%",
                      },
                    
                      {
                          data: null,
                          render: function(data, type, row) {
                              var id_active = '';
                              if (row.thoiGianGiao != null) {
                                  id_active = row.thoiGianGiao;
                              }
                              return '<b>' + id_active + '</b>';
                          },
                        //  width: "15%",
                      },
                      {
                          data: null,
                          render: function(data, type, row) {
                              var nameActive = '';
                              if (row.thoiGianKetThuc != null) {
                                  nameActive = row.thoiGianKetThuc;
                              }
                              return '<b>' + nameActive + '</b>';
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
function LoadMonAn(id) { 
      let id_HoaDon={
        id_HoaDon:id
      }
      $.ajax({
          type: "POST",
          url: "./Admin/View/QuanLyHoaDon/js/LoadMonAn.php",
          data: id_HoaDon,
          success: function(response) {
        1
              if ($.fn.dataTable.isDataTable('#loadMonAn')) {

                  $('#loadMonAn').DataTable().clear().destroy();
                  let stt = 0;
                  table = $('#loadMonAn').DataTable({
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
                                  return '<img src="'+id_active+'">';
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



 </script>
  <!-- end about section -->

  <!-- footer section -->
<?php 
    include "ShareView/footer.php";

?>