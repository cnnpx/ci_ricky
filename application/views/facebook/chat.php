
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="Access-Control-Allow-Origin" content="http://127.0.0.1:5000/eventsource">
    
    <header name = "Access-Control-Allow-Origin" value = "http://127.0.0.1:5000/eventsource" />
	
    <title>Page</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css"/>
    <!--    <link rel="stylesheet" href="assets/vendor/plugins/pnotify/pnotify.custom.css"/>-->
    <link rel="stylesheet" href="assets/vendor/plugins/select2/select2.min.css"/>
    <link rel="stylesheet" href="assets/vendor/plugins/iCheck/all.css">
    <link rel="stylesheet" href="assets/vendor/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/vendor/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="assets/vendor/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="assets/vendor/dist/css/style.css">
    <link rel="stylesheet" href="assets/facebookresource/css.css">
	<link rel="stylesheet" href="assets/facebookresource/alertify.min.css"/>
   
   <script type ="text/javascript" src="assets/facebookresource/alertify.min.js"></script>

   
</head>


<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <a href="http://localhost/freelancer/ricky/" class="logo">
            <span class="logo-mini"><b>R</b>KY</span>
            <span class="logo-lg"><b>Ricky</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                    </li>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                    </li>
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/uploads/users/no-image.jpg" alt="Ricky" class="user-image">
                            <span class="hidden-xs">Ricky</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="assets/uploads/users/no-image.jpg" alt="Ricky" class="img-circle">
                                <p>
                                    Ricky </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="http://localhost/freelancer/ricky/user/profile"
                                       class="btn btn-default btn-flat">Trang cá nhân</a>
                                </div>
                                <div class="pull-right">
                                    <a href="http://localhost/freelancer/ricky/user/logout"
                                       class="btn btn-default btn-flat">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-shopping-cart"></i> <span>Quản lý bán hàng</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Đơn hàng</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Tạo đơn mới</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Bảo hành                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Tổng
                                        quan</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Xử lý
                                        bảo hành</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Đổi trả                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Tổng
                                        quan</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Xử lý
                                        đổi trả</a></li>
                            </ul>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Mã khuyến
                                mại</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-car"></i> <span>Quản lý vận chuyển</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Giao hàng</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-car"></i> Tổng quan</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Cập nhật mã đơn
                                vận</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Cập nhật phí
                                ship</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Thêm thông tin
                                nhà vận chuyển</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-male"></i> <span>Quản lý khách hàng</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Thông tin khách hàng                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Nhóm
                                        khách hàng</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Danh
                                        sách khách hàng</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Chăm sóc khách hàng                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Khách
                                        hàng vừa nhận hàng</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Khách
                                        hàng xử lý bảo hành</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Khách
                                        hàng khiếu nại/Không hài lòng</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Chăm sóc
                                        định kì</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Tư vấn lại                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Khách
                                        chờ hàng về</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Khách
                                        đặt lịch mua</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Khách có
                                        nhu cầu</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Đơn hàng
                                        dang dở</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-product-hunt"></i> <span>Quản lý hàng hóa</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Sản phẩm                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Danh
                                        sách sản phẩm</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Thêm mới
                                        sản phẩm</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Nhóm sản
                                        phẩm</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i>
                                Kho                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Nhập kho</a>
                                </li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Xuất kho</a>
                                </li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Tồn kho</a>
                                </li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Lưu
                                        chuyển kho</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Quản lý nhập hàng                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Hàng
                                        đang đặt</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Nhà cung cấp                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Danh
                                        sách nhà cung cấp</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Thêm mới</a>
                                </li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Công nợ</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-money"></i> <span>Tài chính</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Tổng quan</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Quản lý sổ quỹ                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Quản lý
                                        hóa đơn</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Quản lý công nợ                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Công nợ
                                        nhà cung cấp</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Công nợ
                                        khách hàng</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Công nợ
                                        khách buôn</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Công nợ
                                        CTV</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Công nợ
                                        VC</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Công nợ
                                        bưu điện</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-wikipedia-w"></i> <span>Web</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Quản lý comment
                                trên web</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Giao diện</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Menu</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-facebook"></i> <span>Quản lý page</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Comment và inbox</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Cấu hình</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Tổng quan</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-file-excel-o"></i> <span>Báo cáo</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Báo cáo bán hàng</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Báo cáo hàng hóa</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Báo cáo nhân
                                viên</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Báo cáo tài
                                chính</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Báo cáo hóa
                                đơn-chứng từ</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-users"></i> <span>Làm việc chung</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Chấm công</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Đăng ký lịch</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Nhiệm vụ</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Thưởng/Phạt</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Lương thưởng</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-wrench"></i> <span>Xử lý kỹ thuật</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Tư vấn KH</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Xử lý bảo
                                hành</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-file-text-o"></i> <span>Quản lý bài viết</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Bài viết up web</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Bài viết up
                                facebook</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Bài viết Review</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-cog"></i> <span>Quản lý cấu hình</span>
                        <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Tài khoản nhân
                                viên</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Phân nhóm quyền</a>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Quản lý file
                                trên host</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Thêm cơ sở</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Cài đặt bản in                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Mẫu in
                                        đơn bán hàng</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Mẫu
                                        phiếu xuất kho</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Mẫu
                                        phiếu nhập kho</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Nhà cung cấp                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Danh
                                        sách nhà cung cấp</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Thêm mới</a>
                                </li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Công nợ</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fa fa-circle-o"></i> Cấu hình lương/Thưởng                                                    <span
                                        class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Cấu hình
                                        lương</a></li>
                                <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Cấu hình
                                        thưởng</a></li>
                            </ul>
                        </li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Cấu hình vận
                                chuyển</a></li>
                        <li><a href="http://localhost/freelancer/ricky/"><i class="fa fa-circle-o"></i> Cấu hình thanh
                                toán</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div id="content" class="main-content">
                <div class="outer">
                    <div class="inner" id="viewareaid">
                        <div>
                            <div id="fb-chat" class="wrapper-content fb-chat">
                                <div class="fb-chat-conversation border-top">
                                    <div class="tool-left-harapage">
                                        <ul>
                                            <li class="active">
                                                <a class="cursor-pointer" data-placement="right" title="" data-original-title="RICKY - Thiết bị studio chính hãng">
                                                    <img src="assets/facebookresource/picture">
                                                </a>
                                            </li>
                                            <li class="addmoretab">
                                                <a class="cursor-pointer" data-toggle="modal" data-target=".add-more-tab">
                                                    <i class="fa fa-plus fa-2x"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fb-chat-conversation-container">
                                        <div class="border-right fb-chat-list clearfix">
                                            <div class="fb-wrap-col-bar-col-search">
                                                <div class="col-md-12 fb-chat-action-bar border-bottom">
                                                    <div class="fb-chat-menu">
                                                        <div class="menu-icon active" data-toggle="tooltip" data-placement="bottom" data-original="#list-conversation">
                                                            <i class="fa fa-inbox fa-2x"></i>
                                                        </div>
                                                        <div class="menu-icon" id="data-messenger" data-toggle="tooltip" data-placement="bottom" data-original="#inbox-message">
                                                            <i  class="fa fa-envelope-o fa-2x"></i>
                                                        </div>
                                                        <div class="menu-icon" data-toggle="tooltip" data-placement="bottom" data-original="#comment-message">
                                                            <i class="fa fa-comment-o fa-2x"></i>
                                                        </div>
                                                        <div class="menu-icon" data-toggle="tooltip" data-placement="bottom" data-original="#unread">
                                                            <i class="fa fa-eye-slash fa-2x"></i>
                                                        </div>
                                                        <div class="menu-icon drop-control dropdown">
                                                            <span class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                                <i class="fa fa-bars fa-2x"></i>
                                                            </span>
                                                            <div class="facebook tag-menu dropdown-menu dropdown-ps-left" role="menu">
                                                                <div class="drop-control">
                                                                    <div class="menu-icon clearfix border-bottom mb15">
                                                                        <div class="item">
                                                                            <i class="fa fa-eye fa-1-5"></i>
                                                                            <span>Đã đọc tất cả</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="menu-icon clearfix">
                                                                        <div class="item tag-color-1">
                                                                            <i class="fa fa-tag fa-1-5"></i>
                                                                            <span data-bind="text: Name">BAO-HANH</span>
                                                                        </div>
                                                                        <a data-bind="click: $parent.RemoveTag" class="remove-tag pull-right" data-toggle="tooltip" data-placement="bottom"
                                                                           data-original-title="Xóa nhãn">
                                                                            <i class="fa fa-times fa-1 note"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-icon clearfix">
                                                                        <div class="item tag-color-23">
                                                                            <i class="fa fa-tag fa-1-5"></i>
                                                                            <span data-bind="text: Name">ĐÃ ĐẶT CỌC</span>
                                                                        </div>
                                                                        <a class="remove-tag pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="Xóa nhãn">
                                                                            <i class="fa fa-times fa-1 note"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-icon clearfix">
                                                                        <div class="item tag-color-24">
                                                                            <i class="fa fa-tag fa-1-5"></i>
                                                                            <span data-bind="text: Name">ĐỢI K10 VỀ GỌI CHO KHÁCH</span>
                                                                        </div>
                                                                        <a class="remove-tag pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="Xóa nhãn">
                                                                            <i class="fa fa-times fa-1 note"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 search-conversation border-bottom">
                                                    <div class="">
                                                        <input placeholder="Tìm kiếm" type="text" class="form-control form-large txtSearch">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 conversation scroll-conversation event-scroll-visible" style="overflow: auto; max-height: 99vh; height: 98%">
                                                <ul id="list-conversation" class="all-message tab-content">
                                                </ul>
                                                <ul id="inbox-message" class="inbox-message tab-content">
                                                </ul>
                                                <ul id="comment-message" class="comment-message tab-content">



                                                </ul>
                                                <ul id="unread" class="unread tab-content">


                                                </ul>
                                            </div>
                                        </div>
                                        <div class="fb-conversation-message ps-relative">
                                            <div class="inline_block border-right chat-box">
                                                <div class="conversation-message-info border-bottom ws-nm" title="Lưu Văn Nhất">
                                                    <i class="btn fa fa-arrow-circle-left backlistchat comebacklistchat" style="display: none;"></i>
                                                    <span class="name" id ="currName"> </span>
                                                </div>
                                                <div class="conversation-tags border-bottom">
                                                    <a id="ga_harapage_11" class="btn btn-default btn-xs">
                                                        <i class="fa fa-tags"></i>
                                                        Chỉnh sửa nhãn
                                                    </a>
                                                </div>
                                                <div class="list-message" style="display: none">
                                                    <div class="list-message-fix-height">
                                                        <div  class="list-message-container" style="overflow-y: scroll; max-height: 99vh;">
                                                            <ul id = "conversation-message-picture">
                                                                <li  class="conversation-message-picture hidden">
                                                                    <p class="text-no-bold"></p>
                                                                </li>
                                                                <li class="is-from-page">
                                                                    <div>
                                                                        <p class="message">
                                                                            <span></span>
                                                                        </p>
                                                                    </div>

                                                                </li>

                                                            </ul>
                                                        </div>
                                                        <div id="list-message" class="list-message-container"  style="display:none">

                                                        </div>
                                                    </div>
                                                    <div class="message-reply border-top clearfix">
                                                        <div class="textarea-reply">
                                                            <textarea id="textarea-auto-height-harapage" style="height: 58px; max-height: 300px; width: 100%;" class="form-control" placeholder="Nhập câu trả lời">		</textarea>
															
														</div>
                                                        <div class="reply-attachment-form">
                                                            <div class="item">
                                                                <div>
																	<div class = "fa fa-smile-o"></div> 
                                                                    <div class="p-none-important btn-group drop-select-search drop-control dropup" style="position: relative;">
                                                                        <div id="ga_harapage_6" data-toggle="dropdown" role="button">
                                                                            <i class="fa fa-product"></i>
                                                                            <p data-bind="t   <p>Kho hình ảnh</p>ext: SelectedText">Tìm sản phẩm</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div id="ga_harapage_7" data-bind="click: ClickOpenAddImageModal">
                                                      <i class="fa fa-camera"></i>
                                                                </div>
                                                            </div>
                                                            <div class="item" style="position: relative;">
                                                                <div id="ga_harapage_15" style="position: relative; z-index: 1;">
                                                                    <i class="fa fa-upload"></i>
                                                                    <p>Tải hình mới</p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="dropup drop-control" style="position: relative;" id="SampleMessageDropDown">
                                                                    <div data-toggle="dropdown" id="dropdownMenu1">
                                                                        <div id="">
                                                                            <i class="fa fa-list-alt"></i>
                                                                            <p>Tin nhắn mẫu</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="action-group-reply">
                                                            <div class="reply-attachment">
                                                                <i class="fa fa-paperclip"></i>
                                                                <span>Đính kèm</span>
                                                            </div>
                                                            <input type = "hidden" id = "message-type">
                                                            <a class="btn btn-primary" id ="send-button">Gửi</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inline_block participant-info-container overflow-auto">
                                                <div class="participant-info-customer ws-nm text-left">
                                                    <div class="participant-info-customer-detail">
                                                        <div class="mb10 clearfix">
                                                            <a class="pull-right text-no-bold">Cập nhật thông tin</a>
                                                        </div>
                                                        <div class="clearfix" id ="customer-info">
                                                            <div class="col-md-3 col-xs-12 p-none pull-left">
                                                                <div class="participant-avatar-customer text-center">
                                                                    <img class="img-max-width-100"  id ="selected-user-avatar"/>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-9 col-xs-12 p-l10 p-r10 pull-left" id = "customer-info-detail">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearboth"></div>
                                                    <div class="participant-info-customer-tags overflow-auto border-top">
                                                        <div class="clearfix">
                                                            <a class="pull-right text-no-bold" data-bind="click:ClickOpenEditTags">Chỉnh sửa nhãn</a>
                                                        </div>
                                                        <div class="clearfix mt5">
                                                            <div class="tags ws-nm">
                                                                <p class="text-center text-no-bold ws-nm mb0">
                                                                    Chưa có nhãn nào
                                                                </p>

                                                                <p class="text-center ws-nm mb0 note">
                                                                    Việc thêm nhãn giúp bạn phân loại hỗ trợ chăm sóc khách hàng
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="participant-info-customer-comment overflow-auto border-top">
                                                        <div class="comment-log-small">
                                                            <div class="comment-log-small-header clearfix">
                                                                <a class="pull-right text-no-bold">
                                                                    Thêm ghi chú
                                                                </a>
                                                            </div>
                                                            <div class="comment-log-small-body clearfix mt5">
