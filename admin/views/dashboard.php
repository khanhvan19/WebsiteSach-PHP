<div class="main py-2">
    <div class="bg-white align-items-center py-2 rounded-3">
        <div class="col-6 fs-4 fw-600 px-2">
            Bảng điều khiển
        </div>
    </div>
    <div class="bg-white align-items-center my-2 p-2 rounded-3">
        <div class="row">
            <div class="col-3 ">
                <div class="card text-white  border border-3 border-primary">
                    <div class="card-body d-flex align-items-center bg-primary p-2">
                        <i class="fa-solid fa-book p-3" style="font-size: 50px;"></i>
                        <div>
                            <?php
                            $sql = ' SELECT COUNT(*) as total FROM sach ';
                            $result = getData($sql);
                            ?>
                            <p class="card-text mb-0">Sản phẩm sách</p>
                            <h2 class="card-title"><?= $result[0]['total'] ?></h2>
                        </div>
                    </div>
                    <a href="?adpage=sanpham/hienthi" class="card-body d-block text-primary p-2 fw-bold">
                        Xem chi tiết <i class="fa-solid fa-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white border border-3 border-success">
                    <div class="card-body d-flex align-items-center bg-success p-2">
                        <i class="fa-solid fa-users p-3" style="font-size: 50px;"></i>
                        <div>
                            <?php
                            $sql = ' SELECT COUNT(*) as total FROM khachhang ';
                            $result = getData($sql);
                            ?>
                            <p class="card-text mb-0">Khách hàng</p>
                            <h2 class="card-title"><?= $result[0]['total'] ?></h2>
                        </div>
                    </div>
                    <a href="?adpage=khachhang" class="card-body d-block text-success p-2 fw-bold">
                        Xem chi tiết <i class="fa-solid fa-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white  border border-3 border-warning">
                    <div class="card-body d-flex align-items-center bg-warning p-2">
                        <i class="fa-solid fa-bag-shopping p-3" style="font-size: 50px;"></i>
                        <div>
                            <?php
                            $sql = ' SELECT COUNT(*) as total FROM donhang WHERE sta="new" ';
                            $result = getData($sql);
                            ?>
                            <p class="card-text mb-0">Đơn hàng mới</p>
                            <h2 class="card-title"><?= $result[0]['total'] ?></h2>
                        </div>
                    </div>
                    <a href="?adpage=donhang/hienthi" class="card-body d-block text-warning p-2 fw-bold">
                        Xem chi tiết <i class="fa-solid fa-circle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-3">
                <div class="card text-white  border border-3 border-danger">
                    <div class="card-body d-flex align-items-center bg-danger p-2">
                        <i class="fa-solid fa-circle-dollar-to-slot p-3" style="font-size: 50px;"></i>
                        <div>
                            <?php
                            $sql = ' SELECT SUM(giatri) as total FROM donhang WHERE sta="success" ';
                            $result = getData($sql);
                            ?>
                            <p class="card-text mb-0">Tổng doanh thu</p>
                            <h2 class="card-title"><?= number_format($result[0]['total']) ?><sup>đ</sup></h2>
                        </div>
                    </div>
                    <a href="?adpage=donhang/hienthi" class="card-body d-block text-danger p-2 fw-bold">
                        Xem chi tiết <i class="fa-solid fa-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-6">
            <div class="ps-3 py-2 rounded-3 bg-white">
                <div class="fs-5 fw-600 mb-2 pb-1 border-bottom border-2 text-danger">
                    <i class="fa-solid fa-fire"></i> Top sách bán chạy
                </div>
                <?php
                $sql = ' SELECT s.anhSach, s.tenSach, s.tenTG, SUM(ct.solg) as sl 
                         FROM chitietdh ct JOIN sach s ON s.maSach=ct.maSach
                         GROUP BY ct.maSach ORDER BY sl DESC LIMIT 5';
                $result = getData($sql);
                foreach ($result as $i => $item) {
                ?>
                <div class="row mb-3">
                    <div class="col-1 my-auto fw-bold fs-5 text-danger"><?= $i + 1 ?></div>
                    <div class="col-3"><img src="../img/sach/<?= $item['anhSach'] ?>" class="w-100"> </div>
                    <div class="col-8">
                        <p class="fs-5 fw-600 mb-1 name_prod"><?= $item['tenSach'] ?></p>
                        <small class="fst-italic"><?= $item['tenTG'] ?></small>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-6">
            <div class="ps-3 py-2 rounded-3 bg-white">
                <div class="fs-5 fw-600 mb-2 pb-1 border-bottom border-2 text-warning">
                    <i class="fa-solid fa-star"></i> Khách hàng thân thiết
                </div>
                <?php
                $sql = ' SELECT k.avatar, k.hoten, COUNT(d.maDH) as sodon, SUM(d.giatri) as sotien
                         FROM donhang d JOIN khachhang k ON d.maKH=k.maKH
                         GROUP BY d.maKH ORDER BY sodon DESC LIMIT 5';
                $result = getData($sql);
                foreach ($result as $i => $item) {
                ?>
                <div class="row mb-3">
                    <div class="col-1 my-auto fw-bold fs-5 text-danger"><?= $i + 1 ?></div>
                    <div class="col-3"><img src="../img/user/<?= $item['avatar'] ?>" class="w-100 rounded-circle"> </div>
                    <div class="col-8">
                        <p class="fs-5 fw-600 mb-1">Khách hàng: <?= $item['hoten'] ?></p>
                        <p class="fst-italic mb-1"><span class="fw-600">Số đơn hàng: </span><?= $item['sodon'] ?> đơn hàng</p>
                        <p class="fst-italic mb-1"><span class="fw-600">Tổng giá trị: </span><?= number_format($item['sotien']) ?> đ</p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>