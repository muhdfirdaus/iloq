<?php

include('../dist/includes/dbcon.php');

$pwbsn=$_POST['pwbsn'];
$coresn=$_POST['coresn'];

if(strlen($coresn)<8 || strlen($coresn)>8 || strlen($pwbsn)>20 || strlen($pwbsn)<20){
    echo '<script type="text/javascript">alert("Invalid SN length entered!");</script>';
    echo "<script>window.history.back();</script>"; 
}
else{
    $query=mysqli_query($con,"select count(*) as cnt from nfc_pairing where pwbsn='$pwbsn' or coresn='$coresn'")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
    if($row['cnt']!=0){
        echo '<script type="text/javascript">alert("SN already registered in the system!");</script>';
        echo "<script>window.history.back();</script>"; 
    }
    else{
        $tmstmp = time();
        mysqli_query($con,"INSERT INTO nfc_pairing(pwbsn,coresn,timestamp)VALUES('$pwbsn','$coresn','$tmstmp')")or die(mysqli_error($con));
        echo '<script type="text/javascript">alert("Data saved!");</script>';
        echo "<script type='text/javascript'>document.location='nfc_pairing.php'</script>"; 
    }
}











?>