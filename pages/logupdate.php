<!-- <pre> -->
<?php 


include('../dist/includes/dbcon.php');


$files = glob("C:\iLOQ\Durability\*.txt");//open all file 

foreach($files as $file) {

    $line = file($file);//file in to an array
    // echo basename($file)."\n";
    $fdate = date ("YmdHis", filemtime($file));
    $line1 = $line[0];//fetch serial number
    $arr1 = explode(":",$line1);
    $sn = preg_replace('/\s+/', '', $arr1[1]);
    
    $line3 = $line[2];//fetch test result
    $arr2 = explode(":",$line3);
    $status = preg_replace('/\s+/', '', $arr2[1]);
    
    if(isset($data[$sn])){
        if($data[$sn]['d'] < $fdate){
            $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
        }
    }
    else{
        $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
    }
    rename($file, 'C:/iLOQ/Durability/logged/'.basename($file));
}

$files = glob("C:\iLOQ\pcba\Oval_Assy_*.txt");//open all lock file

foreach($files as $file) {
    
    if (trim(file_get_contents($file)) == true) {
        $line = file($file);//file in to an array
        $fdate = date ("YmdHis", filemtime($file));
        $line1 = $line[3];//fetch serial number
        $arr1 = explode(":",$line1);
        $sn = preg_replace('/\s+/', '', $arr1[1]);
        
        $line3 = $line[9];//fetch test result
        $arr2 = explode(":",$line3);
        $status = preg_replace('/\s+/', '', $arr2[1]);
    
        if(isset($data[$sn]['l'])){
            if($data[$sn]['l'] < $fdate){
                $data[$sn][0] = $sn;
                $data[$sn][2] =  $status[0];
                $data[$sn]['l'] =  $fdate;
            }
        }
        else{
            $data[$sn][0] = $sn;
            $data[$sn][2] =  $status[0];
            $data[$sn]['l'] =  $fdate;
        }
    }
    rename($file, 'C:/iLOQ/pcba/logged/'.basename($file));
}

$files = glob("C:\iLOQ\skogen_key\*.txt");//open all lock file

foreach($files as $file) {
    
    if (trim(file_get_contents($file)) == true) {
        $line = file($file);//file in to an array
        $fdate = date ("YmdHis", filemtime($file));
        $line1 = $line[3];//fetch serial number
        $arr1 = explode(":",$line1);
        $sn = preg_replace('/\s+/', '', $arr1[1]);
        
        $line3 = $line[9];//fetch test result
        $arr2 = explode(":",$line3);
        $status = preg_replace('/\s+/', '', $arr2[1]);
    
        if(isset($data[$sn]['l'])){
            if($data[$sn]['l'] < $fdate){
                $data[$sn][0] = $sn;
                $data[$sn][2] =  $status[0];
                $data[$sn]['l'] =  $fdate;
            }
        }
        else{
            $data[$sn][0] = $sn;
            $data[$sn][2] =  $status[0];
            $data[$sn]['l'] =  $fdate;
        }
    }
    rename($file, 'C:/iLOQ/skogen_key/logged/'.basename($file));
}

$files = glob("C:\iLOQ\pcba\Skogen_Assy_*.txt");//open all lock file

foreach($files as $file) {
    
    if (trim(file_get_contents($file)) == true) {
        $line = file($file);//file in to an array
        $fdate = date ("YmdHis", filemtime($file));
        $line1 = $line[3];//fetch serial number
        $arr1 = explode(":",$line1);
        $sn = preg_replace('/\s+/', '', $arr1[1]);
        
        $line3 = $line[9];//fetch test result
        $arr2 = explode(":",$line3);
        $status = preg_replace('/\s+/', '', $arr2[1]);
    
        if(isset($data[$sn]['l'])){
            if($data[$sn]['l'] < $fdate){
                $data[$sn][0] = $sn;
                $data[$sn][2] =  $status[0];
                $data[$sn]['l'] =  $fdate;
            }
        }
        else{
            $data[$sn][0] = $sn;
            $data[$sn][2] =  $status[0];
            $data[$sn]['l'] =  $fdate;
        }
    }
    rename($file, 'C:/iLOQ/pcba/logged/'.basename($file));
}

$files = glob("C:\iLOQ\RFS\*.txt");//open all RFS file 

foreach($files as $file) {

    $line = file($file);//file in to an array
    $sn =  basename($file, '.txt');
    $fdate = date ("YmdHis", filemtime($file));
    
    if(isset($data[$sn])){
        if(isset($data[$sn]['r'])){
            if($data[$sn]['r'] < $fdate){
                $data[$sn][0] = $sn;
                $data[$sn][3] =  'P';
                $data[$sn]['r'] =  $fdate;
            }
        }
        else{
            $data[$sn][3] =  'P';
            $data[$sn]['r'] =  $fdate;
        }
    }
    else{
        $data[$sn][0] = $sn;
        $data[$sn][3] =  'P';
        $data[$sn]['r'] =  $fdate;
    }

    rename($file, 'C:/iLOQ/RFS/logged/'.basename($file));
}

$files = glob("C:\iLOQ\RFS_skogen\*.txt");//open all RFS file 

