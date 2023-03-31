<?php
    $available = 0;
    if(isset($_POST['user'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $avt = basename($_FILES['file']['name']);
        $target_dir = "img/user/";
        $target_file = $target_dir . $avt;

        $sql = ' SELECT * FROM khachhang WHERE taikhoan ="'.$user.'" ';
        $result = getData($sql);
        if($result != false){
            $available = 1;
        } else {
            $sql = 'INSERT INTO khachhang(hoten, avatar, taikhoan, matkhau, email, sdt) 
                    VALUES ("'.$name.'", "'.$avt.'", "'.$user.'", "'.$pass.'", "'.$email.'","'.$sdt.'") ';
            setData($sql);

            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

            echo "<script> window.location.href='?view=auth/login'; </script>";
        }
   }

?>
<main class="py-3">
    <div class="container">
        <div class="mx-auto p-3 border rounded-3 bg-white" style="max-width: 400px;">
            <h3 class="border-2 border-bottom fw-bolder text-uppercase text-success py-2">Đăng ký</h3>
            <?php
            if($available == 1){
            ?>
            <div class="alert alert-danger" role="alert">
                Tài khoản đã tồn tại! Vui lòng chọn tên đăng nhập khác!
            </div>
            <?php } ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="control-label">Họ tên</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Họ tên" value="<?=isset($name)?$name:''?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="example@gmail.com" value="<?=isset($email)?$email:''?>">
                </div>
                <div class="mb-3">
                    <label for="sdt" class="control-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" name="sdt" pattern="\d{10,11}" required placeholder="SĐT có 10 hoặc 11 số" title="Số điện thoại có 10 hoặc 11 số" value="<?=isset($sdt)?$sdt:''?>">
                </div>
                <div class="mb-3">
                    <label for="user" class="control-label">Tài khoản</label>
                    <input type="text" class="form-control" id="user" name="user" required placeholder="Tài khoản" >
                </div>
                <div class="mb-3">
                    <label for="pass" class="control-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="pass" name="pass" pattern=".{8,}" required placeholder="Mật khẩu nhiều hơn 8 ký tự" title="Mật khẩu nhiều hơn 8 ký tự">
                </div>
                <div class="mb-3">
                    <label for="repass" class="control-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="repass" required placeholder="Nhập lại mật khẩu" oninput="
                        if(value!=pass.value){
                            document.getElementById('checkpass').innerHTML='Nhập lại mật khẩu không đúng!';
                        } else {
                            document.getElementById('checkpass').innerHTML='';
                        }"
                    >
                    <small id="checkpass" class="text-danger"></small> 
                </div>
                <div class="mb-3">
                    <label for="formFile" class="control-label">Hình đại diện</label>
                    <input class="form-control" type="file" id="file" name="file" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="check" checked>
                    <label class="form-check-label" for="check">
                        Tôi đồng ý với <a href="#" class="text-primary d-sm-inline d-block"> Chính sách và Điều khoản</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-success w-100">Đăng ký</button>
                <h6 class="mt-3">Đã có tài khoản?<a href="?view=auth/login" class="text-primary d-sm-inline d-block"> Đăng nhập tại đây!</a></h6>
            </form>
        </div>
    </div>
</main>