<!--                                                                <ul>-->
<!--                                                                    <li class="comment-log-small-comment-item">-->
<!--                                                                        <span class="text-no-bold">CẢNH LEE</span>-->
<!--                                                                        <span> - </span>-->
<!--                                                                        <span class="comment-log-small-comment-item-comment" >COMBO AT250-KS108</span>-->
<!---->
<!--                                                                        <div class="comment-log-small-comment-info">-->
<!--                                                                            <span class="time note">Hôm qua 11:19 SA</span>-->
<!--                                                                            <span> - </span>-->
<!--                                                                            <a>Xóa</a>-->
<!--                                                                        </div>-->
<!--                                                                    </li>-->
<!---->
<!--                                                                    <li class="comment-log-small-comment-item">-->
<!--                                                                        <span data-bind="text: LogUserFullname" class="text-no-bold">CẢNH LEE</span>-->
<!--                                                                        <span> - </span>-->
<!--                                                                        <span class="comment-log-small-comment-item-comment">Tham khảo KS108</span>-->
<!---->
<!--                                                                        <div class="comment-log-small-comment-info">-->
<!--                                                                            <span class="time note">Hôm qua 8:48 SA</span>-->
<!--                                                                            <span> - </span>-->
<!--                                                                            <a>Xóa</a>-->
<!--                                                                        </div>-->
<!--                                                                    </li>-->
<!---->
<!--                                                                    <li class="comment-log-small-comment-item">-->
<!--                                                                        <span class="text-no-bold">Ngô Vân-CSKH</span>-->
<!--                                                                        <span> - </span>-->
<!--                                                                        <span class="comment-log-small-comment-item-comment">ship 80k</span>-->
<!---->
<!--                                                                        <div class="comment-log-small-comment-info">-->
<!--                                                                            <span class="time note">20/08/2017 4:27 CH</span>-->
<!--                                                                            <span> - </span>-->
<!--                                                                            <a>Xóa</a>-->
<!--                                                                        </div>-->
<!--                                                                    </li>-->
<!--                                                                </ul>-->
                                                                <div class="text-center mb5">
                                                                    <a><i class="fa fa-arrow-circle-down mr5"></i>Xem thêm</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-message-info border-bottom ws-nm">
                                                    <i class="btn fa fa-arrow-circle-left backlistchat backlistmessage hidden-lg hidden-md hidden-sm"></i>
                                                    <a class="btn" href="#" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="Xem trên Facebook">
                                                        <i class="fa fa-external-link"></i>

                                                                                                <div class="participant-customer-orders ws-nm text-left">
                                                                                                    <div class="clearfix mb10 participant-customer-orders-header ps-relative">
                                                                                                        <span class="pull-left text-no-bold">Đơn hàng <a href="#" target="_blank"><i class="fa fa-question-circle"></i></a></span>
                                                                                                        <a class="pull-right text-no-bold" href="#" target="_blank">Xem tất cả</a>
                                                                                                    </div>
                                                                                                    <div class="clearfix participant-customer-orders-data">
                                                                                                        <ul class="pl15 p-r15">
                                                                                                            <li class="mt5 mb5 clearfix">
                                                                                                                <div class="flexbox-grid-default">
                                                                                                                    <div class="flexbox-auto-70">
                                                                                                                        <div class="wrap-img" style="vertical-align:middle;">
                                                                                                                            <img class="img-max-width-100" />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="flexbox-auto-right">
                                                                                                                        <a href="#" target="_blank">RB-104076</a>
                                                                                                                        <p title="Sound card XOX KS108 ">
                                                                                                                            <span class="overflow-ellipsis-2-row" style="width:calc(100% - 60px);height:35px;">Sound card XOX KS108</span>
                                                                                                                            <span class="overflow-ellipsis"></span>
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .inner -->
                </div>
                <!-- end .outer -->
            </div>
            <div class="clear"></div>
        </div>
        <input id = "private-id-message" type = "hidden">
        <!-- /#wrap -->
    </div>
	
	
	<!--
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017 <a href="http://hoanmuada.com">Hoàn Mưa Đá Team</a>.</strong> All rights reserved.
        - <strong>Email: <a id="aSysEmail" href="mailto:ricky@gmail.com">ricky@gmail.com</a></strong>.
    </footer>
	-->
