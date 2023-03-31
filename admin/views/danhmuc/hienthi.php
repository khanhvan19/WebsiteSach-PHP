<div class="main py-2">
    <div class="bg-white p-2 rounded-3 fs-4 fw-600">
        Quản lý danh mục sản phẩm
    </div>
    <div class="bg-white mt-2 p-2 rounded-3">
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary text-center">
                    <th scope="col" class="col-1">ID</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col" colspan="2" class="col-1">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM `danhmuc` ORDER BY `maDM` DESC";
                $result = getData($query);
                foreach ($result as $key => $value){
                ?>
                <tr>
                    <td class="text-center"><?=$value['maDM']?></td>
                    <td><?=$value['tenDM']?></td>
                    <td><a href="index.php?adpage=danhmuc/sua&id=<?=$value['maDM']?>" class="text-warning fw-bold text-decoration-underline">Sửa</a></td>
                    <td><a href="index.php?adpage=danhmuc/xuly&xoa=xoa&id=<?=$value['maDM']?>" class="text-danger fw-bold text-decoration-underline">Xóa</i></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>