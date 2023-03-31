<div class="main py-2">
    <div class="row bg-white py-2 rounded-3">
        <div class="col-6 fs-4 fw-600">
            Quản lý sản phẩm
        </div>
        <form method="POST" class="col-6 d-flex">
            <select class="form-select border-2" name="search_type" style="width: 200px;">
                <option value="tenSach" selected>Tìm tên sách</option>
                <option value="tenLoai">Tìm thể loại</option>
                <option value="tenTG">Tìm Tác giả</option>
                <option value="tenNXB">Tìm NXB</option>
            </select>
            <input class="form-control form-control-sm border-2 me-1" type="text" name="search_key" placeholder="Search...">
            <button class="btn btn-sm btn-outline-success border-2" type="submit">Search</button>
        </form>
    </div>
    <div class="bg-white align-items-center my-2 p-2 rounded-3">
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên sách</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Tác Giả</th>
                    <th scope="col">NXB</th>
                    <th scope="col">Giá</th>
                    <th scope="col">SL</th>
                    <th scope="col">status</th>
                    <th scope="col" colspan="3" class="col-1">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if( isset($_POST['search_type']) && isset($_POST['search_key']) ){
                    $cond = ' WHERE '.$_POST['search_type'].' LIKE "%'.$_POST['search_key'].'%" ';
                } else {
                    $cond ='';
                }

                $item_per_page = 10;
                $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($current_page - 1)*$item_per_page;
                $totalRecords = mysqli_query($dbc, "SELECT * FROM sach s JOIN loaisach ls ON s.maLoai=ls.maLoai {$cond}");
                $totalRecords = mysqli_num_rows($totalRecords);
                $totalPages = ceil($totalRecords / $item_per_page);

                $query = '  SELECT * FROM sach s 
                            JOIN loaisach ls ON s.maLoai=ls.maLoai 
                            JOIN chitietsp c ON s.maSach=c.maSach
                            '.$cond.' ORDER BY s.maSach DESC
                            LIMIT '.$item_per_page.' OFFSET '.$offset.' ';
                $result = getData($query);
                foreach ($result as $key => $value) { ?>
                <tr>
                    <td class="text-center"><?=$value['maSach']?></td>
                    <td><img src="../img/sach/<?=$value['anhSach']?>" height="70px"></td>
                    <td><?=$value['tenSach']?></td>
                    <td><?=$value['tenLoai']?></td>
                    <td><?=$value['tenTG']?></td>
                    <td><?=$value['tenNXB']?></td>
                    <td><?=number_format($value['donGia'])?></td>
                    <td><?=$value['soLuong']?></td>
                    <td><?=$value['sta']?></td>
                    <td><a href="#" class="text-success fw-bold text-decoration-underline" data-bs-toggle="modal" data-bs-target="#detail<?=$value['maSach']?>">Chi tiết</a></td>
                    <td><a href="index.php?adpage=sanpham/sua&id=<?=$value['maSach']?>" class="text-warning fw-bold text-decoration-underline">Sửa</a></td>
                    <td><a href="index.php?adpage=sanpham/xuly&xoa=xoa&id=<?=$value['maSach']?>" class="text-danger fw-bold text-decoration-underline">Xóa</a></td>
                </tr>

                <div class="modal fade" id="detail<?=$value['maSach']?>" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success fw-bold" id="detailLabel">Chi tiết sản phẩm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><b>Năm xuất bản: </b><?=$value['namXB']?></p>
                                <p><b>Ngôn ngữ: </b><?=$value['ngonNgu']?></p>
                                <p><b>Trọng lượng: </b><?=$value['trongLuong']?> gram</p>
                                <p><b>Kích thước: </b><?=$value['kichThuoc']?></p>
                                <p><b>Số trang: </b><?=$value['soTrang']?> trang</p>
                                <p><b>Hình thức bìa: </b><?=$value['hinhThuc']?></p>
                                <p><b>Bài viết: </b><br><?=$value['baiViet']?></p>
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

        <nav class="d-flex justify-content-between align-items-center mt-3">
            <i>Tổng số: <b><?=$totalRecords?></b> mục</i>
            <div>            
                <?php //Trang đầu
                if($current_page > 3) {
                    $first_page = 1;
                ?>
                <a href="?adpage=sanpham/hienthi&page=<?=$first_page?>" class="me-1 btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
                <?php } ?>
                
            
                <?php //Trang trước
                if($current_page > 1) {
                    $prev_page = $current_page-1;
                ?>
                <a href="?adpage=sanpham/hienthi&page=<?=$prev_page?>" class="me-1 btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                <?php } ?>
                
                
                <?php //Trang xung quanh
                for($num = 1; $num <= $totalPages; $num++) { 
                    if($num != $current_page) {
                        if($num > $current_page-3 && $num < $current_page+3) {
                ?>
                <a href="?adpage=sanpham/hienthi&page=<?=$num?>" class="me-1 btn btn-outline-primary btn-sm"><?=$num?></a>
                <?php
                        } 
                    } else { 
                ?>
                <strong class="me-1 btn btn-primary btn-sm fw-bolder"><?=$num?></strong>
                <?php } } ?>
                
                
                <?php //Trang tiếp theo
                if($current_page < $totalPages) {
                    $next_page = $current_page+1;
                ?>
                <a href="?adpage=sanpham/hienthi&page=<?=$next_page?>" class="me-1 btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <?php } ?>

            
                <?php //Trang cuối
                if($current_page < $totalPages-3) {
                    $end_page = $totalPages;
                ?>
                <a href="?adpage=sanpham/hienthi&page=<?=$end_page?>" class="me-1 btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
                <?php } ?>
            </div>
        </nav>

    </div>
</div>
