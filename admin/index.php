<?php
    include './connect/helpers.php';
?>
<?php
    session_start();
    if(!isset( $_SESSION['adName'])){
        header('Location: adlogin.php');
    }
?>
<?php
    if( isset($_GET['logout']) && $_GET['logout']=="yes" ){
        unset($_SESSION['adName']);
        header('Location: adlogin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWorld Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Morris(bieu do) -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <link href="../css/style-admin.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'layout/menu.php'
    ?>
    <div class="right-content container-fluid">
        <?php
        include 'layout/header.php'
        ?>
        <?php
        if (isset($_GET['adpage'])) {
            $path = "views/" . $_GET['adpage'] . ".php";
        } else {
            $path = "views/dashboard.php";
        }
        //echo $path
        include $path;
        ?>
    </div>
</body>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js "></script>

<script >
        
</script>

</html>