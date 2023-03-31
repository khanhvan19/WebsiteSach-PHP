<?php
if (!(isset($_SESSION['name']) && $_SESSION['avt'])) {
    echo "<script> window.location.href='?view=auth/login&action=cart'; </script>";
}
?>

<main class="py-3">
    <div class="container">
        <h4 class="mb-2 text-primary">Đơn hàng mới:</h4>
        <div class="p-2 bg-white rounded-3">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr class="table-secondary text-center">
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Người đặt</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = ' SELECT * FROM donhang WHERE sta="new" AND maKH='.$_SESSION['idKH'].' ';
                    $result = getData($sql);
                    foreach ($result as $item) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $item['maDH'] ?></td>
                        <td class="text-center"><?= number_format($item['giatri']) ?>đ</td>
                        <td><?= $item['tenNMua'] ?></td>
                        <td class="text-center"><?= $item['sdt'] ?></td>
                        <td><?= $item['diachi'] ?></td>
                        <td><?= $item['ghichu'] ?></td>
                        <td class="text-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#donhang<?= $item['maDH'] ?>" class="text-success fw-bold text-decoration-underline text-nowrap">Chi tiết</a>
                        </td>
                        <td class="text-center"><a href="#" class="btn btn-danger btn-sm fw-bold text-nowrap" data-bs-toggle="modal" data-bs-target="#xn_huy<?=$item['maDH']?>">Hủy đơn</a></td>
                        
                    </tr>

                    <div class="modal fade" id="xn_huy<?=$item['maDH']?>" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-success fw-bold" id="detailLabel">Xác nhận hủy đơn hàng</h5>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc muốn hủy đơn hàng mã số <b><?= $item['maDH'] ?></b></br>
                                    Khi nhấn tiếp tục, đơn hàng của bạn sẽ bị hủy!!!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bỏ qua</button>
                                    <a href="?view=order/xulyorder&action=huy&iddh=<?= $item['maDH'] ?>" class="btn btn-danger">Tiếp tục</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="donhang<?= $item['maDH'] ?>" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-success fw-bold" id="detailLabel">Chi tiết đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row fw-bold">
                                        <div class="col-2">ID</div>
                                        <div class="col-8">Tên sách</div>
                                        <div class="col-2">SL</div>
                                    </div>

                                    <?php
                                    $sql_ct = ' SELECT * FROM chitietdh WHERE maDH=' . $item['maDH'] . ' ';
                                    $dsct = getData($sql_ct);
                                    foreach ($dsct as $ct) {
                                    ?>
                                        <div class="row border-top border-2">
                                            <div class="col-2"><?= $ct['maSach'] ?></div>
                                            <div class="col-8"><?= $ct['tenSach'] ?></div>
                                            <div class="col-2"><?= $ct['solg'] ?></div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hoàn thành</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </tbody>
            </table>
        </div>
                                        

        <h4 class="mb-2 mt-4 text-success">Đang vận chuyển:</h4>
        <div class="p-2 bg-white rounded-3">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr class="table-secondary text-center">
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Người đặt</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = ' SELECT * FROM donhang WHERE sta="dilivery" AND maKH='.$_SESSION['idKH'].' ';
                    $result = getData($sql);
                    foreach ($result as $item) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $item['maDH'] ?></td>
                        <td class="text-center"><?= number_format($item['giatri']) ?>đ</td>
                        <td><?= $item['tenNMua'] ?></td>
                        <td class="text-center"><?= $item['sdt'] ?></td>
                        <td><?= $item['diachi'] ?></td>
                        <td><?= $item['ghichu'] ?></td>
                        <td class="text-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#donhang<?= $item['maDH'] ?>" class="text-success fw-bold text-decoration-underline text-nowrap">Chi tiết</a>
                        </td>
                        <td class="text-center"><a href="?view=order/xulyorder&action=nhan&iddh=<?=$item['maDH']?>" class="btn btn-success btn-sm fw-bold text-nowrap">Đã nhận</a></td>
                    </tr>

                    <div class="modal fade" id="donhang<?= $item['maDH'] ?>" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-success fw-bold" id="detailLabel">Chi tiết đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row fw-bold">
                                        <div class="col-2">ID</div>
                                        <div class="col-8">Tên sách</div>
                                        <div class="col-2">SL</div>
                                    </div>

                                    <?php
                                    $sql_ct = ' SELECT * FROM chitietdh WHERE maDH=' . $item['maDH'] . ' ';
                                    $dsct = getData($sql_ct);
                                    foreach ($dsct as $ct) {
                                    ?>
                                        <div class="row border-top border-2">
                                            <div class="col-2"><?= $ct['maSach'] ?></div>
                                            <div class="col-8"><?= $ct['tenSach'] ?></div>
                                            <div class="col-2"><?= $ct['solg'] ?></div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hoàn thành</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </tbody>
            </table>
        </div>


        <h4 class="mb-2 mt-4 text-danger">Đơn hàng đã hủy:</h4>
        <div class="p-2 bg-white rounded-3">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr class="table-secondary text-center">
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Người đặt</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = ' SELECT * FROM donhang WHERE sta="cancer" AND maKH='.$_SESSION['idKH'].' ';
                    $result = getData($sql);
                    foreach ($result as $item) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $item['maDH'] ?></td>
                        <td class="text-center"><?= number_format($item['giatri']) ?>đ</td>
                        <td><?= $item['tenNMua'] ?></td>
                        <td class="text-center"><?= $item['sdt'] ?></td>
                        <td><?= $item['diachi'] ?></td>
                        <td><?= $item['ghichu'] ?></td>
                        <td class="text-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#donhang<?= $item['maDH'] ?>" class="text-danger fw-bold text-decoration-underline text-nowrap">Chi tiết</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="donhang<?= $item['maDH'] ?>" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-success fw-bold" id="detailLabel">Chi tiết đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row fw-bold">
                                        <div class="col-2">ID</div>
                                        <div class="col-8">Tên sách</div>
                                        <div class="col-2">SL</div>
                                    </div>

                                    <?php
                                    $sql_ct = ' SELECT * FROM chitietdh WHERE maDH=' . $item['maDH'] . ' ';
                                    $dsct = getData($sql_ct);
                                    foreach ($dsct as $ct) {
                                    ?>
                                        <div class="row border-top border-2">
                                            <div class="col-2"><?= $ct['maSach'] ?></div>
                                            <div class="col-8"><?= $ct['tenSach'] ?></div>
                                            <div class="col-2"><?= $ct['solg'] ?></div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hoàn thành</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </tbody>
            </table>
        </div>


        <h4 class="mb-2 mt-4 text-secondary">Đơn hàng đã đặt:</h4>
        <div class="p-2 bg-white rounded-3">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr class="table-secondary text-center">
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Người đặt</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = ' SELECT * FROM donhang WHERE sta="success" AND maKH='.$_SESSION['idKH'].' ';
                    $result = getData($sql);
                    foreach ($result as $item) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $item['maDH'] ?></td>
                        <td class="text-center"><?= number_format($item['giatri']) ?>đ</td>
                        <td><?= $item['tenNMua'] ?></td>
                        <td class="text-center"><?= $item['sdt'] ?></td>
                        <td><?= $item['diachi'] ?></td>
                        <td><?= $item['ghichu'] ?></td>
                        <td class="text-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#donhang<?= $item['maDH'] ?>" class="text-success fw-bold text-decoration-underline text-nowrap">Chi tiết</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="donhang<?= $item['maDH'] ?>" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-success fw-bold" id="detailLabel">Chi tiết đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row fw-bold">
                                        <div class="col-2">ID</div>
                                        <div class="col-8">Tên sách</div>
                                        <div class="col-2">SL</div>
                                    </div>

                                    <?php
                                    $sql_ct = ' SELECT * FROM chitietdh WHERE maDH=' . $item['maDH'] . ' ';
                                    $dsct = getData($sql_ct);
                                    foreach ($dsct as $ct) {
                                    ?>
                                        <div class="row border-top border-2">
                                            <div class="col-2"><?= $ct['maSach'] ?></div>
                                            <div class="col-8"><?= $ct['tenSach'] ?></div>
                                            <div class="col-2"><?= $ct['solg'] ?></div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hoàn thành</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</main>