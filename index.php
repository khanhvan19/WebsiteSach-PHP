<?php
include 'admin/connect/helpers.php';
session_start();
?>
<?php
    if( isset($_GET['logout']) && $_GET['logout']=="1" ){
        unset($_SESSION['name']);
        unset($_SESSION['avt']);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWorld</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- style.css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Jquery -->
    <script src="js/jQuery.js"></script>
</head>

<body>
    <?php include 'layout/header.php' ?>
    <?php include 'layout/content.php' ?>
    <?php include 'layout/footer.php' ?>
    <?php include 'layout/menucanvas.php' ?>
</body>


<!-- Bootstrap Popper-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<!--  -->
<script src="js/script.js"></script>

</html>