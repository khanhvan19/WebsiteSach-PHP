<?php
    $GLOBALS['totalqtt'] = 0;
    $GLOBALS['totalprice'] = 0;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $item){
            $GLOBALS['totalqtt'] +=  (int)$item['qtt'];    
            $GLOBALS['totalprice'] += (int)$item['price']*$item['qtt'];
        }
    }
?>
<header>
    <div class="top-header d-none d-lg-block" id="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <a class="me-4" href="?view=home/contact"><i class="fa-solid fa-circle-question"></i> Hỗ trợ khách hàng</a>
                    <a href="?view=order/order"><i class="fa-solid fa-box-open"></i> Đơn hàng đã đặt</a>
                </div>
                <div class="col-lg-6 ms-auto text-end fw-bold">
                    <i class="fa-solid fa-phone-volume"></i>
                    Hot line:
                    <span class="text-danger">077.999.999 - 077.999.888</span>
                </div>
            </div>
        </div>
    </div>
    <div id="logo-res" class="pt-2 d-lg-none d-block text-center">
        <a href="?view=home/home">
            <img src="img/logo/logo.png" alt="Bookworld" height="50px">
        </a>
    </div>
    <div class="py-2 bg-white" id="stickyheader">
        <div class="container">
            <div class="d-flex flex-nowrap align-items-center">
                <a class="me-4 d-lg-block d-none" href="?view=home/home">
                    <img src="img/logo/logo.png" alt="Bookworld" height="50px">
                </a>
                <a class="me-2 btn btn-success" data-bs-toggle="offcanvas" href="#menuCanvas" role="button" aria-controls="menuCanvas">
                    <i class="fa-solid fa-bars-staggered"></i>
                </a>
                <form action="?view=product/product" method="POST" class="input-group flex-nowrap me-3">
                    <select class="form-select flex-grow-0" name="type_search" style="width: 20%">
                        <option value="tenSach" selected>Tên sách</option>
                        <option value="tenTG">Tác giả</option>
                        <option value="tenNXB">NXB</option>
                    </select>
                    <input class="form-control flex-grow-1" type="text" name="key_search" placeholder="Sách bạn muốn tìm?">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div class="d-flex ">
                    <div class="dropdown me-3">
                        <a class="d-flex align-items-center text-secondary" href="#" id="taikhoan" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if(!isset($_SESSION['name'])){?>
                            <div class="navbar-icon-box border border-2 border-secondary rounded-circle"><i class="fa-solid fa-user fs-3 "></i></div>
                            <div class="ms-1 dropdown-toggle d-lg-block d-none"><small>Tài khoản<br>Hello! Guest</small></div>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="taikhoan">
                            <li><a class="dropdown-item fw-bold" href="?view=auth/login">Đăng nhập</a></li>
                            <li><a class="dropdown-item fw-bold" href="?view=auth/registration">Đăng ký</a></li>
                        </ul>
                        <?php
                        } else { 
                        ?>
                        <div class="navbar-icon-box border border-2 border-primary rounded-circle" style="line-height: 0;">
                            <img src="img/user/<?= $_SESSION['avt'] ?>" class="w-100 rounded-circle">
                        </div>
                        <div class="ms-1 dropdown-toggle d-lg-block d-none"><small>Tài khoản<br>Hello!<b>
                            <?= substr($_SESSION['name'],strrpos($_SESSION['name'],' '));?>
                        </b></small></div></a>
                        <ul class="dropdown-menu" aria-labelledby="taikhoan">
                            <li><a class="dropdown-item fw-bold" href="?view=home/home&logout=1">Đăng xuất</a></li>
                        </ul>
                        <?php } ?>
                    </div>
                    <div>
                        <a class="d-flex align-items-center text-secondary" href="?view=order/cart">
                            <div class="navbar-icon-box border border-2 border-secondary rounded-circle position-relative">
                                <i class="fa-solid fa-basket-shopping fs-3"></i>
                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger"><?=$totalqtt?></span>
                            </div>
                            <div class="text-nowrap ms-1 d-lg-block d-none"><small>Giỏ hàng<br><b><?=$GLOBALS['totalqtt']?></b> Sản phẩm</small></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
