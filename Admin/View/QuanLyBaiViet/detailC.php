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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id =mysqli_real_escape_string($connectMySql,$_POST['id']);
      $Title =mysqli_real_escape_string($connectMySql,$_POST['Title']);
      $Detail =mysqli_real_escape_string($connectMySql,$_POST['Detail']);
      $isBlock =mysqli_real_escape_string($connectMySql,$_POST['isBlock']);
      $noiBat =mysqli_real_escape_string($connectMySql,$_POST['noiBat']);
      $Typ_id =mysqli_real_escape_string($connectMySql,$_POST['Typ_id']);	
  
      //kiem tra hinh anh va lay hinh anh cho vao forder uploads
      $permitred =array('jpg','jpeg','png','gif');
      $files_name=$_FILES['imageURL']['name'];
      $files_size=$_FILES['imageURL']['size'];
      $files_temp=$_FILES['imageURL']['tmp_name'];
      $div=explode('.', $files_name);
      $file_ext=strtolower(end($div));
      $unique_image=substr(md5(time()),0,10).'.'.$file_ext;
      $update_image="images/".$unique_image;
    
      if($Title==""||$Detail==""||$isBlock==""||$noiBat==""||$Typ_id=="")
      {	
          
        echo '<script > alert("Thêm không thành công");</script>';
      }else 
      {	

        $updateFile="";
        if($files_name=$_FILES['imageURL']['name']!=null)
        {
            move_uploaded_file($files_temp,"../../../images/".$unique_image);
            $updateFile=",imageURL='".$update_image."'";
        }
        // var_dump(__DIR__);
        // var_dump($);
      

        $query="UPDATE `baiviet` SET `Typ_id`='$Typ_id',`isBlock`='$isBlock',
        `Title`='$Title',`Detail`='$Detail',`noiBat`='$noiBat' ".$updateFile." WHERE `id`=".$id;

        $result=$connectMySql->query($query); 
        if($result===TRUE)
        {
          echo '<script>   window.location.href="index.php";</script>';
        }
        else{
          echo '<script > alert("Thêm không thành công");</script>';
        }
      }
    }
    if (isset($_GET["id"])) {
      //show hien quy chuan tren tabulator
      
      $query_get_id = "SELECT baiviet.id, `Typ_id`, `ngayTao`, baiviet.isBlock, `Title`, `Detail`, `noiBat`, `imageURL` 
      ,typebaiviet.nameTypeBaiViet FROM `baiviet` ,typebaiviet WHERE typebaiviet.id=baiviet.Typ_id and baiviet.id=".$_GET["id"]." LIMIT 1";
    
    $select_result = $connectMySql->query($query_get_id);

      if ($select_result->num_rows > 0) {

          $row = $select_result->fetch_assoc();
          $showthongtin = $row;
          
      }
    }else{
      echo '<script>   window.location.href="index.php";</script>';
    }

    $resultTypeConent=array();
    $query_get_id = "SELECT `id`, `nameTypeBaiViet` FROM `typebaiviet` Where isBlock<>true";

    $select_result = $connectMySql->query($query_get_id);

    if ($select_result->num_rows > 0) {
        while($row = $select_result->fetch_assoc())
        {
            $resultTypeConent[] = $row;
        }  
    }
  
?>

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cập bài viết</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cập nhật Bài viết</a></li>
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
        <form action="detailC.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cập nhật viết</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
          
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $showthongtin['id'] ?>">
                    <label for="inputName">Tiêu Đề</label>
                    <input type="text" id="tieude" name="Title" class="form-control" value="<?php echo $showthongtin['Title'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputName">Nội Dung</label>
                    <textarea name="Detail" id="ckeditor" cols="30" rows="10" class="form-control"><?php echo $showthongtin['Detail'] ?></textarea >
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Trạng thái</label>
                    <select id="inputStatus" name="isBlock" class="form-control custom-select">
                    <?php
                      if($showthongtin['isBlock']==0)
                      {
                        echo ' <option selected value="false">Hoạt Động</option>
                              <option value="true">Khóa</option>';
                      }else{
                        echo ' <option value="false">Hoạt Động</option>
                            <option  selected value="true">Khóa</option>';
                      }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputStatus" >Nổi bật</label>
                    <select id="inputStatus" name="noiBat" class="form-control custom-select">
                      <?php
                        if($showthongtin['noiBat']==0)
                        {
                          echo ' <option selected value="0">Không </option>
                          <option  value="1">Có</option>';

                        }else{
                          echo ' <option value="0">Không </option>
                          <option  selected value="1">Có</option>';
                        }
                      
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label >Kiểu Bài Viết</label>
                      <select name="Typ_id" id="permission" class="form-control">
                          <option value=""> -- vui lòng chọn Kiểu -- </option>
                              <?php
                                  foreach ($resultTypeConent as $permi) {
                                    if($permi['id']==$showthongtin['Typ_id'])
                                    echo '<option selected value="'.$permi['id'].'">'.$permi['nameTypeBaiViet'].'</option>'; 
                                    else
                                      echo '<option  value="'.$permi['id'].'">'.$permi['nameTypeBaiViet'].'</option>'; 
                                  }
                              ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="image">Select Image:</label>
                     <input type="file" name="imageURL" id="image" accept="image/*">
                  </div>
                  <div class="form-group">
                    <label for="image">Hình:</label>
                    <img src="../../../<?php echo $showthongtin['imageURL'];?>" width=200 height=200>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               <input class="btn btn-success" type="submit" value="Thêm">             
                <a  class="btn btn-danger" id="backHome"> Quay Về</a>
            </div>
        </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
 
<script type="text/javascript">
  $("#backHome").click(()=>{
    window.location.href="index.php";
  });
  // $("#createType").click(()=>{
  //   if(confirm("Bạn có chắc muốn thêm không"))
  //   {
  //     if($("#nameFood").val()==""){
  //       let dataCreate={
  //         id:$("#idType").val(),
  //         isBlock:$("#inputStatus").val(),
  //         nameTypeBaiViet:$("#nameFood").val()
  //       };
  //       $.ajax({
  //         type: "POST",
  //         url: "./js/updateC.php",
  //         data:dataCreate,
  //         success: function(response) {
  //             if(response==1)
  //             {
  //               alert("Cập nhật thành công ");
  //               window.location.href="index.php"; 
  //             }else if(response==2){
  //               alert("Cập nhật thất bại");
  //             }else{
  //               console.log(response);
  //               alert("Đã có lỗi xảy ra");
  //             }
  //         },
  //         error: function(response) {
  //           console.log(response);
  //           alert(response.responseText);
  //         }
  //       });
  //     }
        
  //   }
  // });
  $(document).ready(function () {
     //   $('#ckeditor').ckeditor();
        ClassicEditor
        .create( document.querySelector( '#ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
    });
</script>
  
<?php 
    include '../../share/footer.php';
?>