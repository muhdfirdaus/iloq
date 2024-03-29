<?php

session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
include('product_cfg.php');

$query=mysqli_query($con,"select * from carton_info order by carton_id desc limit 1")or die(mysqli_error($con));
$row=mysqli_fetch_array($query);
$carton_id=$row['carton_id'];
$run_no =  preg_replace("/[^0-9,.]/", "", $carton_id);         
$carton_id = "IQ" . str_pad(($run_no +1), 6, '0', STR_PAD_LEFT);
$no_box = $_POST['no_box'];
$no = $_POST['model'];
$line = $_POST['line'];
$id = $_SESSION['id'];
$tmstmp = time(); 


$allModel = get_model_name($con);
$allmodelNo2 = get_modelNo2($con);
$model = $allModel[$no];
$model_no2 = $allmodelNo2[$no];

//Check for duplicate Box ID
$dupmsg = 'Duplicate SN detected in: \n';
$dupmsg_T = 0;
for($i=1;$i<=$no_box;$i++){
    $dup_detect = 0;
    for($c=1;$c<=$no_box;$c++){
        if($c!=$i){
            $_POST['sn'.$i]==$_POST['sn'.$c]?$dup_detect=1:$dup_detect=$dup_detect;
        }
    }
    $dup_detect==1?$dupmsg.='-line '.$i.'\n':$dupmsg = $dupmsg;
    $dup_detect==1?$dupmsg_T = 1: $dupmsg_T=$dupmsg_T;
}
if($dupmsg_T==1){
    echo '<script type="text/javascript">alert("'.$dupmsg.'");</script>';
    echo "<script>window.history.back();</script>"; 
}
else{
    //check for existing data
    $existmsg='';
    $existed = 0;
    for($i=1;$i<=$no_box;$i++){
        $sn= $_POST['sn'.$i];
        $query=mysqli_query($con,"SELECT COUNT(*) as cnt FROM carton_box cb
        LEFT JOIN box_sn bs ON cb.box_id = bs.box_id
        WHERE bs.sn = '$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']!=0){
            $existed = 1;
            $existmsg.=$box_id.' on line '.$i.' already exist in the system!\n';
        }
    }
    if($existed){
        echo '<script type="text/javascript">alert("'.$existmsg.'");</script>';
        echo "<script>window.history.back();</script>"; 
    }
    else{

        $i = 1;
        $qty = $no_box;
        $stop_proc = 0;
        $errmsg = '';
        while($i <= $qty){
            
            $sn= $_POST['sn'.$i];
            $query=mysqli_query($con,"SELECT bi.model FROM box_info bi LEFT JOIN box_sn bs ON bi.box_id=bs.box_id WHERE bs.sn='$sn'")or die(mysqli_error());
            $row=mysqli_fetch_array($query);
            if($row != null && $row['model']==$model){
                // $box[$i] = $box_id;
            }
            elseif($row == null){
                $errmsg .= '-Box ID in row '.$i.' is not exist!\n';
                $stop_proc = 1;
            }
            elseif($row != null && $row['model']!=$model){
                $errmsg .= '-Box ID in row '.$i.' is different model!\n';
                $stop_proc = 1;
            }

            $i++;
        }
        if($stop_proc == 0){
            for($i=1;$i<=$no_box;$i++){
                $sn= $_POST['sn'.$i];
                $query = mysqli_query($con,"SELECT box_id from box_sn where sn = '$sn'")or die(mysqli_error($con));
                $row=mysqli_fetch_array($query);
                $boxid = $row['box_id'];
                if(isset($box[$boxid])){
                    //do nothing
                }
                else{
                    $box[$boxid]=$boxid;
                }
            }
            foreach($box as $key=>$value){
                mysqli_query($con,"INSERT INTO carton_box(carton_id,box_id)VALUES('$carton_id','$value')")or die(mysqli_error($con));
            }
            mysqli_query($con,"INSERT INTO carton_info(carton_id,user_id,no_of_box,timestamp,model, qty, model_no,line)
            VALUES('$carton_id','$id', '$no_box', '$tmstmp',  '$model',  '$qty',  '$model_no2', '$line')")or die(mysqli_error($con));
            echo "<script type='text/javascript'>alert('Data saved!');</script>";
            

            $query=mysqli_query($con,"select ip from printer_cfg where name='Carton$line'")or die(mysqli_error($con));
            $row=mysqli_fetch_array($query);
            $ip=$row['ip'];
            
            //edit label file
            
            $allCustProd = get_custProd($con);
            $lblcode = $allCustProd[$no];

            $allShipPN = get_shipPN($con);
            $lblcode2 = $allShipPN[$no];
            
            $lbldate = date('d/m/y',$tmstmp);

            // $fp = fopen('C:/lblcarton.txt', 'w');
            // fwrite($fp, '
            if($lblcode =="IQ-M005551.10.1.SB" || $lblcode =="IQ-M005551.10.1.SB.SE")
            {
                $weight = '12.5KG';
            }
            elseif(strpos($lblcode2, 'F50')!== false)
            {
                $explblcode = explode(".",$lblcode2);
                if($explblcode[1]=='511'){
                    $weight="7.15KG";
                }
                else{
                    $weight = '10.65KG';
                }
            }
            elseif(strpos($lblcode, 'M009801')!== false)
            {
                $weight = '21.15KG';
            }
            elseif((strpos($lblcode, 'M011442.341-60')!== false)||(strpos($lblcode, 'M011442.331-60')!== false))
            {
                $weight = '15KG';
            }
            elseif((strpos($lblcode, 'M011442.341-110')!== false)||(strpos($lblcode, 'M011442.331-110')!== false))
            {
                $weight = '15KG';
            }
            elseif(strpos($lblcode, 'M011442.341-25')!== false)
            {
                $weight = '24KG';
            }
            elseif(strpos($lblcode, 'M011442')!== false)
            {
                $weight = '24KG';
            }
            elseif(strpos($lblcode, 'M010293')!== false)
            {
                $weight = '22.76KG';
            }
            else
            {
                $weight = '15KG';
            }

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
            ^FO1360,170^FD'.$lblcode.'^FS
            ^FO1360,2430^FD'.$qty.'^FS
            
            ^BY5.5,3
            ^FO1150,170^BCR,180,N^FDP'.$lblcode.'^FS
            ^FO1150,2310^BCR,180,N^FDQ'.$qty.'^FS
            
            ^FX horizontal line
            ^FO1080,3^GB9,3635,3^FS
            
            ^CF0,150
            ^FO820,170^FD'.$lblcode2.'^FS
            ^FO610,170^FDDate: '.$lbldate.'^FS
            
            ^FO610,2310^FDWeight:  '.$weight.'^FS
            
            ^FX horizontal line
            ^FO550,3^GB9,3635,3^FS
            
            ^CF0,130
            ^FO295,170^FDPALLET ID:^FS
            ^CF0,140
            ^FO290,1000^FD'.$carton_id.'^FS
            
            ^BY5.5,3
            ^FO260,2310^BCR,180,N^FD'.$carton_id.'^FS
            
            ^FX horizontal line
            ^FO165,3^GB9,3635,3^FS
            
            ^XZ';
            
            // fclose($fp);

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
                        echo "<script type='text/javascript'>document.location='carton.php'</script>"; 
                    }
                    else{
                        echo '<script type="text/javascript">alert("Printer is not available!");</script>';
                        echo "<script type='text/javascript'>document.location='carton.php'</script>";  
                    } 
                }
                catch (Exception $e) 
                {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            }
            else{
                echo '<script type="text/javascript">alert("Printer is not available!");</script>';
                echo "<script type='text/javascript'>document.location='carton.php'</script>";  
            }
        }
        else{
            echo '<script type="text/javascript">alert("'.$errmsg.'");</script>';
            echo "<script>window.history.back();</script>";  
        }

    }


}

























?>