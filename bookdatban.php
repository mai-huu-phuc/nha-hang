<?php
  include "ShareView/header.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['logged_in']))
    {
        $thoiGianGiao =mysqli_real_escape_string($connectMySql,$_POST['thoiGianGiao']);
        $ghiChu =mysqli_real_escape_string($connectMySql,$_POST['ghiChu']);
        $maKhuyenMai =mysqli_real_escape_string($connectMySql,$_POST['maKhuyenMai']);
        $idB =mysqli_real_escape_string($connectMySql,$_POST['idB']);
        $thoiGianKetThuc =mysqli_real_escape_string($connectMySql,$_POST['thoiGianKetThuc']);
        //kiem tra hinh anh va lay hinh anh cho vao forder upload
      
        if($thoiGianGiao=="")
        {	
            
          echo '<script > alert("Thêm không thành công");</script>';
        }else 
        {	
            $maxx=0;
            $query2="SELECT id FROM `donhang`ORDER BY id DESC LIMIT 1";
            $resultmax=$connectMySql->query($query2);
            if($resultmax->num_rows > 0)
            {
                $max=$resultmax->fetch_assoc();
                $maxx=$max['id'];
                $maxx++;
            }
            else{
                $maxx=1;
            }
  
          date_default_timezone_set('Asia/Ho_Chi_Minh');     
          $today = date('Y-m-d H:i:s');

          // var_dump(__DIR__);
          // var_dump($);
        
          $query="INSERT INTO `donhang`(`id`, `Ban_id`, `Acc_id`, `ngayTao`, `thoiGianGiao`, `ghiChu`, `thanhToan`, `maKhuyenMai`, `thoiGianKetThuc`, `datBan`) 
          VALUES ('$maxx','$idB','".$_SESSION['id']."','$today','$thoiGianGiao','$ghiChu',1,'$maKhuyenMai','$thoiGianKetThuc',1)";
  
          $result=$connectMySql->query($query); 
          if($result===TRUE)
          {
            echo '<script>   alert("Đặt thành công");</script>';
          }
          else{
            echo '<script > alert(Đặt không thành công");</script>';
          }
        }
    }
 
  }
    if(!isset($_GET['id']))
    {
       echo '<script>   window.location.href="index.php";</script>';
    }
 

?>


</div>

  <!-- about section -->

  <section class="food_section layout_padding">
    <div class="container  ">
        <div class="row">
            <div class="col-md-12">
            <center>
                <h1>Bàn: <?php if(isset($_GET['name'])) echo $_GET['name']; ?></h1>
            </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Đặt bàn
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="bookdatban.php" method="post">
              <div>
                    <label for="">Thời gian và ngày đặt bắt đầu</label>
                    <input type="datetime-local" class="form-control" name="thoiGianGiao" placeholder="Bắt Đầu" />
                    <input type="hidden" name="idB" class="form-control" value="<?php echo $_GET['id']; ?>" placeholder="Bắt Đầu" />
              </div>
              <div>
                    <label for="">Thời gian và ngày đặt kết thúc</label>
                    <input type="datetime-local" class="form-control" name="thoiGianKetThuc" placeholder="Kết thúc" />
              </div>
              <div>
                    <label for="">Ghi chú</label>
                    <input type="text" class="form-control" name="ghiChu" placeholder="Ghi Chú" />
              </div>
              <div>
                    <label for="">Mã khuyến mãi(nếu có)</label>
                    <input type="text" class="form-control" name="maKhuyenMai" placeholder="Mã Khuyến" />
              </div>
            
              <div class="btn_box">
                <?php if(isset($_SESSION['logged_in'])) {
                        echo '  <button>
                        Đặt Ngay
                      </button>'   ;
                }else{
                    echo '  <a href="login.php" class="btn btn-warning">
                        Đặt Ngay sau khi đăng nhập
                      </a>'   ;
                }
                    
                    ?>
              
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
        <div class="row"><h4>Danh sách thời gian đã đặt bàn</h4></div>
                <div class="row">
                    <table id="loadDatBan">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời Gian kết thúc<th>
                            </tr>
                        </thead>        
                    </table>
                </div> 
        </div>
      </div>
    </div>
  </section>
            </div>
        </div>

       
    </div>
  </section>
  <script type="text/javascript">
    $( document ).ready(function() {
        $.noConflict();
    let table = $('#loadDatBan').DataTable({});
    
    LoadMonAn(<?php echo $_GET['id']; ?>);
    });
    function LoadMonAn(id) { 
      let id_HoaDon={
        Ban_id:id
      }
      $.ajax({
          type: "POST",
          url: "./js/LoadDatBan.php",
          data: id_HoaDon,
          success: function(response) {
        1
              if ($.fn.dataTable.isDataTable('#loadDatBan')) {

                  $('#loadDatBan').DataTable().clear().destroy();
                  let stt = 0;
                  table = $('#loadDatBan').DataTable({
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
                     
                      order: [
                          [1, 'asc']
                      ],
                      columns: [
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
                                  if (row.thoiGianGiao != null) {
                                      id_active = row.thoiGianGiao;
                                  }
                                  return '<b>'+id_active+'</b>';
                              },
                             
                          },
                          {
                              data: null,
                              render: function(data, type, row) {
                                  var id_active = '';
                                  if (row.thoiGianKetThuc != null) {
                                      id_active = row.thoiGianKetThuc;
                                  }
                                  return '<b>' + id_active + '</b>';
                              },
                             
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