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

    $resultPermission=array();
    $query_get_id = "SELECT `id`, `name` FROM `permission`";

    $select_result2 = $connectMySql->query($query_get_id);

    if ($select_result2->num_rows > 0) {
        while($row = $select_result2->fetch_assoc())
        {
            $resultPermission[] = $row;
        }  
    }

    $resultUser;
    if (isset($_GET["id"])) {
      //show hien quy chuan tren tabulator
      
      $query_get_id = "SELECT `id`,`Per_id`, `name`, `userName`, `password`, `phone`, `address`, `age`, `email`, `CCCD`,`isBlock` FROM `account` where id=".$_GET["id"]." LIMIT 1";
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
            <h1 class="m-0">Thêm loại Hải sản</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Thêm loại Hải sản</a></li>
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
                <h3 class="card-title">Thêm loại Hải sản</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
              <div class="form-group">
                  <label >Tên</label>
                  <input  type="hidden" id="idUser" value="<?php echo $_GET['id']; ?>">
                  <input type="text" id="nameU" name="" class="form-control" value="<?php echo  $resultUser['name'] ?>"> 
                </div>
                <div class="form-group">
                  <label >UserName</label>
                  <input type="text" id="UserName" name="" class="form-control" value="<?php echo  $resultUser['userName'] ?>">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="Password" id="Password" name="" class="form-control" value="<?php echo  $resultUser['password'] ?>">
                </div>
                <div class="form-group">
                  <label >Email</label>
                  <input type="text" id="Email" name="" class="form-control" value="<?php echo  $resultUser['email'] ?>">
                </div>
                <div class="form-group">
                  <label >Phone</label>
                  <input type="text" id="Phone" name="" class="form-control" value="<?php echo  $resultUser['phone'] ?>">
                </div>
                 <div class="form-group">
                  <label >Address</label>
                  <input type="text" id="Address" name="" class="form-control" value="<?php echo  $resultUser['address'] ?>">
                </div>
                <div class="form-group">
                  <label >Age</label>
                  <input type="text" id="AgeU" name="" class="form-control" value="<?php echo  $resultUser['age'] ?>">
                </div>
                <div class="form-group">
                  <label >CCCD</label>
                  <input type="text" id="CCCD" name="" class="form-control" value="<?php echo  $resultUser['CCCD'] ?>">
                </div>
                <div class="form-group">
                  <label >Quyền</label>
                    <select name="" id="permission" class="form-control">
                        <option value=""> -- vui lòng chọn Quyền -- </option>
                            <?php
                                foreach ($resultPermission as $permi) {
                                  if($resultUser['Per_id']==$permi['id'])

                                    echo '<option selected value="'.$permi['id'].'">'.$permi['name'].'</option>'; 
                                  else
                                    echo '<option  value="'.$permi['id'].'">'.$permi['name'].'</option>'; 
                                }
                            ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Trạng thái</label>
                  <select id="inputStatus" class="form-control custom-select">
                    
                    <option <?php $resultUser['isBlock']==false ?  "selected": ""  ?> value="false">Hoạt Động</option>
                    <option  <?php $resultUser['isBlock']==true ?  "selected": ""  ?>  value="true">Khóa</option>
                   
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
      if($("#nameU").val()!=""){
        let dataCreate={
          id:$("#idUser").val(),
          name:$("#nameU").val(),
          UserName:$("#UserName").val(),
          Password:$("#Password").val(),
          Phone:$("#Phone").val(),
          Email:$("#Email").val(),
          Age:$("#AgeU").val(),
          Address:$("#Address").val(),
          CCCD:$("#CCCD").val(),
          isBlock:$("#inputStatus").val(),
          permission:$("#permission").val(),
        };
        $.ajax({
          type: "POST",
          url: "./js/updateUser.php",
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