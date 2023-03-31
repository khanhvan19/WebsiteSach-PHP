<?php
$idPro = $_GET['sp'];
$sql = 'SELECT * FROM sach s 
            JOIN chitietsp ct ON s.maSach=ct.maSach  
            JOIN (  SELECT l.*, d.tenDM FROM loaisach l 
                    JOIN danhmuc d ON l.maDM=d.maDM
                 ) l ON s.maLoai=l.maLoai
        WHERE s.maSach=' . $idPro . ' ';
$product =  getData($sql);
?>
<main class="py-3">
    <div class="container">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="?view=product/product&attr=maDM&val=<?= $product[0]['maDM'] ?>"><?= $product[0]['tenDM'] ?></a></li>
                <li class="breadcrumb-item"><a href="?view=product/product&attr=maLoai&val=<?= $product[0]['maLoai'] ?>"><?= $product[0]['tenLoai'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $product[0]['tenSach'] ?></li>
            </ol>
        </div>

        <div class="mt-3 bg-white rounded-3 p-3">
            <div class="row">
                <div class="col-lg-5 text-center">
                    <img src="img/sach/<?= $product[0]['anhSach'] ?>" class="w-100 img-detail-product">
                </div>
                <div class="col-lg-7 d-flex flex-column">
                    <div class="mb-3">
                        <h3 class="mb-4 fw-bolder"><?= $product[0]['tenSach'] ?></h3>
                        <div class="mb-2">Tác giả: <b><?= $product[0]['tenTG'] ?></b></div>
                        <div class="mb-2">Nhà xuất bản: <b><?= $product[0]['tenNXB'] ?></b></div>
                        <div class="mb-4">Hình thức bìa: <b><?= $product[0]['hinhThuc'] ?></b></div>

                        <div class="mb-5">
                            <strong class="text-danger fs-2"><?=number_format($product[0]['donGia'])?> đ</strong>
                        </div>

                        <div>
                            <p class="fst-italic mb-2">
                                <i class="fa-solid fa-check"></i>
                                 Đổi trả sản phẩm trong vòng 30 ngày 
                                <a href="?view=home/contact" class="text-decoration-underline text-primary">(chi tiết)</a>
                            </p>
                            <p class="fst-italic">
                                <i class="fa-solid fa-check"></i>
                                 Miễn phí giao hàng toàn quốc cho Đơn hàng từ 300.000 đ
                                <a href="#" class="text-decoration-underline text-primary">(chi tiết)</a>
                            </p>
                        </div>

                    </div>
                    <div class="row mt-auto">
                        <button type="button" class="btn btn-danger w-50 py-2 fw-600" data-bs-toggle="modal" data-bs-target="#dathang">
                            Thêm vào giỏ hàng
                        </button>

                        <div class="modal fade" id="dathang" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Thêm vào giỏ hàng</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fw-bold text-success fs-5">1 sản phẩm sẽ được thêm giỏ hàng</p>
                                        <div class="row">
                                            <div class="col-4"><img src="img/sach/<?= $product[0]['anhSach'] ?>" class="w-100"></div>
                                            <div class="col-8">
                                                <div class="fw-bold"><?= $product[0]['tenSach'] ?></div>
                                                <div>Tác giả: <b><?= $product[0]['tenTG'] ?></b></div>
                                                <div>Nhà xuất bản: <b><?= $product[0]['tenNXB'] ?></b></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary">Hủy</button>
                                        <a href="?view=order/xulycart&action=addCart&id=<?= $product[0]['maSach'] ?>" class="btn btn-primary">Xác nhận</a>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-3 bg-white rounded-3 p-2">
            <h5 class="border-bottom pt-2 pb-3 mx-2 text-danger"><i class="fa-solid fa-lightbulb"></i> BOWO GIỚI THIỆU</h5>
            <div class="row g-3 py-3">
                <?php
                $sql = 'SELECT * FROM sach
                        WHERE (tenSach LIKE "%' . $product[0]['tenSach'] . '%" 
                                OR tenTG LIKE "%' . $product[0]['tenTG'] . '%"
                                OR tenNXB LIKE "%' . $product[0]['tenNXB'] . '%")
                            AND (maSach NOT IN ("'.$product[0]['maSach'].'"))
                        ORDER BY maSach DESC LIMIT 4 ';
                getProduct($sql);
                ?>
            </div>
            <div class="text-center">
                <a href="?view=product/product" class="btn btn-outline-success border-2 fw-600">Xem thêm</a>
            </div>
        </div>

        <div class="mt-3 bg-white rounded-3 p-2">
            <h4 class="border-bottom pt-2 pb-3 mx-3">Thông tin chi tiết</h4>
            <div class="px-3">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Tác giả</th>
                            <td><?= $product[0]['tenTG'] ?></td>
                        </tr>
                        <tr>
                            <th>Nhà xuất bản</th>
                            <td><?= $product[0]['tenNXB'] ?></td>
                        </tr>
                        <tr>
                            <th>Năm xuất bản</th>
                            <td><?= $product[0]['namXB'] ?></td>
                        </tr>
                        <tr>
                            <th>Ngôn ngữ</th>
                            <td><?= $product[0]['ngonNgu'] ?></td>
                        </tr>
                        <tr>
                            <th>Trọng lượng</th>
                            <td><?= $product[0]['trongLuong'] ?> gram</td>
                        </tr>
                        <tr>
                            <th>Kích thước</th>
                            <td><?= $product[0]['kichThuoc'] ?></td>
                        </tr>
                        <tr>
                            <th>Số trang</th>
                            <td><?= $product[0]['soTrang'] ?></td>
                        </tr>
                        <tr>
                            <th>Hình thức</th>
                            <td><?= $product[0]['hinhThuc'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3 bg-white rounded-3 p-2">
            <h4 class="border-bottom pt-2 pb-3 mx-3">Giới thiệu sách</h4>
            <div class="px-3">
                <p class="fs-18px fw-bold"><?= $product[0]['tenSach'] ?></p>
                <p><?= $product[0]['baiViet'] ?></p>
            </div>
        </div>
    </div>
</main>
