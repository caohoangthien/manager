<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! asset('images/user2-160x160.jpg') !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header text-center"><b>DANH MỤC QUẢN LÝ</b></li>
            <li><a href="{!! route('nhan-vien.index') !!}"><i class="fa fa-users text-aqua"></i> <span>Nhân viên</span></a></li>
            <li><a href="{!! route('cham-cong.show') !!}"><i class="fa fa-calendar text-aqua"></i> <span>Chấm công</span></a></li>
            <li><a href="{!! route('luong-nhan-vien.show') !!}"><i class="fa fa-calculator text-aqua"></i> <span>Lương</span></a></li>
            <li><a href="{!! route('luong-nhan-vien.show') !!}"><i class="fa fa-money text-aqua"></i> <span>Thu chi</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart text-aqua"></i>
                    <span>Thống kê</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Doanh thu theo tháng</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Doanh thu theo ngày</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>