</div>


<!--reply dialog-->



<div class="modal fade" id="dialog-reply" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Gửi tin nhắn</h4>
        </div>
        <div class="modal-body" style =" max-height: fit-content;">
			<input type = "hidden" id = "comment-id-private-message">
			<input type = "text"  style="height: 58px; max-height: 300px; width: 100%;" class="form-control"  row = "4" id = "quick-private-reply-box" placeholder ="Nhập tin nhắn riêng"> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
		  <button type="button" class="btn btn-default" onclick = "sendMessagePrivately()">Gửi tin nhắn</button>
        </div>
      </div>
      
    </div>
</div>




<div class="modal fade" id="dialog-comment" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Trả lời</h4>
        </div>
        <div class="modal-body" style =" max-height: fit-content;">
			<input type = "hidden" id = "comment-id-quick-reply">
			<input type = "text"  style="height: 58px; max-height: 300px; width: 100%;" class="form-control"  id = "quick-reply-box" row = "4" placeholder ="Nhập câu trả lời"> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
		  <button type="button" class="btn btn-default" onclick = "sendQuickReply()">Gửi bình luận</button>
        </div>
      </div>
      
    </div>
</div>


<!-- end reply dialog -->


<script src="assets/js/moment.min.js"></script>
<?php $this->load->view('includes/footer'); ?>
<!--<script src="assets/js/chat.js"></script>-->
<script>

