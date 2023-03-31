<main class="py-3">
    <div class="container">
        <div class="row g-2">
            <div id="slider" class="carousel slide col-lg-8" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/slider/bannerlogo.png" class="d-block w-100 rounded-3" alt="BOWObookstore">
                    </div>
                    <div class="carousel-item">
                        <img src="img/slider/bannerdisney.jpg" class="d-block w-100 rounded-3" alt="Sach disney">
                    </div>
                    <div class="carousel-item">
                        <img src="img/slider/bannerhe.jpg" class="d-block w-100 rounded-3" alt="Sach chao he">
                    </div>
                    <div class="carousel-item">
                        <img src="img/slider/bannersvanhoc.jpg" class="d-block w-100 rounded-3" alt="Sach van hoc">
                    </div>
                    <div class="carousel-item">
                        <img src="img/slider/bannersachnn.png" class="d-block w-100 rounded-3" alt="Sach ngoai ngu">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
            <div class="col-lg-4">
                <div class="row g-2">
                    <div class="col-lg-12 col-6 rounded-3">
                        <img src="img/slider/bannersachmuadich.png" class="d-block w-100 rounded-3" alt="Sach ngoai ngu">
                    </div>
                    <div class="col-lg-12 col-6 rounded-3">
                        <img src="img/slider/bannerst4.jpg" class="d-block w-100 rounded-3" alt="Sach thang 4">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 bg-white p-2">
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold fs-18px" id="sachhot-tab" data-bs-toggle="tab" data-bs-target="#sachhot" type="button" role="tab" aria-controls="sachhot" aria-selected="true"><i class="fa-solid fa-fire"></i> Sách HOT</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold fs-18px" id="sachmoi-tab" data-bs-toggle="tab" data-bs-target="#sachmoi" type="button" role="tab" aria-controls="sachmoi" aria-selected="false"><i class="fa-solid fa-certificate"></i> Sách mới</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active " id="sachhot" role="tabpanel" aria-labelledby="sachhot">
                        <div class="row g-3 py-3">
                            <?php
                            $sql = 'SELECT * FROM sach WHERE sta="hot" AND soLuong>0 ORDER BY maSach DESC LIMIT 8 ';
                            getProduct($sql);
                            ?>
                        </div>
                        <div class="text-center">
                            <a href="?view=product/product&attr=sta&val=hot" class="btn btn-outline-success border-2 fw-600">Xem thêm</a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sachmoi" role="tabpanel" aria-labelledby="sachmoi">
                        <div class="row g-3 py-3">
                            <?php
                            $sql = 'SELECT * FROM sach WHERE soLuong>0 ORDER BY maSach DESC LIMIT 8';
                            getProduct($sql);
                            ?>
                        </div>
                        <div class="text-center">
                            <a href="?view=product/product" class="btn btn-outline-success border-2 fw-600">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 bg-success rounded-3 p-2 text-white">
            <h4 class="border-bottom pt-2 pb-3 mx-2"><i class="fa-solid fa-wand-magic-sparkles"></i> Sách nổi bật</h4>
            <div id="sachhay" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $sql = 'SELECT s.*, ct.baiViet 
                            FROM sach s JOIN chitietsp ct ON s.maSach=ct.maSach 
                            WHERE s.sta="hot" AND soLuong>0 ORDER BY maSach DESC LIMIT 3 ';
                    $result = getData($sql);
                    foreach ($result as $index => $value) {
                        if ($index == 0) {
                    ?>
                    <div class="carousel-item active" data-bs-interval="7000">
                    <?php
                        } else {
                    ?>
                    <div class="carousel-item" data-bs-interval="7000">
                    <?php
                        }
                    ?>
                        <div class="row">
                            <div class="col-lg-4 p-3">
                                <a href="?view=product/detail&sp=<?php echo $value['maSach'] ?>" class="d-block text-center">
                                    <img src="img/sach/<?php echo $value['anhSach'] ?>" class="w-100 img-best-product" alt="...">
                                </a>
                            </div>
                            <div class="col-lg-8 p-3 d-flex flex-column">
                                <div>
                                    <h4><?php echo $value['tenSach'] ?></h4>
                                    <p class="fst-italic d-inline-block border-bottom pb-2"><?php echo $value['tenTG'] ?></p>
                                    <p class="info-product"><?php echo $value['baiViet'] ?></p>
                                </div>
                                <div class="pt-4 border-top mt-auto d-flex justify-content-end align-items-center">
                                    <strong class="fs-4 text-warning me-4"><?php echo $value['donGia'] ?><span> đ</span></strong>
                                    <a href="?view=product/detail&sp=<?php echo $value['maSach'] ?>" class="btn btn-warning">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev btn-slider-product" type="button" data-bs-target="#sachhay" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-white bg-opacity-50 py-5" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next btn-slider-product" type="button" data-bs-target="#sachhay" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-white bg-opacity-50 py-5" aria-hidden="true"></span>
                </button>
            </div>
        </div>

        <div class="mt-3 bg-white rounded-3 p-2">
            <h5 class="border-bottom pt-2 pb-3 mx-2 text-danger"><i class="fa-solid fa-fire"></i> Sách văn học mới</h5>
            <div class="row g-3 py-3">
                <?php
                $sql = 'SELECT s.*
                        FROM sach s JOIN loaisach l ON s.maLoai=l.maLoai
                        WHERE l.maDM=1 AND soLuong>0 ORDER BY maSach DESC LIMIT 8 ';
                getProduct($sql);
                ?>
                <div class="text-center">
                    <a href="?view=product/product&attr=maDM&val=1" class="btn btn-outline-success border-2 fw-600">Xem thêm</a>
                </div>
            </div>
        </div>

        <div class="mt-3 bg-white rounded-3 p-2">
            <h5 class="border-bottom pt-2 pb-3 mx-2 text-danger"><i class="fa-solid fa-fire"></i> Sách thiếu nhi mới</h5>
            <div class="row g-3 py-3">
                <?php
                $sql = 'SELECT s.*
                        FROM sach s JOIN loaisach l ON s.maLoai=l.maLoai
                        WHERE l.maDM=2 AND soLuong>0 ORDER BY maSach DESC LIMIT 8 ';
                getProduct($sql);
                ?>
            </div>
            <div class="text-center">
                <a href="?view=product/product&attr=maDM&val=2" class="btn btn-outline-success border-2 fw-600">Xem thêm</a>
            </div>
        </div>

        <div class="mt-3 bg-warning rounded-3 p-2">
            <h4 class="border-bottom border-danger text-danger fw-bolder pt-2 pb-3 mx-2"><i class="fa-solid fa-meteor"></i> Sắp phát hành</h4>
            <div id="coming" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $sql = 'SELECT s.*, ct.baiViet 
                            FROM sach s JOIN chitietsp ct ON s.maSach=ct.maSach 
                            WHERE s.sta="coming" AND soLuong>0 ORDER BY maSach DESC LIMIT 3 ';
                    $result = getData($sql);
                    foreach ($result as $index => $value) {
                        if ($index == 0) {
                    ?>
                    <div class="carousel-item active" data-bs-interval="7000">
                    <?php
                        } else {
                    ?>
                    <div class="carousel-item" data-bs-interval="7000">
                    <?php
                        }
                    ?>
                        <div class="row">
                            <div class="col-lg-4 p-3">
                                <a href="?view=product/detail&sp=<?php echo $value['maSach'] ?>" class="d-block text-center">
                                    <img src="img/sach/<?php echo $value['anhSach'] ?>" class="w-100 img-best-product" alt="...">
                                </a>
                            </div>
                            <div class="col-lg-8 p-3 d-flex flex-column">
                                <div>
                                    <h4><?php echo $value['tenSach'] ?></h4>
                                    <p class="fst-italic d-inline-block border-bottom border-dark pb-2"><?php echo $value['tenTG'] ?></p>
                                    <p class="info-product"><?php echo $value['baiViet'] ?></p>
                                </div>
                                <div class="pt-4 border-top border-dark mt-auto d-flex justify-content-end align-items-center">                            
                                    <strong class="fs-5 text-danger me-4">25000<span>đ</span></strong>
                                    <a href="?view=product/detail&sp=<?php echo $value['maSach'] ?>" class="btn btn-danger">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev btn-slider-product" type="button" data-bs-target="#coming" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-white bg-opacity-50 py-5" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next btn-slider-product" type="button" data-bs-target="#coming" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-white bg-opacity-50 py-5" aria-hidden="true"></span>
                </button>
            </div>
        </div>

        <div class="mt-3 bg-white rounded-3 p-2">
            <h5 class="border-bottom pt-2 pb-3 mx-2 text-danger"><i class="fa-solid fa-fire"></i> Sách kinh tế mới</h5>
            <div class="row g-3 py-3">
                <?php
                $sql = ' SELECT s.*
                        FROM sach s JOIN loaisach l ON s.maLoai=l.maLoai
                        WHERE l.maDM=3 AND soLuong>0 ORDER BY maSach DESC LIMIT 8 ';
                getProduct($sql);
                ?>
            </div>
            <div class="text-center">
                <a href="?view=product/product&attr=maDM&val=3" class="btn btn-outline-success border-2 fw-600">Xem thêm</a>
            </div>
        </div>

        <div class="mt-3 bg-white rounded-3 p-2">
            <h5 class="border-bottom pt-2 pb-3 mx-2 text-danger"><i class="fa-solid fa-fire"></i> Sách kỹ năng sống mới</h5>
            <div class="row g-3 py-3">
                <?php
                $sql = ' SELECT s.*
                        FROM sach s JOIN loaisach l ON s.maLoai=l.maLoai
                        WHERE l.maDM=4 AND soLuong>0 ORDER BY maSach DESC LIMIT 8 ';
                getProduct($sql);
                ?>
            </div>
            <div class="text-center">
                <a href="?view=product/product&attr=maDM&val=4" class="btn btn-outline-success border-2 fw-600">Xem thêm</a>
            </div>
        </div>
        
    </div>

</main>