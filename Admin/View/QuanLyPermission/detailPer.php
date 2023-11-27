<?php 
    include '../../../config/config.php';

    include '../../share/header.php';

    include '../../share/slide.php';
    $resultUser;
    if (isset($_GET["id"])) {
      //show hien quy chuan tren tabulator
      
      $query_get_id = "SELECT `id`, `name` FROM `permission` where id=".$_GET["id"]." LIMIT 1";

      $select_result = $connectMySql->query($query_get_id);

      if ($select_result->num_rows > 0) {

          $row = $select_result->fetch_assoc();
          $resultUser= $row;
      }
    }else{
      header("location:./index.php");
    }
?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Chi tiết quyền </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Chi tiết quyền</a></li>
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
                <h3 class="card-title">Chi tiết quyền </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <div class="form-group">
                    <label >Tên</label>
                    <input  type="hidden" id="idPer" value="<?php echo $_GET['id']; ?>">
                    <input type="text" id="nameP"  class="form-control" value="<?php echo  $resultUser['name'] ?>"> 
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success" id="createType"> Thêm</a>
                <a  class="btn btn-danger" id="backHome"> Quay Về</a>
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
 
      if($("#nameP").val()!=""){
        let dataCreate={
          id:$("#idPer").val(),
          name:$("#nameP").val(),
        };
       
        $.ajax({
          type: "POST",
          url: "./js/updatePer.php",
          data:dataCreate,
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