</script>
<script type="text/javascript">

    var pageAccessToken='';
    var userToken = "";
    var pageId = '<?php echo $pageId?>';
	var userLogin = "";
	var ws;
	
	
	
    var access_token = '<?php echo $appToken?>';
    
	var userId = '';
    
	//init data
    $(document).ready(function() {
        $.ajaxSetup({ cache: true });
		initWebsocket();
		
        $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
            FB.init({
                appId: '2020899998139436',
                version: 'v2.10'
            });
            $('#list-conversation').html('');
            var listConversationHtml="";
            getAccessToken();
            FB.api(
                '/'+pageId+'/feed',
                'GET',
                {access_token: access_token,
                    fields:'message,id,object_id,created_time,call_to_action,status_type,type,from{id,picture,name},comments{from,created_time,message}'
                },
                function(response) {
                    console.log(response);
                    var listFeed = response;
                    for(var i = 0; i< listFeed.data.length;i++){
                            listConversationHtml+= '<li class="border-bottom is-unreaded"  onclick = "displayBox(\''+listFeed.data[i].id+'\')">'+
                                '<div class="conversation-icon">'+
                                '<img src="'+listFeed.data[i].from.picture.data.url+'">'+
                                '</div>'+
                                '<div class="conversation-content">'+
                                '<p class="text-no-bold conversation-snippet">'+listFeed.data[i].from.name+'</p>'+
                                '<div class="conversation-snippet">'+
                                '<span>'+listFeed.data[i].message+'</span>'+
                                '</div>'+
                                '</div>'+
                                '<div class="conversation-info">'+
                                '<div>'+
                                '<i class="fa fa-clock-o"></i>'+
                                '<span>'+listFeed.data[i].created_time+'</span>'+
                                '</div>'+
                                '<div class="user-in-obj">'+
                                '<ul class="letter-avatar"></ul>'+
                                '</div>'+
                                '<div>'+
                                '<i class="type-icon fa fa-envelope-o fa-1-5"></i>'+
                                '</div>'+
                                '<div>'+
                                '<a class="read-status inline_block_i is-unreaded"></a>'+
                                '</div>'+
                                '</div>'+
                                '</li>';
                    }
                    $('#list-conversation').html(listConversationHtml);
                }
            );
        });

        $('.fb-chat-list .conversation .tab-content:not(:first-child)').hide();
        var window_height = $(window).height();
        $("#fb-chat").css('min-height', window_height - $('.main-footer').outerHeight());
        $('.fb-chat-menu .menu-icon').click(function(){
            $('.fb-chat-menu .menu-icon').removeClass('active');
            $(this).addClass('active');
            var _id = $(this).attr('data-original');
            $(this).parents('.fb-chat-list').find('.tab-content').hide();
            $(_id).show();
        });

    });


    function displayBox(id){
        FB.api(
            '/'+id,
            'GET',
            {access_token: access_token,
                fields:'message,id,object_id,created_time,call_to_action,status_type,type,from{id,picture,name},comments'
            },
            function(response) {
                console.log(response);
                $('#currName').html(response.from.name);
                $('#selected-user-avatar').attr('src', response.from.picture.data.url)
                $('#message-type').val(response.status_type)
                $('#customer-info-detail').html('');
                var detailCustommer= '';
                var location = response.from.location ==undefined ? 'Chưa cập nhật thông tin' :response.from.location;
                var phoneNo =response.from.phone==undefined ? 'Chưa cập nhật thông tin' :response.from.phone;
                detailCustommer= '<ul class="participant-info-detail-customer"><li class="overflow-ellipsis"><i class="fa fa-user mr5"></i>'+
                    '<a href="https://facebook.com/'+response.from.id+'" target="_blank">'+response.from.name+'</a></li><li class="overflow-ellipsis"><i class="fa fa-envelope mr5"></i><span>'+response.from.id+'@facebook.com</span></li>'+
                    '<li class="overflow-ellipsis"><i class="fa fa-phone-square mr5"></i>'+
                    '<span>'+phoneNo+'</span></li>'+
                    '<li class="overflow' +
                    '-ellipsis"><i class="fa fa-home mr5"></i>'+
                    '<span>'+location+'</span></li></ul>';

                $('#customer-info-detail').html(detailCustommer);

                $('#customer-info-detail').show();

                if (response.type=='status'){
                    $('#private-id-message').val(id);
                    var listComment = '';
					
					if(response.comments){
						for(comment of response.comments.data){
							listComment+= '<li>' +
                        '<div>' +
                        '<div>'+comment.from.name+'</div>' +
						'<p class="message">' +
                        '<span>'+comment.message+'</span>' +
						'<div><span><button title="Thích" style = "border:none" class = "fa fa-thumbs-o-up" onclick="reactionComment(\''+comment.id +'\')"  ></button><button title="Ẩn comment" style = "border:none" class = "fa fa-eye-slash" onclick="hideComment(\''+comment.id +'\')"  ></button><button  title="Gửi tin nhắn nhanh" data-toggle="modal" data-target="#dialog-reply" style = "border:none" class = "fa fa-commenting-o" onclick="sendPrivateReply(\''+comment.id +'\')"  ></button><button  title="Trả lời" data-toggle="modal" data-target="#dialog-comment" style = "border:none" class = "fa fa-commenting-o" onclick="createTextboxQuickReply(\''+comment.id +'\')"  ></button><a title="Xem trên facebook" class = "fa fa-facebook-square"  href="https://facebook.com/'+comment.id+'" target ="_blank"></a></span></div>' +
                        '</p>' +
                        '</div></li>';
						}
					}
					var htmlMessage = 
                        '<div style= "background: cornsilk, padding-bottom: 30px;"> ' +
                        '<p>' +
                        '<span>'+response.message+'</span>' +
                        '</p>' +
                        '</div>';
                    $('#conversation-message-picture').html(htmlMessage +listComment);
                    $('.list-message').show();
                }
            }
        );
    }

    //action send post data to api
    $('#send-button').click(function(){
		 var id = $('#private-id-message').val();
		 var datapost = $('#textarea-auto-height-harapage').val();
        if(datapost== null || datapost == undefined || datapost.trim()==''){
            return;
        }else{
            //check type reply
            if( $('#message-type').val()=='message'){
            // reply a comment, post comment for activity
                sendMessage(datapost);
            }else{
            // reply a message, post private message to user
                replyACommnent(id,datapost);
            }

            //clear input text
            $('#textarea-auto-height-harapage').val('');
        }

    });


    function sendMessage(message){
        var id = $('#private-id-message').val();
        console.log(id);
		FB.api(
            "/"+id+"/messages",
            "POST",
            {message: message,
                access_token: pageAccessToken},
            function (response) {
                console.log(response);
				bindConversationData(id);
                if (response && !response.error) {
                    console.log(response);
					bindConversationData(id);
                }else{

				}
            }
        );
		
    }

	function replyACommnent(idComment,messageReply){
	   
		FB.api(
			"/"+idComment+"/comments",
			"POST",
			{
				message: messageReply,
				access_token: pageAccessToken
			},
			function (response) {
				console.log(response);
				if (response && !response.error) {
				  alertify.success('Đã trả lời bình luận này');
				}else{
					//gui tin nhan ko thnah cong
				  alertify.error('Trả lời gửi không thành công.');

				}
			}
		);
	}
	
	//Get access_token
        function getAccessToken(){
           if( FB.getAccessToken() ==null||FB.getAccessToken() ==undefined || FB.getAccessToken().trim() == '' ){
               FB.login(function(response){
                   //console.log(response);
                   userToken  = FB.getAccessToken();
                   userId = FB.getUserID();
				   FB.api('/me?access_token='+userToken+'&fields=name,picture,id',function(responseResult){
					   if(!responseResult.error){
					   userLogin=responseResult;
					   }
					   });
				   
                   FB.api(
                       '/'+pageId,
                       'GET',
                       {'fields':'access_token',
                           'access_token': userToken},
                       function(response) {
                          // console.log(response);
                           if(!response.error){
						   pageAccessToken = response.access_token;
						   }
                       }
                   );
               });
           }

        }



    $('#data-messenger').click(function(){
        getListMessage();
    });


        function getListMessage(){
            var dataJson = {};
            FB.api(
                pageId+'?fields=conversations{id,snippet,updated_time,senders}',
                'GET',
                {'access_token': pageAccessToken
                    },
                function(response) {
                 if(!response.error){
                     dataJson = response;
                     bindMessageData(dataJson);
                 }else{
                     dataJson = {error: 'Không lấy được danh sách tin nhắn'};
                 }
                }
            );
        }

        function  bindMessageData(data){
            console.log(data);
            var listConversationHtml='';
            $('#inbox-message').html(listConversationHtml);

            var listFeed = data;
            for(var i = 0; i< listFeed.conversations.data.length;i++){
                listConversationHtml+= '<li id = "'+listFeed.conversations.data[i].id+'"  class="border-bottom is-unreaded"  onclick = "displayConversation(\''+listFeed.conversations.data[i].id+'\',\''+listFeed.conversations.data[i].senders.data[0].name +'\',\'' +listFeed.conversations.data[i].senders.data[0].id+'\')">'+
                    '<div class="conversation-icon">'+
                    '<img src="https://graph.facebook.com/' +listFeed.conversations.data[i].senders.data[0].id+ '/picture?type=square">'+
                    '</div>'+
                    '<div class="conversation-content">'+
                    '<p class="text-no-bold conversation-snippet">'+listFeed.conversations.data[i].senders.data[0].name+'</p>'+
                    '<div class="conversation-snippet">'+
                    '<span>'+listFeed.conversations.data[i].snippet+'</span>'+
                    '</div>'+
                    '</div>'+
                    '<div class="conversation-info">'+
                    '<div>'+
                    '<i class="fa fa-clock-o"></i>'+
                    '<span>'+listFeed.conversations.data[i].updated_time+'</span>'+
                    '</div>'+
                    '<div class="user-in-obj">'+
                    '<ul class="letter-avatar"></ul>'+
                    '</div>'+
                    '<div>'+
                    '<i class="type-icon fa fa-envelope-o fa-1-5"></i>'+
                    '</div>'+
                    '<div>'+
                    '<a class="read-status inline_block_i is-unreaded"></a>'+
                    '</div>'+
                    '</div>'+
                    '</li>';
            }
            $('#inbox-message').html(listConversationHtml);
        }



        function displayConversation(idConversation,name,id){
            //fill data of client
            $('#customer-info-detail').html('');
            var detailCustommer= '';

            $('#selected-user-avatar').attr('src', "https://graph.facebook.com/"+id+ "/picture?type=square");
            detailCustommer= '<ul class="participant-info-detail-customer"><li class="overflow-ellipsis"><i class="fa fa-user mr5"></i>'+
                '<a href="https://facebook.com/'+id+'" target="_blank">'+name+'</a></li><li class="overflow-ellipsis"><i class="fa fa-envelope mr5"></i><span>'+id+'@facebook.com</span></li>'+
                '<li class="overflow-ellipsis"><i class="fa fa-phone-square mr5"></i>'+
                '<span> </span></li>'+
                '<li class="overflow-ellipsis"><i class="fa fa-home mr5"></i>'+
                '<span> </span></li></ul>';

            $('#customer-info-detail').html(detailCustommer);
            $('#customer-info-detail').show();
            bindConversationData(idConversation);
        }
	

        //bind list message
        function  bindConversationData(idConversation){
            var dataJson = {};
            FB.api(
                '/'+idConversation + '/messages?fields=senders,created_time,from,to,message',
                'GET',
                {'access_token': pageAccessToken
                },
                function(response) {
                    console.log(response);
                    if(!response.error){
                        dataJson = response;
                        var response = dataJson;
                        var htmlMessage ='';
                        for(var i = response.data.length-1; i >=0 ; i--){
                            if(response.data[i].from.id== userId){
                                htmlMessage += '<li class="is-from-page">' +
                                    '<div>' +
                                    '<p class="message">' +
                                    '<span>'+response.data[i].message+'</span>' +
                                    '</p>' +
                                    '</div>' +
                                    '<span class="time note" data-bind="timeshort: LastUpdatedDate">'+moment(new Date(response.data[i].created_time)).format('DD/MM h:mm: A')+'</span>' +
                                    '<br><span class="note">Được gửi bởi <b data-bind="text: UserName">'+response.data[i].from.name+'</b></span>' +
                                    '</li>';
                            }else{
                                htmlMessage += '<li >' +
                                    '<div>' +
                                    '<p class="message">' +
                                    '<span>'+response.data[i].message+'</span>' +
                                    '</p>' +
                                    '</div>' +
                                    '<span class="time note" data-bind="timeshort: LastUpdatedDate">'+moment(new Date(response.data[i].created_time)).format('DD/MM h:mm: A')+'</span>' +
                                    '<br><span class="note">Được gửi bởi <b data-bind="text: UserName">'+response.data[i].from.name+'</b></span>' +
                                    '</li>';
                            }
                        }

                        $('#conversation-message-picture').html('');
                        $('#conversation-message-picture').html(htmlMessage);
						var lastmessage = $('#conversation-message-picture');
                        $('#message-type').val('message');
                        $('#private-id-message').val(idConversation);
                        $('.list-message').show();
						//scroll xuong cuoi trang chat
						var wtf    = $(".list-message-container");
						var height = wtf[0].scrollHeight;
						$(".list-message-container").scrollTop(height);
                    }else{
                        dataJson = {error: 'Không lấy được danh sách tin nhắn'};
                    }
                }
            );
        }

		
		function initWebsocket(){
            if ("WebSocket" in window)
            {
               console.log("browser support web socket");
               // Let us open a web socket
			   ws = new WebSocket("ws://localhost:1338");
				
               ws.onopen = function(){
				console.log('create socket connection');
               };
				
               ws.onmessage = function (evt) 
               { 
                 var received_msg = evt.data;
                 console.log("receive message from websocket :" + JSON.stringify(received_msg))
				 var changes  = JSON.parse(received_msg);
				 //tin nhan den page
				 if(changes.messaging && changes.messaging[0].message){
					getDetailMessageChange(changes.messaging[0].message.mid); 
				 }
				 
				 //thay doi tren conversation 
				  if(changes.changes && changes.changes[0].field == 'conversations' && changes.changes[0].value !=null && changes.changes[0].value !=undefined && changes.changes[0].value.thread_id  ){
					  //reload lai danh sach tin nhan
					  getListMessage();
				  }
				 
				 
				 
               };
				ws.onerror = function (evt) 
               { 
                  var received_msg = evt.data;
                 console.log("receive error from websocket :" + JSON.stringify(received_msg))
               };
               ws.onclose = function()
               { 
                  // websocket is closed.
                  console.log('close websocket');
               };
					
               window.onbeforeunload = function(event) {
                  ws.close();
               };
            }
            
            else{
               // The browser doesn't support WebSocket
               alertify.error("Trình duyệt không hỗ trợ tính năng cập nhật trạng thái thời gian thực, vui lòng thử lại với trình duyệt khác!",100);
            }
         }
		
		
		
		function hideComment(commentId){
			FB.api(
                commentId,
                'POST',
					{
					'is_hidden': true,
					'access_token': pageAccessToken
                    },
                function(response) {
                 if(!response.error && response.success==true){
                     alertify.success('Đã ẩn tin nhắn');
                 }else{
					  alertify.error('Không ẩn được tin nhắn này');
                 }
                }
            );
		}
		
		function privateReply(commentId, message){
			FB.api(
                commentId+'/private_replies',
                'POST',
					{
					'message': message,
					'access_token': pageAccessToken
                    },
                function(response) {
                 if(!response.error){
                     alertify.success('Đã inbox cho người dùng');
                 }else{
					 alertify.error(response.error.message);
                 }
                }
            );
			
		}
		
		//reaction comment
		function reactionComment(commentId, reactions){
		if(reactions == null || reactions ==undefined || reactions == ''){
			reactions = 'LIKE';//reactions constants
		}
			FB.api(
                commentId,
                'POST',
					{
					'reactions': reactions,
					'access_token': pageAccessToken
                    },
                function(response) {
                 if(!response.error && response.success==true){
                     alertify.success('Đã thể hiện cảm xúc với comment trên');
                 }else{
					  alertify.error('Không thể biểu lộ cảm xúc với comment này');
                 }
                }
            );
		}
		
		

		
		//lay thong tin chi tiet thay doi cua tin nhan
		function getDetailMessageChange(messageId){
			FB.api(
                'm_'+messageId,
                'GET',
					{
					'fields': 'message,id,created_time,from{id,picture,name},to{id,picture,name}',
					'access_token': pageAccessToken
                    },
                function(response) {
                 if(!response.error && response.success==true){
                    console.log(response);
                 }else{
					//console.log('ko lấy được thông tin message mới');
                 }
                }
            );
			
		}
		
		//lay thong tin chi tiet thay doi cua comment
		function getDetailNewComment(commentId){
			FB.api(
                commentId,
                'GET',
					{
					'fields': 'comment,id,created_time,from{id,picture,name},to{id,picture,name}',
					'access_token': pageAccessToken
                    },
                function(response) {
                 if(!response.error && response.success==true){
                    appendNewComment(response);
                 }else{
					//console.log('ko lấy được thông tin message mới');
                 }
                }
            );
			
		}
		
		
		function sendPrivateReply(commentId){
			$('#comment-id-private-message').val(commentId);
			//$('#dialog-reply').modal().show();
		}
		
		function createTextboxQuickReply(commentId){
			$('#comment-id-quick-reply').val(commentId);
			}
		
		function sendMessagePrivately(){
			var commentId =  $('#comment-id-private-message').val();
			var message  = $('#quick-private-reply-box').val();
			if(message==null || message== undefined || message.trim()==''){
				alertify.error('Chưa nhập nội dung trước khi gửi');
			}else{
				privateReply(commentId,message);
			}
		}
		
		
		function sendQuickReply(){
			var commentId =  $('#comment-id-quick-reply').val();
			var message = $('#quick-reply-box').val();	
			if(message==null || message== undefined || message.trim()==''){
				alertify.error('Chưa nhập nội dung trước khi gửi');
			}else{
				replyACommnent(commentId,message);
			}
		}
		
		
		
</script>

</body>
</html>