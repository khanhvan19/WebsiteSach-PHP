<?php
$sql = ' SELECT * FROM loaisach l JOIN danhmuc d ON l.maDM=d.maDM';
$result = getData($sql);
?>

<div class="main py-2">
    <div class="bg-white p-2 rounded-3 fs-4 fw-600">
        Thêm sản phẩm
    </div>
    <div class="bg-white mt-2 p-2 rounded-3">
        <form method="POST" action="?adpage=sanpham/xuly" enctype="multipart/form-data" style="width: 450px;" class="mx-auto">
            <h5 class="text-center border-top border-bottom border-2 py-1 text-success" >Thông tin sản phẩm</h5>
            <div class="mb-3">
                <label for="tenSach" class="form-label fw-600">Tên sách</label>
                <input type="text" class="form-control" id="tenSach" name="tenSach" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-600">Loại sách</label>
                <select class="form-select" name="maLoai">
                <?php foreach ($result as $item) { ?>
                    <option value="<?=$item['maLoai']?>"><?=$item['tenLoai']?> ( <?=$item['tenDM']?> )</option>
                <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tenTG" class="form-label fw-600">Tên tác giả</label>
                <input type="text" class="form-control" id="tenTG" name="tenTG" required>
            </div>
            <div class="mb-3">
                <label for="tenNXB" class="form-label fw-600">Nhà xuất bản</label>
                <input type="text" class="form-control" id="tenNXB" name="tenNXB" required>
            </div>
            <div class="mb-3">
                <label for="donGia" class="form-label fw-600">Đơn giá (VNĐ)</label>
                <input type="text" class="form-control" id="donGia" name="donGia" required>
            </div>
            <div class="mb-3">
                <label for="soLuong" class="form-label fw-600">Số lượng (quyển)</label>
                <input type="text" class="form-control" id="soLuong" name="soLuong" required>
            </div>
            <div class="mb-3">
                <label for="anhSach" class="form-label fw-600">Ảnh sách</label>
                <input type="file" class="form-control" id="anhSach" name="anhSach" required>
            </div>
            <div class="mb-3">
                <label for="sta" class="form-label fw-600">Trạng thái</label>
                <select class="form-select" id="sta" name="sta">
                    <option value="default" selected>Mặc định</option>
                    <option value="hot">Sản phẩm Hot</option>
                    <option value="coming">Sắp phát hành</option>
                </select>
            </div>

            <h5 class="text-center border-top border-bottom border-2 py-1 mb-3 text-success">Thông tin chi tiết</h5>
            
            <div class="mb-3">
                <label for="namXB" class="form-label fw-600">Năm xuất bản</label>
                <input type="text" class="form-control" id="namXB" name="namXB" required>
            </div>
            <div class="mb-3">
                <label for="ngonNgu" class="form-label fw-600">Ngôn ngữ</label>
                <input type="text" class="form-control" id="ngonNgu" name="ngonNgu" required>
            </div>
            <div class="mb-3">
                <label for="trongLuong" class="form-label fw-600">Trọng Lượng (gram)</label>
                <input type="text" class="form-control" id="trongLuong" name="trongLuong" required>
            </div>
            <div class="mb-3">
                <label for="kichThuoc" class="form-label fw-600">Kích thước</label>
                <input type="text" class="form-control" id="kichThuoc" name="kichThuoc" required>
            </div>
            <div class="mb-3">
                <label for="soTrang" class="form-label fw-600">Số trang (trang)</label>
                <input type="text" class="form-control" id="soTrang" name="soTrang" required>
            </div>
            <div class="mb-3">
                <label for="hinhThuc" class="form-label fw-600">Hình thức bìa</label>
                <input type="text" class="form-control" id="hinhThuc" name="hinhThuc" required>
            </div>
            <div class="mb-4">
                <label for="baiViet" class="form-label fw-600">Bài viết</label>
                <textarea class="form-control" id="baiViet" name="baiViet" rows="3" required></textarea>
            </div>
            
            <div class="mb-3">
                <button type="submit" name="them" class="btn btn-primary w-100">Thêm sản phẩm</button>
            </div>
        </form>
    </div>
</div>

