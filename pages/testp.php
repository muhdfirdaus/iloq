<?php 

// Use ls command to shell_exec 
// function 
// shell_exec('cd C:/'); 
// $output = exec('copy /B C:/lbl.zpl LPT2'); 
// $output = exec('copy /B lbl.zpl lpt2');
// $output =exec("lp -d lpt2 lbl.zpl");

// Display the list of all file 
// and directory 
// echo "<pre>$output</pre>"; 

$file="lbl2.txt";
copy($file, "//itmis-firdaus/s621z");


/*
$ip = '10.38.16.200';
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
        ^FO2150,730^FDNo. 93, Jalan i-Park 1/10,^FS
        ^FO2050,730^FDKawasan Perindustrian i-Park,^FS
        ^FO1950,730^FDBandar Indahpura,^FS
        ^FO1850,730^FD8100 Kulai. Malaysia^FS
        
        ^FO2200,2690^FDILOQ^FS
        ^FO2100,2690^FDYrttipellontie^FS
        ^FO2000,2690^FD90230 Oulu^FS
        ^FO1900,2690^FDFinland^FS
        
        ^CF0,140
        ^FO1570,170^FD(P) Customer Product IDs:^FS
        ^FO1570,2310^FD(Q) Qty:^FS
        ^FO1360,170^FD$lblcode^FS
        ^FO1360,2430^FD$qty^FS
        
        ^BY5.5,3
        ^FO1150,170^BCR,180,N^FDP$lblcode^FS
        ^FO1150,2310^BCR,180,N^FDQ$qty^FS
        
        ^FX horizontal line
        ^FO1080,3^GB9,3635,3^FS
        
        ^CF0,150
        ^FO820,170^FD$lblcode2^FS
        ^FO610,170^FDDate: $lbldate^FS
        
        ^FO820,2310^FDWeight:  $weight^FS
        
        ^FX horizontal line
        ^FO550,3^GB9,3635,3^FS
        
        ^CF0,130
        ^FO295,170^FDPALLET ID:^FS
        ^CF0,140
        ^FO290,1000^FD$carton_id^FS
        
        ^BY5.5,3
        ^FO260,2310^BCR,180,N^FD$carton_id^FS
        
        ^FX horizontal line
        ^FO165,3^GB9,3635,3^FS
        
        ^XZ';
        $tt = "asdasd";

        //function to ping ip address
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
                if($fp=@fsockopen($ip,515, $errNo, $errStr, $timeout)){
                    fputs($fp,$tt);
                    fclose($fp);				
                    echo '<script type="text/javascript">alert("Label printed successfully!");</script>';
                    // echo "<script type='text/javascript'>document.location='box.php'</script>"; 
                }
                else{
                    echo '<script type="text/javascript">alert("Printer is not available!");</script>';
                    // echo "<script type='text/javascript'>document.location='box.php'</script>";  
                } 
            }
            catch (Exception $e) 
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        else{
            echo '<script type="text/javascript">alert("Printer is not available!");</script>';
            // echo "<script type='text/javascript'>document.location='box.php'</script>";  
        }

*/
        ?>