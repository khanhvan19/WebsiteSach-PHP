<?php
$tenDM = $_POST['tenDM'];

if( isset($_POST['them']) ){
    $sql = 'INSERT INTO danhmuc(tenDM) VALUES ("' . $tenDM . '") ';
    setData($sql);
    echo "
        <script> 
            alert('Thêm danh mục thành công');
            window.location.href='index.php?adpage=danhmuc/hienthi';
        </script>
        ";
}

if( isset($_POST['sua']) ){
    $sql = 'UPDATE danhmuc SET tenDM="' . $tenDM . '" WHERE maDM="' . $_GET['id'] . '" ';
    setData($sql);
    echo "
        <script> 
            alert('Chỉnh sửa danh mục thành công');
            window.location.href='index.php?adpage=danhmuc/hienthi';
        </script>
        ";
}

if( isset($_GET['xoa']) && $_GET['xoa']=="xoa" ){
    $sql = 'DELETE FROM danhmuc WHERE maDM="' . $_GET['id'] . '" ';
    setData($sql);
    echo "
        <script> 
            alert('Xóa danh mục thành công');
            window.location.href='index.php?adpage=danhmuc/hienthi';
        </script>
        ";
}


?>