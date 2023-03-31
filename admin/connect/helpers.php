<?php
include 'connect.php';

$url = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'],'?'));
define('PARAM', $url);
?>

<?php
function setData($sql){
    include('connect.php');
    mysqli_set_charset($dbc, 'UTF8');
    mysqli_query($dbc, $sql);
    mysqli_close($dbc);
}
function getData($sql)
{
    include('connect.php');
    $data = array();
    if ($query = mysqli_query($dbc, $sql)) {
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
    }

    mysqli_close($dbc);
    return $data;
}

function getProduct($sql)
{
    $result = getData($sql);
    foreach ($result as $product) {
        echo '
        <div class="col-lg-3 col-sm-6 ">
            <div class="card card-product h-100">
                <a href="?view=product/detail&sp=' . $product['maSach'] . '" class="text-center p-2">
                    <img src="img/sach/' . $product['anhSach'] . '" class="card-img-top w-75 img-product">
                </a>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title product-name fs-18px">' . $product['tenSach'] . '</h5>
                    <p class="card-text text-success fst-italic fw-lighter">' . $product['tenTG'] . '</p>
                    <div class="mt-auto">
                        <strong class="text-danger fs-5">' . number_format($product['donGia']) . ' <span>đ</span></strong>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}


?>