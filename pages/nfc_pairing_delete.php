<?php
include('../dist/includes/dbcon.php');
$coresn = $_POST['coresn'];
$pwbsn = $_POST['pwbsn'];
$tmstmp_ori = $_POST['tmstmp_ori'];
$pswrd = md5($_POST['pswrd']);

$query=mysqli_query($con,"select password from user where user_id=18")or die(mysqli_error($con));
$row=mysqli_fetch_array($query);
$dbpswrd = $row['password'];

if($pswrd==$dbpswrd){
    $tmstmp = time();
    mysqli_query($con,"INSERT INTO nfc_pairing_deleted(coresn,pwbsn,timestamp,del_timestamp)VALUES('$coresn','$pwbsn','$tmstmp_ori','$tmstmp')")or die(mysqli_error($con));
    mysqli_query($con,"DELETE from nfc_pairing where pwbsn='$pwbsn'")or die(mysqli_error($con));
    echo '<script type="text/javascript">alert("Data deleted!");</script>';
    echo "<script type='text/javascript'>document.location='nfc_pairing.php'</script>"; 
}
else{
    echo '<script type="text/javascript">alert("Wrong password entered!");</script>';
    echo "<script>window.history.back();</script>"; 
}


?>