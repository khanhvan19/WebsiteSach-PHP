<div class="main py-2">
    <div class="bg-white p-2 rounded-3 fs-4 fw-600">
        Quản lý loại sản phẩm
    </div>
    <div class="bg-white mt-2 p-2 rounded-3">
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary text-center">
                    <th scope="col" class="col-1">ID</th>
                    <th scope="col">Tên loại</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col" colspan="2" class="col-1">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $item_per_page = 15;
                $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($current_page - 1)*$item_per_page;
                $totalRecords = mysqli_query($dbc, "SELECT * FROM loaisach ");
                $totalRecords = mysqli_num_rows($totalRecords);
                $totalPages = ceil($totalRecords / $item_per_page);

                $query = '  SELECT * FROM loaisach JOIN danhmuc ON loaisach.maDM=danhmuc.maDM 
                            ORDER BY maLoai DESC LIMIT '.$item_per_page.' OFFSET '.$offset.' ';
                $result = getData($query);
                foreach ($result as $value) {
                ?>
                <tr>
                    <td class="text-center"><?=$value['maLoai']?></td>
                    <td><?=$value['tenLoai']?></td>
                    <td><?=$value['tenDM']?></td>
                    <td><a href="index.php?adpage=loaisp/sua&id=<?=$value['maLoai']?>" class="text-warning fw-bold text-decoration-underline">Sửa</a></td>
                    <td><a href="index.php?adpage=loaisp/xuly&xoa=xoa&id=<?=$value['maLoai']?>" class="text-danger fw-bold text-decoration-underline">Xóa</i></a></td>
                </tr>
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
                <a href="?adpage=loaisp/hienthi&page=<?=$first_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
                <?php } ?>
                
            
                <?php //Trang trước
                if($current_page > 1) {
                    $prev_page = $current_page-1;
                ?>
                <a href="?adpage=loaisp/hienthi&page=<?=$prev_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                <?php } ?>
                
                
                <?php //Trang xung quanh
                for($num = 1; $num <= $totalPages; $num++) { 
                    if($num != $current_page) {
                        if($num > $current_page-3 && $num < $current_page+3) {
                ?>
                <a href="?adpage=loaisp/hienthi&page=<?=$num?>" class="me-1 btn btn-sm btn-outline-primary"><?=$num?></a>
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
                <a href="?adpage=loaisp/hienthi&page=<?=$next_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <?php } ?>

            
                <?php //Trang cuối
                if($current_page < $totalPages-3) {
                    $end_page = $totalPages;
                ?>
                <a href="?adpage=loaisp/hienthi&page=<?=$end_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>