<?php
if (!(isset($_SESSION['name']) && $_SESSION['avt'])) {
    echo "<script> window.location.href='?view=auth/login&action=cart'; </script>";
}
?>

<main class="py-3">
    <div class="container">
        <h4>GIỎ HÀNG <b>(<?= $GLOBALS['totalqtt'] ?></b> sản phẩm)</h4>
        <div class="alert alert-success" role="alert">
            Miễn phí vận chuyển cho đơn hàng từ <b>300,000 đ</b>. Mua thêm 
            <b><?= number_format(((300000 - $GLOBALS['totalprice']) > 0) ? 300000 - $GLOBALS['totalprice'] : 0); ?> đ</b>
             để được miễn phí vận chuyển
        </div>

        <div class="mt-3 row">
            <div class="col-lg-9 mb-3">
                <div class="bg-white rounded-3 p-2">
                    
                    <?php
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $sql_qttsp = ' SELECT soLuong FROM sach WHERE maSach='.$item['id'].' ';
                            $qttsp = getData($sql_qttsp);
                    ?>
                    <div class="row py-1">
                        <div class="col-md-2 col-3">
                            <a href="?view=product/detail&sp=<?=$item['id']?>">
                                <img src="img/sach/<?= $item['img'] ?>" class="w-100" alt="...">
                            </a>
                        </div>
                        <div class="col-md-9 col-8">
                            <div class="row h-100">
                                <div class="col-lg-9">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <div class="product-name fw-bold fs-18px"><?= $item['name'] ?></div>
                                        <div class="text-danger fw-bold fs-5"><?= number_format($item['price'] * $item['qtt']) ?> đ</div>
                                        <small class="fst-italic text-danger d-block">*Số lượng đang có sẵn: <?=$qttsp[0]['soLuong']?> quyển</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 d-flex align-items-center">
                                    <form action="?view=order/xulycart" method="POST">
                                        <label class="me-2">SL:</label>
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <input type="number" name="num" max="<?=$qttsp[0]['soLuong']?>" min="1" value="<?= $item['qtt'] ?>" style="width:50px; text-align:center">
                                        <button type="submit" name="updateQtt" class="btn btn-sm btn-outline-success ms-2 mt-2 cn">cập nhật</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-1 d-flex justify-content-center align-items-center fs-5 text-danger">
                            <a href="?view=order/xulycart&delete=<?= $item['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
                    <hr class="my-0">
                    <?php } } ?>

                </div>
            </div>

            <div class="col-lg-3">
                <div class="position-sticky bg-white rounded-3 p-2" style="top: 82px">
                    <div class="border-bottom border-2">
                        <p class="d-flex justify-content-between"><i>Tạm tính:</i><b><?= number_format($GLOBALS['totalprice']) ?> đ</b></p>
                        <p class="d-flex justify-content-between">
                            <i>Phí vận chuyển:</i>
                            <b>
                            <?php
                            if ($GLOBALS['totalprice'] >= 300000) $ship = 0;
                            else $ship = $GLOBALS['totalprice'] * 0.1;
                            echo number_format($ship);
                            ?>
                            đ</b>
                        </p>
                    </div>
                    <div>
                        <p class="d-flex justify-content-between fs-5 fw-bold my-2 align-bottom">
                            Thành tiền:
                            <span class="text-danger"><?= number_format($GLOBALS['totalprice'] - $ship) ?> đ</span>
                        </p>
                        <button class="btn btn-danger w-100 fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#inforder">Thanh toán</button>
                    </div>
                    <div class="mt-3 fw-bold text-primary text-center">
                        <a href="?view=product/product"><i class="fa-solid fa-reply-all"></i> Tiếp tục mua sắm</a>
                    </div>
                    <div class="mt-3 fw-bold text-primary text-center">
                        <a href="?view=order/order">Đơn hàng đã đặt <i class="fa-solid fa-share"></i></a>
                    </div>
                </div>

                <!-- model -->
                <div class="modal fade" id="inforder" tabindex="-2" aria-labelledby="modelable" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success fw-bold" id="modelable">Thông tin đặt hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $sql = ' SELECT * FROM khachhang WHERE maKH="'.$_SESSION['idKH'].'" ';
                                $kh = getData($sql);
                                ?>
                                <form method="POST" action="?view=order/xulyorder">
                                    <input type="hidden" name="giatri" value="<?= $GLOBALS['totalprice'] - $ship ?>">
                                    <div class="mb-3">
                                        <label for="buyer" class="control-label fw-600">Họ tên</label>
                                        <input type="text" class="form-control" id="buyer" name="buyer" value="<?=$kh[0]['hoten']?>" required >
                                    </div>
                                    <div class="mb-3">
                                        <label for="sdt" class="control-label fw-600">Số điện thoại</label>
                                        <input type="text" class="form-control" id="sdt" name="sdt" value="<?=$kh[0]['sdt']?>" required placeholder="Số điện thoại nhận hàng">
                                    </div>
                                    <div class="mb-3">
                                        <label for="diachi" class="form-label fw-600">Địa chỉ nhận hàng</label>
                                        <textarea class="form-control" id="diachi" name="diachi" required placeholder="số nhà, phường/xã, quận/huyện, tỉnh/TP"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ghichu" class="form-label fw-600">Ghi chú</label>
                                        <textarea class="form-control" id="ghichu" name="ghichu" placeholder="Bạn muốn lưu ý gì cho chúng tôi?"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" name="checkout" class="btn btn-danger">Thanh toán</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->

            </div>
        </div> 
    </div>
</main>