<?php

include('../dist/includes/dbcon.php');

$padlocksn=$_POST['padlocksn'];
$coresn=$_POST['coresn'];

if(strlen($padlocksn)<8 || strlen($coresn)<8){
    echo '<script type="text/javascript">alert("Invalid SN length entered!");</script>';
    echo "<script>window.history.back();</script>"; 
}
else{
    $query=mysqli_query($con,"select count(*) as cnt from nfc_padlock where padlock_sn='$padlocksn' or core_sn='$coresn'")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
    if($row['cnt']!=0){
        echo '<script type="text/javascript">alert("SN already registered in the system!");</script>';
        echo "<script>window.history.back();</script>"; 
    }
    else{
        $tmstmp = time();
        mysqli_query($con,"INSERT INTO nfc_padlock(padlock_sn,core_sn,timestamp)VALUES('$padlocksn','$coresn','$tmstmp')")or die(mysqli_error($con));
        echo '<script type="text/javascript">alert("Data saved!");</script>';
        echo "<script>window.history.back();</script>"; 
    }
}











?>