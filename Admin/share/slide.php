<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $base_url; ?>" class="brand-link">
      <img src="<?php echo $base_url.'/images/logo.png'; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Hải sản MH Phúc</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- SidebarSearch Form -->
     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyTypeFood/'; ?>" class="nav-link ">
            <i class="fa fa-anchor" style="font-size:24px"></i>
              <p>
                Quản lý loại hải sản
   
              </p>
            </a>
          </li>
          
          <li class="nav-item ">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyNguoiDung/'; ?>" class="nav-link ">
            <i class="fa fa-address-book" style="font-size:24px"></i>
              <p>
                Quản lý người dùng
       
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyBaiViet/'; ?>" class="nav-link ">
            <i class="fa fa-comment" style="font-size:24px"></i>
              <p>
                Quản lý bài viết

              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyTypeBV/'; ?>" class="nav-link ">
            <i class="fa fa-comments" style="font-size:24px"></i>
              <p>
                Quản lý kiểu bài viết

              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyFood/'; ?>" class="nav-link ">
            <i class="fa fa-bath" style="font-size:24px"></i>
              <p>
                Quản lý món ăn

              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyBanDat/'; ?>" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Quản lý đặt bàn

              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyHoaDon/'; ?>" class="nav-link ">
            <i class="fa fa-mobile" style="font-size:24px"></i>
              <p>
                Quản lý Hóa đơn
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyPermission/'; ?>" class="nav-link ">
            <i class="fa fa-address-book" style="font-size:24px"></i>
              <p>
                Quản lý Quyền 
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo $base_url.'/Admin/View/QuanLyBanAn/'; ?>" class="nav-link ">
            <i class="fa fa-archive" style="font-size:24px"></i>
              <p>
                Quản lý Bàn ăn

              </p>
            </a>
          </li>
          <!-- <li class="nav-header">EXAMPLES</li>
          <li class="nav-item"> -->
            <!-- <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a> -->
          <!-- </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>