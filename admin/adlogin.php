<?php
    include './connect/helpers.php';
?>
<?php
    session_start();
    $login_fail = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adUser = $_POST['adUser'];
        $adPass = $_POST['adPass'];

        if( !(empty($adUser)||empty($adPass)) ){
            $query = "SELECT * FROM `admin` WHERE `adUser` = '$adUser' AND `adPass` = '$adPass' LIMIT 1";
            $result = getData($query);

            if($result != false){
                $_SESSION['adName'] = $result[0]['adName'];
                $_SESSION['avatar'] = $result[0]['avatar'];
                header('Location:index.php');
            } else {
                $GLOBALS['login_fail'] = 1;
            }


            
        }    
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/style-admin.css" rel="stylesheet">
</head>

<body class="body_adlogin">
    <div class="container ad_login px-5 mt-4">
        <form action="adlogin.php" method="post" class="row">
            <h3 class="text-center text-success mb-0">ADMIN LOGIN</h3>
            <hr class="mt-2 mb-3">

            <div class="col-12 mb-2">
                <input type="text" required name="adUser" class="form-control" placeholder="Username" aria-label="Username">
            </div>
            <div class="col-12 mb-2">
                <input type="password" required name="adPass" class="form-control" placeholder="Password" aria-label="Password">
            </div>
            <div class="col-12 mb-2">
                <?php
                if ($login_fail == 1) {
                    echo '<span class="text-danger mb-2">Tài khoản hoặc mật khẩu không đúng</span>';
                } else {
                    echo '<input type="checkbox" required class="form-check-input" id="checkRobot">
                          <label class="ms-1" for="checkRobot">Tôi không phải người máy</label>';
                };
                ?>
            </div>
            <div class="col-12">
                <input type="submit" value="Đăng nhập" class="btn btn-outline-success w-100 fw-bold">
            </div>

            <hr class="mt-3 mb-2">
            <p class="text-center fst-italic fw-light">BOWO bookstore</p>
        </form>
    </div>
</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</html>