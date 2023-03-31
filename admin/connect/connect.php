<?php
    $dbc = mysqli_connect('localhost','root','','bowo');

    if (!$dbc) {
      //echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    mysqli_set_charset($dbc, 'utf8');
?>