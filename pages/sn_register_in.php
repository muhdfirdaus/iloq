<?php

include('../dist/includes/dbcon.php');

$pwbsn=$_POST['pwbsn'];
$locksn=$_POST['locksn'];

if(strlen($locksn)<8 || strlen($pwbsn)>25){
    echo '<script type="text/javascript">alert("Invalid SN length entered!");</script>';
    echo "<script>window.history.back();</script>"; 
}
else{
    $query=mysqli_query($con,"select count(*) as cnt from sn_register where pwbsn='$pwbsn' or locksn='$locksn'")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
    if($row['cnt']!=0){
        echo '<script type="text/javascript">alert("SN already registered in the system!");</script>';
        echo "<script>window.history.back();</script>"; 
    }
    else{
        $tmstmp = time();
        mysqli_query($con,"INSERT INTO sn_register(pwbsn,locksn,timestamp)VALUES('$pwbsn','$locksn','$tmstmp')")or die(mysqli_error($con));
        echo '<script type="text/javascript">alert("Data saved!");</script>';
        echo "<script>window.history.back();</script>"; 
    }
}











?>