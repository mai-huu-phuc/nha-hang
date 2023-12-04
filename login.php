<?php
  include "ShareView/header.php";
  
  if(isset($_SESSION['logged_in'])){
    echo '<script> window.location.href="index.php"</script>';
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userName =mysqli_real_escape_string($connectMySql,$_POST['userName']);
    $password =mysqli_real_escape_string($connectMySql,$_POST['password']); 
    if($userName==""||$password=="")
    {	  
      echo '<script > alert("Thêm không thành công");</script>';
    }else 
    {
      $query_get_id = "SELECT `name`, `Per_id`,id,userName,id FROM `account` Where userName='".  $userName."' and password='".$password."' limit 1";

      $select_result = $connectMySql->query($query_get_id);
  
      if ($select_result->num_rows > 0) {
          while($row = $select_result->fetch_assoc())
          {
              $_SESSION['logged_in']=true;
              $_SESSION['Per_id']=$row['Per_id'];
              $_SESSION['name']=$row['name'];
              $_SESSION['id']=$row['id'];
              $_SESSION['userName']=$row['userName'];
          }  
          echo '<script> window.location.href="index.php"</script>';

      }else{
        echo '<script> alert("Đăng nhập đúng");</script>';
      }
    }
  }
  

?>


</div>

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
  
       <div class="login-box" style="display:block;margin:auto;">
  <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                <div><center> <img src="images/logo.png" style="width:100px;height:100px;"></center></div>
           
                <form action="login.php" method="post">
                  <div class="input-group mb-3">
                    <input type="text"name="userName" class="form-control" placeholder="Tài khoản">
                    <!-- <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div> -->
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                    <!-- <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                          Nhớ tài khoản
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

             
                <!-- /.social-auth-links -->
                <p class="mb-0">
                  <a href="Create.php" class="text-center">Đăng Ký tài khoản</a>
                </p>
              </div>
              <!-- /.login-card-body -->
           
            </div>
          </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- footer section -->
<?php 
    include "ShareView/footer.php";

?>