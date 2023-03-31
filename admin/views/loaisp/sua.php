<?php
$sql_dm = ' SELECT * FROM danhmuc ';
$danhmuc = getData($sql_dm);
$sql_loai = ' SELECT * FROM loaisach WHERE maLoai="' . $_GET['id'] . '" ';
$loai = getData($sql_loai);
?>

<div class="main py-2">
    <div class="bg-white p-2 rounded-3 fs-4 fw-600">
        Chỉnh sửa loại sản phẩm
    </div>
    <div class="bg-white mt-2 p-2 rounded-3">
        <form method="POST" action="index.php?adpage=loaisp/xuly&id=<?=$_GET['id']?>" style="width: 450px;" class="mx-auto">
            <div class="mb-3">
                <label for="tenLoai" class="form-label fw-600">Tên loại sách</label>
                <input type="text" class="form-control" id="tenLoai" name="tenLoai" value="<?=$loai[0]['tenLoai']?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-600">Danh mục</label>
                <select class="form-select" name="maDM">

                <?php foreach ($danhmuc as $item) { 
                    if($item['maDM'] == $loai[0]['maDM']){
                ?>
                    <option selected value="<?=$item['maDM']?>"><?=$item['tenDM']?></option>
                <?php } else { ?> 
                    <option value="<?=$item['maDM']?>"><?=$item['tenDM']?></option>
                <?php } } ?>

                </select>
            </div>
            <div class="mb-3">
                <button type="submit" name="sua" class="btn btn-success w-100">Sửa loại sản phẩm</button>
            </div>
        </form>
    </div>
</div>

