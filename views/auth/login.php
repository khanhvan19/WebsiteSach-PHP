<?php
$fail = 0;
if ( isset($_POST['user']) ) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (!(empty($user) || empty($pass))) {
        $query = 'SELECT * FROM khachhang WHERE taikhoan ="'.$user.'" AND matkhau = "'.$pass.'" LIMIT 1';
        $result = getData($query);

        if ($result != false) {
            $_SESSION['idKH'] = $result[0]['maKH'];
            $_SESSION['name'] = $result[0]['hoten'];
            $_SESSION['avt'] = $result[0]['avatar'];
            if(isset($_GET['action']) && $_GET['action']=='cart'){
                echo "<script> window.location.href='?view=order/cart'; </script>";
            } else 
                echo "<script> window.location.href='index.php'; </script>";
            //header('Location:index.php');
        } else {
            $fail = 1;
        }
    }
}
?>
<main class="py-3">
    <div class="container">
        <div class="mx-auto p-3 border rounded-3 bg-white" style="max-width: 400px;">
            <h3 class="border-2 border-bottom fw-bolder text-uppercase text-success py-2">Đăng Nhập</h3>
            <?php
            if($fail == 1){
            ?>
            <div class="alert alert-danger" role="alert">
                Tài khoản hoặc mật khẩu không đúng!
            </div>
            <?php } ?>
            <form method="post">
                <div class="mb-3">
                    <label for="user" class="control-label">Tài khoản</label>
                    <input type="text" class="form-control" id="user" name="user" required placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="pass" class="control-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="pass" name="pass" required placeholder="Password">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="check" checked>
                    <label class="form-check-label" for="check">Ghi nhớ tôi</label>
                </div>
                <button type="submit" class="btn btn-success">Đăng nhập</button>
                <button type="reset" class="btn btn-secondary">Hủy</button>
                <h6 class="mt-3">Bạn chưa có tài khoản?<a href="?view=auth/registration" class="text-primary d-sm-inline d-block"> Đăng ký ngay!</a></h6>
            </form>
        </div>
    </div>
</main>