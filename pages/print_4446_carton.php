<?php

include('../dist/includes/dbcon.php');

/*-------------------------------------------------------------------------------------------------------------
-Box Printing
*/

$model = $_POST['model'];
$qty = $_POST['qty'];
$weight = $_POST['weight'];
$tmstmp = time(); 
$lbldate = date('d/m/y',$tmstmp);
// $lblbox2 ="^XA
// ^CFP,180,120
// ^FO60,50^FDIQ-M004446-L-01^FS

// ^CFP,190,230
// ^FO38,280^FDQuantity: 63^FS

// ^CFP,180,180
// ^FO40,510^FD$lbldate^FS

// ^XZ";


// //function to print second label
// $filename = "lbliloq4446.txt";
// $file = fopen($filename, "r+")or die("ERROR: Cannot open the file .")  ;
// if($file){
//     fwrite($file, $lblbox2);      
//     fclose($file);
// } 

// //print second label
// copy($filename, "//BTS-iLOQ-1/iloqpizza"); 

/*-------------------------------------------------------------------------------------------------------------
-Carton Printing
*/
$lblbox = '^XA
^FWR
^FX horizontal line
^FO1830,3^GB9,3635,3^FS
^FX vertical line
^FO1835,2150^GB710,9,3^FS

^CF0,153
^FO2000,170^FDFrom:^FS
^FO2000,2310^FDTo:^FS

^CF0,80
^FO2250,730^FDBeyonics Precision^FS
^FO2150,730^FDNo. 95, Jalan i-Park 1/10,^FS
^FO2050,730^FDKawasan Perindustrian i-Park,^FS
^FO1950,730^FDBandar Indahpura,^FS
^FO1850,730^FD81000 Kulai. Malaysia^FS

^FO2200,2690^FDILOQ^FS
^FO2100,2690^FDYrttipellontie^FS
^FO2000,2690^FD90230 Oulu^FS
^FO1900,2690^FDFinland^FS

^CF0,140
^FO1570,170^FD(P) Customer Product IDs:^FS
^FO1570,2310^FD(Q) Qty:^FS
^FO1360,170^FD'.$model.'^FS
^FO1360,2430^FD'.$qty.'^FS

^BY5.5,3
^FO1150,170^BCR,180,N^FDP'.$model.'^FS
^FO1150,2310^BCR,180,N^FDQ'.$qty.'^FS

^FX horizontal line
^FO1080,3^GB9,3635,3^FS

^CF0,150
^FO820,170^FD'.$model.'^FS
^FO610,170^FDDate: '.$lbldate.'^FS

^FO610,2310^FDWeight:  '.$weight.'KG^FS

^FX horizontal line
^FO550,3^GB9,3635,3^FS



^FX horizontal line
^FO165,3^GB9,3635,3^FS

^XZ';
$query=mysqli_query($con,"select ip from printer_cfg where name='Carton1'")or die(mysqli_error($con));
$row=mysqli_fetch_array($query);
$ip=$row['ip'];

// function to ping ip address
function pingAddress($ip1) {
    $pingresult = exec("ping -n 2 $ip1", $outcome, $status);
    if (0 == $status) {//status-alive
        $toReturn = true;
    } else {//status-dead
        $toReturn = false;
    }
    return $toReturn;
}

$printable = pingAddress($ip);
if($printable){
    try//attempt to print label
    {
        // Number of seconds to wait for a response from remote host
        $timeout = 2;
        if($fp=@fsockopen($ip,9100, $errNo, $errStr, $timeout)){
            fputs($fp,$lblbox);
            fclose($fp);				
            echo '<script type="text/javascript">alert("Label printed successfully!");</script>';
            echo "<script type='text/javascript'>document.location='box_start.php'</script>"; 
        }
        else{
            echo '<script type="text/javascript">alert("Printer is not available!");</script>';
            echo "<script type='text/javascript'>document.location='box_start.php'</script>";  
        } 
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
else{
    echo '<script type="text/javascript">alert("Printer is not available!");</script>';
    echo "<script type='text/javascript'>document.location='box_start.php'</script>";  
}


?>