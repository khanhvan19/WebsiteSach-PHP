<?php

if(isset($_POST['checkout'])){
    $idkh = $_SESSION['idKH'];
    $sdt = $_POST['sdt'];
    $nguoimua = $_POST['buyer'];
    $diachi = $_POST['diachi'];
    $ghichu = $_POST['ghichu'];
    $giatri = $_POST['giatri'];

    //Thêm đơn hàng
    $sql = 'INSERT INTO donhang(maKH, giatri, tenNMua, sdt, diachi, ghichu ,sta) 
            VALUES ('.$idkh.', '.$giatri.', "'.$nguoimua.'", '.$sdt.', "'.$diachi.'", "'.$ghichu.'", "new") ';
    $query = mysqli_query($dbc,$sql);
    $maDH = mysqli_insert_id($dbc);

    foreach($_SESSION['cart'] as $item){  
        //Thêm chi tiết đơn hàng
        $sqlct = 'INSERT INTO chitietdh(maDH, maSach, solg, tenSach) 
            VALUES ('.$maDH.', '.$item['id'].', '.$item['qtt'].', "'.$item['name'].'") ';
        setData($sqlct);
        //Cập nhật số lượng sản phẩm còn lại
        $sql_qtt_sp = ' SELECT soLuong FROM sach WHERE maSach='.$item['id'].' ';
        $qtt_sp = getData($sql_qtt_sp);
        $rest = $qtt_sp[0]['soLuong'] - $item['qtt'];
        $sql_update_qtt = ' UPDATE sach SET soLuong='.$rest.' WHERE maSach='.$item['id'].' ';
        setData($sql_update_qtt);

    }
    unset($_SESSION['cart']);
    echo "<script> 
            window.location.href='?view=order/order'; 
        </script>";
}   


if(isset($_GET['action']) && $_GET['action']=="huy"){
    //Thay doi trang thai don hàng
    $sql = ' UPDATE donhang SET sta="cancer" WHERE maDH='.$_GET['iddh'].'  ';
    setData($sql);

    //Hoàn trả lại số lượng
    $sql_ctdh = 'SELECT maSach, solg FROM chitietdh WHERE maDH='.$_GET['iddh'].' ';
    $ctdh = getData($sql_ctdh);
    foreach($ctdh as $prod){
        $sql_qtt_sp = ' SELECT soLuong FROM sach WHERE maSach='.$prod['maSach'].' ';
        $qtt_sp = getData($sql_qtt_sp);
        $qtt = $qtt_sp[0]['soLuong'] + $prod['solg'];
        $sql_update_qtt = ' UPDATE sach SET soLuong='.$qtt.' WHERE maSach='.$prod['maSach'].' ';
        setData($sql_update_qtt);
    } 
    
    echo "
    <script> 
        alert('Đơn hàng đã bị hủy');
        window.location.href='?view=order/order';
    </script>
    ";
}

if(isset($_GET['action']) && $_GET['action']=="nhan"){
    $sql = ' UPDATE donhang SET sta="success" WHERE maDH='.$_GET['iddh'].'  ';
    setData($sql);
    echo "
    <script> 
        alert('Xác nhận nhận hàng thành công');
        window.location.href='?view=order/order';
    </script>
    ";
}


?>