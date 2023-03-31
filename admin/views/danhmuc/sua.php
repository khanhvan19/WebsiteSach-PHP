<?php
$sql = ' SELECT * FROM danhmuc WHERE maDM="' . $_GET['id'] . '" ';
$result = getData($sql);
?>

<div class="main py-2">
    <div class="bg-white p-2 rounded-3 fs-4 fw-600">
        Sửa danh mục sản phẩm
    </div>
    <div class="bg-white mt-2 p-2 rounded-3">
        <form method="POST" action="index.php?adpage=danhmuc/xuly&id=<?=$_GET['id']?>" style="width: 450px;" class="mx-auto">
            <div class="mb-3">
                <label for="tenDM" class="form-label fw-600">Tên danh mục</label>
                <input type="text" class="form-control" id="tenDM" name="tenDM" value="<?=$result[0]['tenDM']?>" required>
            </div>
            <div class="mb-3">
                <button type="submit" name="sua" class="btn btn-success w-100">Sửa danh mục</button>
            </div>
        </form>
    </div>
</div>