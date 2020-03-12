<?php

include('../dist/includes/dbcon.php');
include('product_cfg.php');

$t = tengok($con);
foreach($t as $key=>$value){
    echo "$key - $value <br>";
}
?>