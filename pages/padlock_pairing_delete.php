<?php
include('../dist/includes/dbcon.php');
$coresn = $_POST['coresn'];
$padlocksn = $_POST['padlocksn'];
$tmstmp_ori = $_POST['tmstmp_ori'];
$pswrd = md5($_POST['pswrd']);

$query=mysqli_query($con,"select password from user where user_id=18")or die(mysqli_error($con));
$row=mysqli_fetch_array($query);
$dbpswrd = $row['password'];

if($pswrd==$dbpswrd){
    $tmstmp = time();
    mysqli_query($con,"INSERT INTO nfc_padlock_deleted(core_sn,padlock_sn,timestamp,del_timestamp)VALUES('$coresn','$padlocksn','$tmstmp_ori','$tmstmp')")or die(mysqli_error($con));
    mysqli_query($con,"DELETE from nfc_padlock where core_sn='$coresn'")or die(mysqli_error($con));
    echo '<script type="text/javascript">alert("Data deleted!");</script>';
    echo "<script type='text/javascript'>document.location='sn_register.php'</script>"; 
}
else{
    echo '<script type="text/javascript">alert("Wrong password entered!");</script>';
    echo "<script>window.history.back();</script>"; 
}


?>