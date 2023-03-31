<main class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 d-lg-block d-none bg-white">
                <div class="p-3">
                    <ul class="flex-column ps-0">
                        <li class="mb-2"><a class="fw-600 fs-18px" href="?view=product/product">Tất cả sản phẩm</a></li>
                        <li class="mb-2"><a class="fw-600 fs-18px" href="?view=product/product&attr=sta&val=coming">Sắp phát hành</a></li>
                        <li class="mb-2"><a class="fw-600 fs-18px" href="?view=product/product&attr=sta&val=hot">Sản phẩm bán chạy</a></li>
                        <?php
                        $sql_dm = ' SELECT * FROM danhmuc ';
                        $get_dm = getData($sql_dm);
                        foreach ($get_dm as $danhmuc) {
                        ?>
                        <li class="mb-2 menu-item-collap position-relative">
                            <a class="fw-600 fs-18px" href="?view=product/product&attr=maDM&val=<?=$danhmuc['maDM']?>"><?=$danhmuc['tenDM']?></a>
                            <a class="collapsed menu-arrow" data-bs-toggle="collapse" href="#collapMenuProduct<?=$danhmuc['maDM']?>" aria-expanded="false" aria-controls="collapMenuProduct<?=$danhmuc['maDM']?>">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                            <ul class="ps-3 my-1 collapse" id="collapMenuProduct<?=$danhmuc['maDM']?>">
                                <?php 
                                $sql_loai = ' SELECT * FROM loaisach WHERE maDM=' . $danhmuc['maDM'] ;
                                $get_loai = getData($sql_loai);
                                foreach ($get_loai as $loai) {
                                ?>
                                <li><a href="?view=product/product&attr=maLoai&val=<?=$loai['maLoai']?>"><?=$loai['tenLoai']?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </div> 
            </div>
            
            <?php
            if(isset($_GET['attr'])) {
                if($_GET['attr']=="sta"){
                    $cond = ' WHERE s.soLuong>0 AND s.'.$_GET['attr'].'="'.$_GET['val'].'" ';
                } else{
                    $cond = ' WHERE s.soLuong>0 AND l.'.$_GET['attr'].'="'.$_GET['val'].'" ';
                }
            }else {
                if(isset( $_POST['type_search'
                
                
                ]) && isset($_POST['key_search']) ) {
                    $cond = ' WHERE s.soLuong>0 AND '.$_POST['type_search'].' LIKE "%'.$_POST['key_search'].'%" ';
                } else {
                    $cond = ' WHERE s.soLuong>0 ';
                }
            }

            $item_per_page = 16;
            $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($current_page - 1)*$item_per_page;
            $totalRecords = mysqli_query($dbc, "SELECT * FROM sach s JOIN loaisach l ON s.maLoai=l.maLoai {$cond}");
            $totalRecords = mysqli_num_rows($totalRecords);
            $totalPages = ceil($totalRecords / $item_per_page);
            ?>

            <div class="col-lg-9 ">
                <div class="row g-2">
                    <?php 
                    $sql = 'SELECT * FROM sach s JOIN loaisach l ON s.maLoai=l.maLoai
                            '.$cond.' ORDER BY maSach DESC 
                            LIMIT '.$item_per_page.' OFFSET '.$offset.' ';
                    getProduct($sql);
                    ?>
                </div>

                <nav class="d-flex justify-content-center mt-3">
                    <?php //Xử lý ulr
                    if(isset($_GET['attr'])){
                        $href = "?view=product/product&attr={$_GET['attr']}&val={$_GET['val']}";
                    } else {
                        $href = "?view=product/product";
                    }
                    ?>
                    
                    <?php //Trang đầu
                    if($current_page > 3) {
                        $first_page = 1;
                    ?>
                    <a href="<?=$href?>&page=<?=$first_page?>" class="me-1 btn btn-outline-success">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                    <?php } ?>
                    
                
                    <?php //Trang trước
                    if($current_page > 1) {
                        $prev_page = $current_page-1;
                    ?>
                    <a href="<?=$href?>&page=<?=$prev_page?>" class="me-1 btn btn-outline-success">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                    <?php } ?>
                    
                    
                    <?php //Trang xung quanh
                    for($num = 1; $num <= $totalPages; $num++) { 
                        if($num != $current_page) {
                            if($num > $current_page-3 && $num < $current_page+3) {
                    ?>
                    <a href="<?=$href?>&page=<?=$num?>" class="me-1 btn btn-outline-success"><?=$num?></a>
                    <?php
                            } 
                        } else { 
                    ?>
                    <strong class="me-1 btn btn-success fw-bolder"><?=$num?></strong>
                    <?php } } ?>
                    
                    
                    <?php //Trang tiếp theo
                    if($current_page < $totalPages) {
                        $next_page = $current_page+1;
                    ?>
                    <a href="<?=$href?>&page=<?=$next_page?>" class="me-1 btn btn-outline-success">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                    <?php } ?>

                
                    <?php //Trang cuối
                    if($current_page < $totalPages-3) {
                        $end_page = $totalPages;
                    ?>
                    <a href="<?=$href?>&page=<?=$end_page?>" class="me-1 btn btn-outline-success">
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                    <?php } ?>
                </nav>

            </div>
        </div>
    </div>

</main>
