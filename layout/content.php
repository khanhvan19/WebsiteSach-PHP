<?php
if (isset($_GET['view'])) {
    $path = "views/" . $_GET['view'] . ".php";
} else {
    $path = "views/home/home.php";
}
include $path;
?>