foreach($files as $file) {

    $line = file($file);//file in to an array
    $fdate = date ("YmdHis", filemtime($file));
    $line1 = $line[3];//fetch serial number
    $arr1 = explode(":",$line1);
    $sn = preg_replace('/\s+/', '', $arr1[1]);
    
    $line3 = $line[9];//fetch test result
    $arr2 = explode(":",$line3);
    $statusfull = preg_replace('/\s+/', '', $arr2[1]);
    $status = $statusfull[0];

    if($status == 'P'){
        $line165 = $line[165];
        $arr3 = explode(":",$line165);
        $vers = preg_replace('/\s+/', '', $arr3[1]);

        if($vers == "007b"){
            $status = "F";
        }
    }
    
    if(isset($data[$sn])){
        if(isset($data[$sn]['r'])){
            if($status=='P' && $data[$sn]['r']<$fdate){
                $data[$sn][0] = $sn;
                $data[$sn][3] =   $status;
                $data[$sn]['r'] =  $fdate;
            }
        }
        else{
            $data[$sn][3] =  $status;
            $data[$sn]['r'] =  $fdate;
        }
    }
    else{
        $data[$sn][0] = $sn;
        $data[$sn][3] =  $status;
        $data[$sn]['r'] =  $fdate;
    }
    rename($file, 'C:/iLOQ/RFS_skogen/logged/'.basename($file));
}


$files = glob("C:\iLOQ\NFC\*.txt");//open all RFS file 

foreach($files as $file) {

    $line = file($file);//file in to an array
    $sn =  basename($file, '.txt');
    $fdate = date ("YmdHis", filemtime($file));
    
    if (trim(file_get_contents($file)) == true) {
        $line = file($file);//file in to an array
        $fdate = date ("YmdHis", filemtime($file));
        $line1 = $line[4];//fetch serial number
        $arr1 = explode(":",$line1);
        $sn = preg_replace('/\s+/', '', $arr1[1]);
        
        $line3 = $line[10];//fetch test result
        $arr2 = explode(":",$line3);
        $status = preg_replace('/\s+/', '', $arr2[1]);
        
        if(isset($nfc[$sn]['n'])){
            if($status[0]=='P'){
                $nfc[$sn][0] = $sn;
                $nfc[$sn][2] =  $status[0];
                $nfc[$sn]['n'] =  $fdate;
            }
        }
        else{
            $nfc[$sn][0] = $sn;
            $nfc[$sn][2] =  $status[0];
            $nfc[$sn]['n'] =  $fdate;
        }
    }    

    rename($file, 'C:/iLOQ/NFC/logged/'.basename($file));
}

if(isset($nfc)){
    foreach($nfc as $data){
        $sn = $data[0];
        $result = $data[2];
        $fdate = $data['n'];

        $query=mysqli_query($con,"select fdate, count(*) as cnt from nfc_test where sn='$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']==0){
            //insert new data
            mysqli_query($con,"INSERT INTO nfc_test(sn,result,fdate)VALUES('$sn','$result', '$fdate')")or die(mysqli_error($con));
        }
        else{
            $fdate2 = preg_replace('/\s+/', '', $row['fdate']);
            if($fdate!="NULL"){
                if($fdate2=="NULL"||$fdate>$fdate2){
                    mysqli_query($con,"update nfc_test set fdate='$fdate',result='$result' where sn='$sn'")or die(mysqli_error($con));
                }
            }
        }
    }
}

foreach($data as $newdata){
    isset($newdata[0])?$sn = $newdata[0]:$sn="NULL";
    isset($newdata[1])?$durability = $newdata[1]:$durability="NULL";
    isset($newdata[2])?$lock = $newdata[2]:$lock="NULL";
    isset($newdata[3])?$rfs = $newdata[3]:$rfs="NULL";
    isset($newdata['d'])?$dDate = $newdata['d']:$dDate="NULL";
    isset($newdata['l'])?$lDate = $newdata['l']:$lDate="NULL";
    isset($newdata['r'])?$rDate = $newdata['r']:$rDate="NULL";
    $lupdt = time();
    
    if($sn != "NULL" && ($durability != "NULL" || $lock != "NULL" || $rfs != "NULL")){
        //check for existing data
        $query=mysqli_query($con,"select lDate, dDate, rDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']==0){
            //insert new data
            mysqli_query($con,"INSERT INTO sn_master(sn,lockTest,durTest,lDate,dDate,rfsTest,rDate,lastUpdate)VALUES('$sn','$lock', '$durability', '$lDate', '$dDate','$rfs','$rDate', '$lupdt')")or die(mysqli_error($con));
        }
        else{
            //update existing data
            $dDate2 = preg_replace('/\s+/', '', $row['dDate']);
            if($dDate!="NULL"){
                if($dDate2=="NULL"||$dDate>$dDate2){
                    mysqli_query($con,"update sn_master set dDate='$dDate',durTest='$durability',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }
            $lDate2 = preg_replace('/\s+/', '', $row['lDate']);
            if($lDate!="NULL"){
                if($lDate2=="NULL"||$lDate>$lDate2){
                    mysqli_query($con,"update sn_master set lDate='$lDate',lockTest='$lock',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }
            $rDate2 = preg_replace('/\s+/', '', $row['rDate']);
            if($rDate!="NULL"){
                if($rDate2=="NULL"||$rDate>$rDate2){
                    mysqli_query($con,"update sn_master set rDate='$rDate',rfsTest='$rfs',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }

        }
    }

}

echo '<script type="text/javascript">alert("Log data updated!");</script>';
echo "<script>window.history.back();</script>"; 

?>
<!-- </pre> -->