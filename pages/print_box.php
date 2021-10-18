<?php 
    session_start();
    if(empty($_SESSION['id'])):
    header('Location:../index.php');
    endif;

    include('../dist/includes/dbcon.php');
    include('product_cfg.php');
    $box_id = $_POST['box_id'];
	$ip = $_POST['printer_ip'];
	
	$query=mysqli_query($con,"select ip from printer_cfg where id=1")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
    $current_ip=$row['ip'];
    // if($current_ip != $ip){
    //     mysqli_query($con,"update printer_cfg set ip='$ip' where id=1")or die(mysqli_error($con));
    // }
    
	$query=mysqli_query($con,"select * from box_info where box_id='{$box_id}' and status=1")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
    if(count($row)>0){
        
        $modelname=$row['model'];
        $modelno=$row['model_no'];
        $qty=$row['qty'];
        $tmstmp=$row['timestamp'];
        $current_ip=$row['id'];
        $secondlbl = 0;
        $doublepizza = 0;
        $expall = explode("-",$modelno);
        $lblheight = $expall[1];

        if((strpos($modelno,"M010293.5")!== false)){
            $query=mysqli_query($con,"select sn from box_sn where box_id='{$box_id}'")or die(mysqli_error($con));
            $row=mysqli_fetch_array($query);      
            $sn = $row['sn'];
            if(strpos($modelno,"M010293.531")!==false){
                $lblmodel='531';
            }
            else{
                $lblmodel='541';
            }
            $lbldate = date('j.n.Y',$tmstmp);    
            $lblbox = "^XA
						
            ^FX first section
                    ^FO360,100

                ^BXN,15,200
                ^FD$sn^FS

                    ^CFA,30
                    ^FO380,320^FD$sn^FS

                    ^CFP,80,90
                    ^FO220,370^FDH50S.$lblmodel.$lblheight.HC^FS
                    
                    ^CFA,40
                    ^FO60,500^FD$lbldate^FS
                    ^XZ "; 
        }
        elseif((strpos($modelno,"M009801.4")!== false)){
            $query=mysqli_query($con,"select sn from box_sn where box_id='{$box_id}'")or die(mysqli_error($con));
            $row=mysqli_fetch_array($query);      
            $sn = $row['sn'];
            if(strpos($modelno,"M009801.431")!==false){
                $lblmodel='431';
            }
            else{
                $lblmodel='441';
            }
            $lbldate = date('j.n.Y',$tmstmp);    
            $lblbox = "^XA
						
            ^FX first section
                    ^FO360,100

                ^BXN,15,200
                ^FD$sn^FS

                    ^CFA,30
                    ^FO380,320^FD$sn^FS

                    ^CFP,80,90
                    ^FO220,370^FDH50S.$lblmodel.$lblheight.HC^FS
                    
                    ^CFA,40
                    ^FO60,500^FD$lbldate^FS
                    ^XZ "; 
        }
        elseif((strpos($modelno,"M011442.3")!== false)&&(strpos($modelno,"-60-")=== false)){
            $query=mysqli_query($con,"select sn from box_sn where box_id='{$box_id}'")or die(mysqli_error($con));
            $i=1;
            while($row=mysqli_fetch_array($query)){
                ${'sn'.$i} = $row['sn'];
                $i++;
            }    
            
            if(strpos($modelno,"M011442.341")!==false){
                $lblmodel='341';
            }
            else{
                $lblmodel='331';
            }
            $lbldate = date('j.n.Y',$tmstmp);    
            $lblbox = "^XA
						
            ^FX first section
                    ^FO360,100

                ^BXN,15,200
                ^FD$sn1^FS

                    ^CFA,30
                    ^FO380,320^FD$sn1^FS

                    ^CFP,80,90
                    ^FO220,370^FDH50S.$lblmodel.$lblheight.HC^FS
                    
                    ^CFA,40
                    ^FO60,500^FD$lbldate^FS
                    ^XZ ";    
            $lblbox2 = "^XA
                        
            ^FX first section
                    ^FO360,100

                ^BXN,15,200
                ^FD$sn2^FS

                    ^CFA,30
                    ^FO380,320^FD$sn2^FS

                    ^CFP,80,90
                    ^FO220,370^FDH50S.$lblmodel.$lblheight.HC^FS
                    
                    ^CFA,40
                    ^FO60,500^FD$lbldate^FS
                    ^XZ "; 
            $doublepizza = 1;
        }
        elseif((strpos($modelno,"M011442.3")!== false)&&(strpos($modelno,"-60-")!== false)){
            $query=mysqli_query($con,"select sn from box_sn where box_id='{$box_id}'")or die(mysqli_error($con));
            $i=1;
            while($row=mysqli_fetch_array($query)){
                ${'sn'.$i} = $row['sn'];
                $i++;
            }    
            
            if(strpos($modelno,"M011442.341")!==false){
                $lblmodel='341';
            }
            else{
                $lblmodel='331';
            }
            $lbldate = date('j.n.Y',$tmstmp);    
            $lblbox = "^XA
						
            ^FX first section
                    ^FO360,100

                ^BXN,15,200
                ^FD$sn1^FS

                    ^CFA,30
                    ^FO380,320^FD$sn1^FS

                    ^CFP,80,90
                    ^FO220,370^FDH50S.$lblmodel.$lblheight.HC^FS
                    
                    ^CFA,40
                    ^FO60,500^FD$lbldate^FS
                    ^XZ ";    
        }
        elseif((strpos($modelno,"M011362")!== false) || (strpos($modelno,"M011984")!== false)){
            $query=mysqli_query($con,"select sn from box_sn where box_id='{$box_id}'")or die(mysqli_error($con));
            $row=mysqli_fetch_array($query);      
            $sn = $row['sn'];
            $lbldate = date('j.n.Y',$tmstmp); 
            $expmoddot = explode(".",$modelno);
            $lblmodel= $expmoddot[1];
            $lblbox="^XA
    
            ^CF0,100
            ^FO180,600^FDF50S.$lblmodel.HZ^FS

            ^CF0,70
            ^FO190,760^FD$lbldate^FS

            ^CF0,80
            ^FO980,710^FD$sn^FS

            ^FO1060,520
            ^BXN,11,200
            ^FD$sn^FS

            ^XZ";
        }
        else{

            $allmodel = get_modelNo2($con);
            foreach($allmodel as $key=>$value){
                if($value==$modelno){
                    $no = $key;
                }
            }

            $allmodelNo = get_modelNo($con);
            $modelNo = $allmodelNo[$no];
            //edit label file
            $lbldate = date('d/m/y',$tmstmp);
            $lblbox = '^XA
            
            ^FO30,10^GFA,12412,12412,58,,::::::::::::::::::::::::::::::::::::::O07FE,N01IF8,N03IFE,N0KF,M01KF8,:M03KFC,M07KFE,::M0MF,M0MFgW07FF8gN01IF8,M0MFgU01KFEgL03KFE,M0MFgT01MFEgJ03MFE,M0MFL07KFCgG0OFEgH03OFC,M0MFL07KFCg07PFCgG0QF8,M0MFL07KFCY01RFg07QFE,M07LFL07KFCY0SFCX01SF,M07KFEL07KFCX03TFX07RFE,M07KFEL07KFCX07TF8W0SFC,M03KFCL07KFCW01UFEV03SFC,M03KFCL07KFCW07VF8U07SF8,M01KF8L07KFCW0WFCT01TF8,N0KFM07KFCV01XFT03TF,N07IFEM07KFCV03XF8S0TFE,N01IFCM07KFCV0YFCR01TFEI018,O0IFN07KFCU01YFER03TFCI03C,O01F8N07KFCU03gFR07TF8I03E,g07KFCU07gF8Q0UF8I07F,g07KFCU0gGFCP01UFJ07F8,g07KFCT01gGFEP03TFEJ0FFC,g07KFCT03gHFP07TFEI01FFE,g07KFCT07gHF8O0UFCI01IF,g07KFCT07gHFCN01UFCI03IF8,g07KFCT0gIFCN01UF8I07IF8,g07KFCS01PFI03OFEN03OFEI03FJ07IFC,g07KFCS03OFK03OFN07NFEK07J0JFE,g07KFCS03NFCL07NF8M07NFQ0KF,g07KFCS07MFEM01NF8M0NFCP01KF,g07KFCS0NF8N07MFCL01NFQ03KF8,g07KFCS0NFO01MFEL01MFCQ03KFC,M03KFCL07KFCR01MFCP0MFEL03MF8Q07KFC,M03KFCL07KFCR01MF8P07MFL03MFR0LFE,M03KFCL07KFCR03MFQ01MFL07LFER0LFE,M03KFCL07KFCR03LFER0MF8K07LF8Q01MF,M03KFCL07KFCR07LFCR07LF8K0MFS0MF,M03KFCL07KFCR07LF8R03LFCK0MFS07LF8,M03KFCL07KFCR0MFS01LFCJ01LFES03LF8,M03KFCL07KFCR0LFES01LFEJ01LFCS03LFC,M03KFCL07KFCQ01LFCT0LFEJ03LF8S01LFC,M03KFCL07KFCQ01LFCT07KFEJ03LFU0LFC,M03KFCL07KFCQ01LF8T03LFJ03LFU07KFE,M03KFCL07KFCQ03LFU03LFJ07KFEU07KFE,M03KFCL07KFCQ03LFU01LFJ07KFEU03KFE,M03KFCL07KFCQ03KFEU01LF8I07KFCU03LF,M03KFCL07KFCQ07KFEV0LF8I0LFCU01LF,M03KFCL07KFCQ07KFCV0LF8I0LF8U01LF,M03KFCL07KFCQ07KFCV07KF8I0LF8V0LF,M03KFCL07KFCQ07KF8V07KFCI0LFW0LF8,:M03KFCL07KFCQ0LF8V03KFC001LFW07KF8,M03KFCL07KFCQ0LFW03KFC001KFEW07KF8,::M03KFCL07KFCQ0LFW01KFC001KFEW03KFC,M03KFCL07KFCQ0LFW01KFE001KFEW03KFC,:M03KFCL07KFCQ0KFEW01KFE001KFCW03KFC,::::::M03KFCL07KFCQ0LFW01KFE001KFEW03KFC,:M03KFCL07KFCQ0LFW01KFC001KFEW03KFC,M03KFCL07KFCQ0LFW03KFC001KFEW07KF8,:M03KFCL07KFCQ0LFW03KFC001LFW07KF8,M03KFCL07KFCQ0LF8V03KFC001LFW07KF8,M03KFCL07KFCQ07KF8V07KFCI0LFW0LF8,:M03KFCL07KFCQ07KFCV07KF8I0LF8V0LF,M03KFCL07KFCQ07KFCV0LF8I0LF8U01LF,M03KFCL07KFCQ03KFEV0LF8I07KFCU01LF,M03KFCL07KFCQ03KFEU01LF8I07KFCU03LF,M03KFCL07KFCQ03LFU01LFJ07KFEU03KFE,M03KFCL07KFCQ03LFU03LFJ07KFEU07KFE,M03KFCL07KFCQ01LF8T03LFJ03LFU07KFE,M03KFCL07KFCQ01LFCT07KFEJ03LF8T0LFC,M03KFCL07KFCQ01LFCT0LFEJ01LF8S01LFC,M03KFCL07KFCR0LFES01LFEJ01LFCS03LFC,M03KFCL07KFCR0MFS01LFCJ01LFES03LF8,M03KFCL07KFCR07LF8R03LFCK0MFS07LF8,M03KFCL07KFCR07LFCR07LF8K0MF8R0MF,M03KFCL07KFCR03LFER0MF8K07LFCQ01MF,M03KFCL07KFCR03MFQ03MFL07LF8Q03LFE,M03KFCL07KFCR01MF8P07MFL03LF8Q0MFE,M03KFCL07KFCR01MFEP0MFEL03LFQ01MFC,M03KFCL07KFCS0NFO03MFEL01KFEQ07MFC,M03KFCL07KFCS0NFCN07MFCM0KFEQ0NF8,M03KFCL07KFCS07MFEM01NF8M0KFCP03NF,M03KFCL07KFCS03NFCL07NF8M07JFCP0OF,M03KFCL07VFI03OF8J03OFN07JF8I07K07NFE,M03KFCL07UFEI01PF8003OFEN03JFJ07FI07OFC,M03KFCL07UFCJ0gIFCN01JFJ0gIFD,M03KFCL07UFCJ07gHFCO0IFEI01gJF,M03KFCL07UF8J07gHF8O07FFEI01gIFE,M03KFCL07UF8J03gHFP03FFCI03gIFC,M03KFCL07UFK01gGFEP03FF8I03gIFC,M03KFCL07UFL0gGFCP01FFJ07gIF8,M03KFCL07TFEL07gF8Q0FFJ0gJF8,M03KFCL07TFCL03gFR07EJ0gJF,M03KFCL07TFCL01YFER01EI01gIFE,M03KFCL07TF8M07XFCS0CI03gIFC,M03KFCL07TF8M03XF8W03gIFC,M03KFCL07TFN01WFEX07gIF8,M03KFCL07TFO0WFCX0gJF8,M03KFCL07SFEO03VF8X0gJF,M03KFCL07SFCO01UFEX01gIFE,M03KFCL07SFCP07TF8X01gIFE,M03KFCL07SF8P01SFEY03gIFC,M03KFCL07SF8Q07RFCY07gIFC,M03KFCL07SFR01RFg03gIF8,M03KFCL07SFS07PF8gG0gIF,M03KFCL07RFET0OFCgH01gHF,hN01MFEgJ01gFE,hO01KFEgL01YFC,hR0FCgP01WFC,,::::::::::::::::::::::::::::::::::::::::::::^FS

            ^CFP,120,99
            ^FO840,70^FDwww.iloq.com^FS
            
            ^CFP,130,99
            ^FO45,220^FD'.$modelname.'^FS
            
            ^CFP,120,85
            ^FO45,330^FDPN: '.$modelNo.'^FS
            ^FO1160,330^FDQTY: '.$qty.'^FS
            
            ^BY5,2
            ^FO45,430^BCn,80,N^FD'.$modelNo.'^FS
            ^FO1150,430^BCn,80,N^FD'.$qty.'^FS
            
            ^FO45,555^FDBOX NO: '.$box_id.'^FS
            ^FO1000,555^FDDATE: '.$lbldate.'^FS
            
            ^BY5,2
            ^FO45,655^BCn,80,N^FD'.$box_id.'^FS
            ^FO1000,655^BCn,80,N^FD'.$lbldate.'^FS
            
            ^XZ';

            if(strpos($modelname,"SKOGEN")!==false){
                if(strpos($modelno,"M010267")!==false){
                    $swversion = "1.5.10W";
                }
                else{
                    $swversion = "1.5.17W";
                }            
            }
            elseif((strpos($modelno,"M010358")!==false)||(strpos($modelno,"M010349")!==false)||(strpos($modelno,"M010339")!==false)||(strpos($modelno,"M010356")!==false)||(strpos($modelno,"M010308")!==false)){
                $swversion = "1.5.17W";
            }
            else{
                $swversion = "2.9";
            }
            $lblbox2 ="^XA
            ^CFP,180,120
            ^FO60,50^FD$modelno^FS
            
            ^CFP,190,230
            ^FO40,280^FD$box_id^FS
            ^FO38,280^FD$box_id^FS
            ^FO40,282^FD$box_id^FS
            
            ^CFP,180,180
            ^FO40,510^FD$lbldate^FS
        
            ^CFP,150,140
            ^FO40,720^FDS/W Ver:$swversion^FS
            
            ^XZ";

            $secondlbl = 1;

        }
        
        
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

        if($modelname != "SKOGEN KEY ASSEMBLY" && $secondlbl==1){
            //function to print second label
            $filename = "lbliloq2.txt";
            $file = fopen($filename, "r+")or die("ERROR: Cannot open the file .")  ;
            if($file){
                fwrite($file, $lblbox2);      
                fclose($file);
            } 

            //print second label
            copy($filename, "//BTS-iLOQ-1/iloqpizza"); 
        }

        $printable = pingAddress($ip);
        if($printable){
            try//attempt to print label
            {
                // Number of seconds to wait for a response from remote host
                $timeout = 2;
                if($fp=@fsockopen($ip,9100, $errNo, $errStr, $timeout)){
                    fputs($fp,$lblbox);
                    if($doublepizza==1){
                        fputs($fp,$lblbox2);
                    }
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
    }
    else{
        echo "<script type='text/javascript'>alert('Box ID entered is not exist in system!');</script>";
	    echo "<script>window.history.back();</script>"; 
    }
?>
