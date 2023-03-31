<?php
$tenLoai = $_POST['tenLoai'];
$maDM = $_POST['maDM'];

if( isset($_POST['them']) ){
    $sql = 'INSERT INTO loaisach(tenLoai,maDM) VALUES ("'.$tenLoai.'", '.$maDM.') ';
    setData($sql);
    echo "
        <script> 
            alert('Thêm loại sách thành công');
            window.location.href='index.php?adpage=loaisp/hienthi';
        </script>
        ";
}

if( isset($_POST['sua']) ){
    $sql = 'UPDATE loaisach SET tenLoai="'.$tenLoai.'", maDM='.$maDM.' WHERE maLoai="' . $_GET['id'] . '" ';
    setData($sql);
    echo "
        <script> 
            alert('Chỉnh sửa loại sách thành công');
            window.location.href='index.php?adpage=loaisp/hienthi';
        </script>
        ";
}

if( isset($_GET['xoa']) && $_GET['xoa']=="xoa" ){
    $sql = 'DELETE FROM loaisach WHERE maLoai="'.$_GET['id'].'" ';
    setData($sql);
    echo "
        <script> 
            alert('Xóa loại sách thành công');
            window.location.href='index.php?adpage=loaisp/hienthi';
        </script>
        ";
}


?>