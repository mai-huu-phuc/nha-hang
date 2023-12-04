<?php
  include "ShareView/header.php";

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
                <h3 class="card-title">Đăng ký tài khoản</h3>
              </div>
              <div class="card-body" style="display: block;">
                <div class="form-group">
                  <label >Tên</label>
                  <input type="text" id="nameU" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label >UserName</label>
                  <input type="text" id="UserName" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="Password" id="Password" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label >Email</label>
                  <input type="Email" id="Email" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label >Phone</label>
                  <input type="number" id="Phone" name="" class="form-control">
                </div>
                 <div class="form-group">
                  <label >Address</label>
                  <input type="text" id="Address" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label >Age</label>
                  <input type="number" id="AgeU" name="" class="form-control">
                </div>
                <div class="form-group">
                  <label >CCCD</label>
                  <input type="number" id="CCCD" name="" class="form-control">
                </div>
                <div class="col-md-12">
                  <a class="btn btn-success" id="createType"> Đăng ký</a>
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
      if($("#nameU").val()!=""){
        let dataCreate=
        {
          name:$("#nameU").val(),
          UserName:$("#UserName").val(),
          Password:$("#Password").val(),
          Phone:$("#Phone").val(),
          Email:$("#Email").val(),
          Age:$("#AgeU").val(),
          Address:$("#Address").val(),
          CCCD:$("#CCCD").val(),
        };
        $.ajax({
          type: "POST",
          url: "./js/AddUser.php",
          data: dataCreate,
          success: function(response) {
            console.log(response);
              if(response==1)
              {
                alert("đăng ký thành công");
                window.location.href="login.php"; 
              }else if(response==2){
                alert("Thêm thất bại");
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