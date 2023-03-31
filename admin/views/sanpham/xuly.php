<?php

$tenSach = $_POST['tenSach'];
$maLoai = $_POST['maLoai'];
$tenTG = $_POST['tenTG'];
$tenNXB = $_POST['tenNXB'];
$donGia = $_POST['donGia'];
$soLuong = $_POST['soLuong'];
$sta = $_POST['sta'];

$anhSach = basename($_FILES['anhSach']['name']);
$target_dir = "../img/sach/";
$target_file = $target_dir . $anhSach;

$namXB = $_POST['namXB'];
$ngonNgu = $_POST['ngonNgu'];
$trongLuong = $_POST['trongLuong'];
$kichThuoc = $_POST['kichThuoc'];
$soTrang = $_POST['soTrang'];
$hinhThuc = $_POST['hinhThuc'];
$baiViet = $_POST['baiViet'];

if( isset($_POST['them']) ){
    $sql = ' INSERT INTO sach(tenSach, anhSach, donGia, soLuong, tenTG, tenNXB, maLoai, sta) 
            VALUES("'.$tenSach.'", "'.$anhSach.'", '.$donGia.', '.$soLuong.', "'.$tenTG.'", "'.$tenNXB.'", '.$maLoai.', "'.$sta.'") ';
    $query = mysqli_query($dbc,$sql);
    $maSach = mysqli_insert_id($dbc);
    $sql_detail = ' INSERT INTO chitietsp VALUES('.$maSach.', "'.$namXB.'", "'.$ngonNgu.'", 
                    '.$trongLuong.', "'.$kichThuoc.'", '.$soTrang.', "'.$hinhThuc.'", "'.$baiViet.'") ';
    setData($sql_detail);

    move_uploaded_file($_FILES["anhSach"]["tmp_name"], $target_file);

    echo "
        <script> 
            alert('Thêm sản phẩm thành công');
            window.location.href='index.php?adpage=sanpham/hienthi';
        </script>
        ";
}

if( isset($_POST['sua']) ){
    $sql = 'UPDATE sach SET tenSach="'.$tenSach.'", anhSach="'.$anhSach.'", donGia='.$donGia.', soLuong='.$soLuong.',
            tenTG="'.$tenTG.'", tenNXB="'.$tenNXB.'", maLoai='.$maLoai.', sta="'.$sta.'" WHERE maSach='.$_GET['id'].' ';
    setData($sql);
    $sql_detail = ' UPDATE chitietsp SET namXB="'.$namXB.'", ngonNgu="'.$ngonNgu.'", trongLuong='.$trongLuong.', kichThuoc="'.$kichThuoc.'",
                    soTrang='.$soTrang.', hinhThuc="'.$hinhThuc.'", baiViet="'.$baiViet.'" WHERE maSach='.$_GET['id'].' ';
    setData($sql_detail);

    move_uploaded_file($_FILES["anhSach"]["tmp_name"], $target_file);

    echo "
        <script> 
            alert('Chỉnh sửa sản phẩm thành công');
            window.location.href='index.php?adpage=sanpham/hienthi';
        </script>
        ";
}

if( isset($_GET['xoa']) && $_GET['xoa']=="xoa" ){
    $sql = 'DELETE FROM sach WHERE maSach='.$_GET['id'].' ';
    setData($sql);
    echo "
        <script> 
            alert('Xóa 1 sản phẩm thành công');
            window.location.href='index.php?adpage=sanpham/hienthi';
        </script>
        ";
}



?>

