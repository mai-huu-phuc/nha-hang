<?php
  include "ShareView/header.php";
  $resultAccount=array();
  if(!isset($_SESSION['logged_in'])){
    echo '<script> window.location.href="login.php"</script>';
  }else{

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
                  <label >Mật khẩu cũ </label>
                  <input type="Password" id="passwordOld" name=""  class="form-control">
                  <input type="hidden" id="idAccount" value="<?php echo $_SESSION['id']; ?>">
                </div>
                <div class="form-group">
                  <label >Mật khẩu mới</label>
                  <input type="Password" id="password" name="" value="" class="form-control">
                </div>
                <div class="form-group">
                  <label>Nhập lại mật khẩu mới</label>
                  <input type="Password" id="passwordAgain" name="" value="" class="form-control">
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
    </section>

 <script type="text/javascript">
  $("#createType").click(()=>{
    if(confirm("Bạn có chắc muốn thêm không"))
    {
      if($("#passwordOld").val()!=""&&($("#passwordAgain").val()==$("#password").val())){
        let dataCreate=
        {
            idAccount:$("#idAccount").val(),
            passwordOld:$("#passwordOld").val(),
            passwordAgain:$("#passwordAgain").val(),
            password:$("#password").val(),
        
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


 </script>
  <!-- end about section -->

  <!-- footer section -->
<?php 
    include "ShareView/footer.php";

?>