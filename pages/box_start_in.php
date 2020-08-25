<?php
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
include('../pages/product_cfg.php');


$query=mysqli_query($con,"select box_id from box_info order by id desc limit 1")or die(mysqli_error($con));
$row=mysqli_fetch_array($query);
$box_id=$row['box_id'];
$run_no =  preg_replace("/[^0-9,.]/", "", $box_id);          
$next_run = ($run_no +1);
if(strlen($next_run)>=5){
  $next_box_id = "BEY" . $next_run;
}
else{
  $next_box_id = "BEY" . str_pad($next_run, (strlen($next_run)), '0', STR_PAD_LEFT);;
}

$allModelNo = get_modelNo2($con);
$allModelName = get_model_name($con);
$modelid = $_POST['model'];
$modelNo = $allModelNo[$modelid];
$modelName = $allModelName[$modelid];
$userid = $_SESSION['id'];
$tmstmp = time();
$line = $_POST['line'];
$qty = $_POST['qty'];

mysqli_query($con,"INSERT INTO box_info(box_id,user_id,qty,timestamp,model_no,model,line,status)
VALUES('$next_box_id','$userid', '$qty', '$tmstmp', '$modelNo', '$modelName','$line',0)")or die(mysqli_error($con));
$newid = mysqli_insert_id($con);
echo "<script>document.location='box_scan.php?id=$newid'</script>";  


















?>