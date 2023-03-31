<?php
$sql = ' SELECT * FROM danhmuc ';
$result = getData($sql);
?>

<div class="main py-2">
    <div class="bg-white p-2 rounded-3 fs-4 fw-600">
        Thêm loại sản phẩm
    </div>
    <div class="bg-white mt-2 p-2 rounded-3">
        <form method="POST" action="index.php?adpage=loaisp/xuly" style="width: 450px;" class="mx-auto">
            <div class="mb-3">
                <label for="tenLoai" class="form-label fw-600">Tên loại sách</label>
                <input type="text" class="form-control" id="tenLoai" name="tenLoai" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-600">Danh mục</label>
                <select class="form-select" name="maDM">
                <?php foreach ($result as $item) { ?>
                    <option value="<?=$item['maDM']?>"><?=$item['tenDM']?></option>
                <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" name="them" class="btn btn-primary w-100">Thêm loại sản phẩm</button>
            </div>
        </form>
    </div>
</div>

