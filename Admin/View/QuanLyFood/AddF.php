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
    $resultTypeConent=array();
    $query_get_id = "SELECT `id`, `nameFood` FROM `typeoffood` Where isBlock<>true";

    $select_result = $connectMySql->query($query_get_id);

    if ($select_result->num_rows > 0) {
        while($row = $select_result->fetch_assoc())
        {
            $resultTypeConent[] = $row;
        }  
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $tenMonAn =mysqli_real_escape_string($connectMySql,$_POST['tenMonAn']);
      $giaTien =mysqli_real_escape_string($connectMySql,$_POST['giaTien']);
      $moTa =mysqli_real_escape_string($connectMySql,$_POST['moTa']);
      $isBlock =mysqli_real_escape_string($connectMySql,$_POST['isBlock']);
      $soLuong =mysqli_real_escape_string($connectMySql,$_POST['soLuong']);
      $isNoiBat =mysqli_real_escape_string($connectMySql,$_POST['isNoiBat']);
      $giaTienMax =mysqli_real_escape_string($connectMySql,$_POST['giaTienMax']);
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
    
      if($tenMonAn==""||$giaTien==""||$moTa==""||$soLuong==""||$isNoiBat=="")
      {	
          
        echo '<script > alert("Thêm không thành công");</script>';
      }else 
      {	
          $maxx=0;
          $query2="SELECT id FROM `food`ORDER BY id DESC LIMIT 1";
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

        if($noiBat=="1"||$noiBat==1)
        {
            $sp=1;
        }else
        {
            $sp=0;
        }
        // var_dump(__DIR__);
        // var_dump($);
        move_uploaded_file($files_temp,"../../../images/".$unique_image);

        $query="INSERT INTO `food`(`id`, `Typ_id`, `tenMonAn`, `giaTien`, `moTa`, `image_URL`, `isBlock`, `soLuong`, `ngayThem`, `isNoiBat`, `giaTienMax`)
         VALUES ('$maxx','$Typ_id','$tenMonAn','$giaTien','$moTa','$update_image','$isBlock','$soLuong','$today','$isNoiBat','$giaTienMax')";

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
?>

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Thêm Món ăn</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Thêm Món ăn</a></li>
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
        <form action="AddF.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm Món ăn</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
          
                <div class="form-group">
                    <label for="inputName">Tên món ăn</label>
                    <input type="text" id="tieude" name="tenMonAn" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="inputName">Giá tiền</label>
                    <input type="number" id="tieude" name="giaTien" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="inputName">Mô tả</label>
                    <textarea name="moTa" id="ckeditor" cols="30" rows="10" class="form-control"></textarea >
                  </div>
                  <div class="form-group">
                    <label for="inputName">Giá tiền tối đa</label>
                    <input type="number" id="tieude" name="giaTienMax" class="form-control">
                  
                  </div>
                  <div class="form-group">
                    <label for="inputName">Số lượng</label>
                    <input type="number" id="tieude" name="soLuong" class="form-control">
                    <!-- <textarea name="moTa" id="ckeditor" cols="30" rows="10" class="form-control"></textarea > -->
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Trạng thái</label>
                    <select id="inputStatus" name="isBlock" class="form-control custom-select">
                      <option value="false">Hoạt Động</option>
                      <option value="true">Khóa</option>
                     
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputStatus" >Nổi bật</label>
                    <select id="inputStatus" name="isNoiBat" class="form-control custom-select">
                      <option value="1">Có</option>
                      <option value="0">Không</option>
                     
                    </select>
                  </div>
                  <div class="form-group">
                    <label >Loại Món ăn</label>
                      <select name="Typ_id" id="permission" class="form-control">
                          <option value=""> -- vui lòng chọn Loại -- </option>
                              <?php
                                  foreach ($resultTypeConent as $permi) {
                                      echo '<option value="'.$permi['id'].'">'.$permi['nameFood'].'</option>'; 
                                  }
                              ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="image">Select Image:</label>
                     <input type="file" name="imageURL" id="image" accept="image/*">
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
  //     if($("#nameFood").val()!=""){
  //       let dataCreate=
  //       {
  //         isBlock:$("#inputStatus").val(),
  //         nameTypeBaiViet:$("#nameFood").val(),
  //       };
  //       $.ajax({
  //         type: "POST",
  //         url: "./js/CreateC.php",
  //         data: dataCreate,
  //         success: function(response) {
  //             if(response==1)
  //             {
  //               alert("Thêm thành công");
  //               window.location.href="index.php"; 
  //             }else if(response==2){
  //               alert("Thêm thất bại");
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