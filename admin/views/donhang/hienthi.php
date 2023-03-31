<div class="main py-2">
    <div class="bg-white p-2 rounded-3 fs-4 fw-600">
        Quản lý đơn đặt hàng
    </div>
    <div class="bg-white mt-2 p-2 rounded-3">
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary text-center">
                    <th scope="col">Mã đơn</th>
                    <th scope="col">Mã KH</th>
                    <th scope="col">Giá trị</th>
                    <th scope="col">Người đặt</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Chi tiết</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $item_per_page = 15;
                $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($current_page - 1)*$item_per_page;
                $totalRecords = mysqli_query($dbc, "SELECT * FROM donhang ");
                $totalRecords = mysqli_num_rows($totalRecords);
                $totalPages = ceil($totalRecords / $item_per_page);

                $query = 'SELECT * FROM donhang ORDER BY maDH DESC LIMIT '.$item_per_page.' OFFSET '.$offset.' ';
                $result = getData($query);
                foreach ($result as $value) {
                ?>
                <tr>
                    <td class="text-center"><?=$value['maDH']?></td>
                    <td class="text-center"><?=$value['maKH']?></td>
                    <td class="text-center"><?=number_format($value['giatri'])?>đ</td>
                    <td><?=$value['tenNMua']?></td>
                    <td><?=$value['sdt']?></td>
                    <td><?=$value['diachi']?></td>
                    <td><?=$value['ghichu']?></td>
                    <td class="text-center"><a href="#" class="text-success fw-bold text-decoration-underline" data-bs-toggle="modal" data-bs-target="#donhang<?=$value['maDH']?>">Chi tiết</a></td>
                    <td class="text-center">
                        <?php 
                        switch($value['sta']) { 
                            case "new":
                        ?>
                        <a href="index.php?adpage=donhang/xuly&iddh=<?=$value['maDH']?>" class="text-primary fw-bold text-decoration-underline text-nowrap">ĐH mới</a></td>
                        <?php 
                                break; 

                            case "dilivery":
                                echo '<span class="text-success text-nowrap fw-600">Giao hàng</span>';
                                break; 

                            case "success":
                                echo '<span class="text-nowrap">Thành công</span>';
                                break; 

                            case "cancer":
                                echo '<span class="text-nowrap text-danger">Đã bị hủy</span>';
                                break;
                        }
                        ?>
                    </td>
                </tr>

                <div class="modal fade" id="donhang<?=$value['maDH']?>" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success fw-bold" id="detailLabel">Chi tiết sản phẩm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row fw-bold">
                                    <div class="col-2">ID</div>
                                    <div class="col-8">Tên sách</div>
                                    <div class="col-2">SL</div>
                                </div>

                                <?php 
                                $sql = ' SELECT * FROM chitietdh WHERE maDH='.$value['maDH'].' ';
                                $ct = getData($sql);
                                foreach ($ct as $item) {
                                ?>
                                <div class="row border-top border-2">
                                    <div class="col-2"><?=$item['maSach']?></div>
                                    <div class="col-8"><?=$item['tenSach']?></div>
                                    <div class="col-2"><?=$item['solg']?></div>
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

        <div class="d-flex justify-content-between align-items-center mt-3">
            <i>Tổng số: <b><?=$totalRecords?></b> mục</i>
            <div>            
                <?php //Trang đầu
                if($current_page > 3) {
                    $first_page = 1;
                ?>
                <a href="?adpage=donhang/hienthi&page=<?=$first_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
                <?php } ?>
                
            
                <?php //Trang trước
                if($current_page > 1) {
                    $prev_page = $current_page-1;
                ?>
                <a href="?adpage=donhang/hienthi&page=<?=$prev_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                <?php } ?>
                
                
                <?php //Trang xung quanh
                for($num = 1; $num <= $totalPages; $num++) { 
                    if($num != $current_page) {
                        if($num > $current_page-3 && $num < $current_page+3) {
                ?>
                <a href="?adpage=donhang/hienthi&page=<?=$num?>" class="me-1 btn btn-sm btn-outline-primary"><?=$num?></a>
                <?php
                        } 
                    } else { 
                ?>
                <strong class="me-1 btn btn-sm btn-primary fw-bolder"><?=$num?></strong>
                <?php } } ?>
                
                
                <?php //Trang tiếp theo
                if($current_page < $totalPages) {
                    $next_page = $current_page+1;
                ?>
                <a href="?adpage=donhang/hienthi&page=<?=$next_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <?php } ?>

            
                <?php //Trang cuối
                if($current_page < $totalPages-3) {
                    $end_page = $totalPages;
                ?>
                <a href="?adpage=donhang/hienthi&page=<?=$end_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
                <?php } ?>
            </div>
        </div>

    </div>
</div>