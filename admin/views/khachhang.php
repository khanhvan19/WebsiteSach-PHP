<div class="main py-2">
    <div class="bg-white p-2 rounded-3 fs-4 fw-600">
        Quản lý khách hàng
    </div>
    <div class="bg-white mt-2 p-2 rounded-3">
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary text-center">
                    <th scope="col">Mã KH</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Tài khoản</th>
                    <th scope="col">Mật khẩu</th>
                    <th scope="col">Email</th>
                    <th scope="col">SĐT</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $item_per_page = 15;
                $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($current_page - 1)*$item_per_page;
                $totalRecords = mysqli_query($dbc, "SELECT * FROM khachhang ");
                $totalRecords = mysqli_num_rows($totalRecords);
                $totalPages = ceil($totalRecords / $item_per_page);

                $sql = ' SELECT * FROM khachhang LIMIT '.$item_per_page.' OFFSET '.$offset.'';
                $result = getData($sql);
                foreach($result as $item) {
                ?>
                <tr>
                    <td class="text-center"><?=$item['maKH']?></td>
                    <td><img src="../img/user/<?=$item['avatar']?>" height="50px"></td>
                    <td><?=$item['hoten']?></td>
                    <td><?=$item['taikhoan']?></td>
                    <td><?=$item['matkhau']?></td>
                    <td><?=$item['email']?></td>
                    <td class="text-center"><?=$item['sdt']?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <i>Tổng số <b><?=$totalRecords?></b> mục</i>
            <div>            
                <?php //Trang đầu
                if($current_page > 3) {
                    $first_page = 1;
                ?>
                <a href="?adpage=khachhang/hienthi&page=<?=$first_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
                <?php } ?>
                
            
                <?php //Trang trước
                if($current_page > 1) {
                    $prev_page = $current_page-1;
                ?>
                <a href="?adpage=khachhang/hienthi&page=<?=$prev_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                <?php } ?>
                
                
                <?php //Trang xung quanh
                for($num = 1; $num <= $totalPages; $num++) { 
                    if($num != $current_page) {
                        if($num > $current_page-3 && $num < $current_page+3) {
                ?>
                <a href="?adpage=khachhang/hienthi&page=<?=$num?>" class="me-1 btn btn-sm btn-outline-primary"><?=$num?></a>
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
                <a href="?adpage=khachhang/hienthi&page=<?=$next_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <?php } ?>

            
                <?php //Trang cuối
                if($current_page < $totalPages-3) {
                    $end_page = $totalPages;
                ?>
                <a href="?adpage=khachhang/hienthi&page=<?=$end_page?>" class="me-1 btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
                <?php } ?>
            </div>
        </div>

    </div>
</div>