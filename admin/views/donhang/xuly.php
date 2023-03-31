<?php
if(isset($_GET['iddh'])){
    $sql = ' UPDATE donhang SET sta="dilivery" WHERE maDH="'.$_GET['iddh'].'"  ';
    setData($sql);
    echo "
    <script> 
        alert('Cập nhật trạng thái đơn hàng thành công');
        window.location.href='index.php?adpage=donhang/hienthi';
    </script>
    ";
}
?>