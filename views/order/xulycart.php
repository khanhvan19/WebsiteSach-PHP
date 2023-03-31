<?php
    //Thêm giỏ hàng
    if(isset( $_GET['action']) && $_GET['action']=="addCart" ){
        $id = $_GET['id'];
        $sql = "SELECT * FROM sach WHERE maSach = $id";
        $product = getData($sql);
        $item = [
            'id'=>$product[0]['maSach'],
            'name'=>$product[0]['tenSach'],
            'img'=>$product[0]['anhSach'],
            'price'=>$product[0]['donGia'],
            'qtt'=> 1
            
        ];
        if( isset($_SESSION['cart'][$id])){
            if($_SESSION['cart'][$id]['qtt']<$product[0]['soLuong'] ){
                $_SESSION['cart'][$id]['qtt'] += 1;
            }
        } else {
            $_SESSION['cart'][$id] = $item;
        }
        echo "<script> window.location.href='?view=order/cart'; </script>";
    }

    
    if(isset($_POST['updateQtt'])){
        $idsp = $_POST['id'];
        $num = $_POST['num'];
        $_SESSION['cart'][$idsp]['qtt'] = $num;
        echo "<script> window.location.href='?view=order/cart'; </script>";
    }

    if( isset($_GET['delete'])){
        unset($_SESSION['cart'][$_GET['delete']]);
        echo "<script> window.location.href='?view=order/cart'; </script>";
    }
?>