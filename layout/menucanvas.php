<!-- Menu Canvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="menuCanvas">
    <div class="offcanvas-header border-bottom border-2">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">
            <i class="fa-solid fa-bars-staggered"></i> Danh mục sản phẩm
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="flex-column">
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
                <a class="collapsed menu-arrow" data-bs-toggle="collapse" href="#collap<?=$danhmuc['maDM'] ?>" aria-expanded="false" aria-controls="collap<?=$danhmuc['maDM'] ?>">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <ul class="ps-3 my-1 collapse" id="collap<?=$danhmuc['maDM']?>">
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