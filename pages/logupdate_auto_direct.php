<head>
  <meta http-equiv="refresh" content="240"><!-- refresh every 3mins -->
</head>
<h1>Don't close this page!</h1>
<pre>
This page is set to update logfile for iLOQ (Core) packing system automatically.
</pre>
<?php 


include('../dist/includes/dbcon.php');

// $files = glob("C:\iLOQ\Durability\*.txt");//open all file 

// foreach($files as $file) {

//     $line = file($file);//file in to an array
//     // echo basename($file)."\n";
//     $fdate = date ("YmdHis", filemtime($file));
//     $line1 = $line[0];//fetch serial number
//     $arr1 = explode(":",$line1);
//     $sn = preg_replace('/\s+/', '', $arr1[1]);
    
//     $line3 = $line[2];//fetch test result
//     $arr2 = explode(":",$line3);
//     $status = preg_replace('/\s+/', '', $arr2[1]);
    
//     if(isset($data[$sn])){
//         if($data[$sn]['d'] < $fdate){
//             $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
//         }
//     }
//     else{
//         $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
//     }
//     // rename($file, 'C:/iLOQ/Durability/logged/'.basename($file));
// }

$mydir = "\\\\iloq1811\\TestReports";// Lock Logtest Update
if(file_exists($mydir)){

    $files = glob("\\\\iloq1811\\TestReports\Oval_Assy_*.txt");//open all lock file

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
        // rename($file, 'C:/iLOQ/pcba/logged/'.basename($file));
    }
}

$mydir = "\\\\iloq1815\\TestReports";// Lock Logtest Update
if(file_exists($mydir)){

    $files = glob("\\\\iloq1815\\TestReports\Oval_Assy_*.txt");//open all lock file

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
        // rename($file, 'C:/iLOQ/pcba/logged/'.basename($file));
    }
}


$mydir = "\\\\iloq1840\\TestReports";// Lock Logtest Update
if(file_exists($mydir)){

    $files = glob("\\\\iloq1840\\TestReports\Oval_Assy_*.txt");//open all lock file

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
        // rename($file, 'C:/iLOQ/pcba/logged/'.basename($file));
    }
}



// $files = glob("C:\iLOQ\pcba\Core_D5*.txt");//open all lock file

// foreach($files as $file) {
    
//     if (trim(file_get_contents($file)) == true) {
//         $line = file($file);//file in to an array
//         $fdate = date ("YmdHis", filemtime($file));
//         $line1 = $line[4];//fetch serial number
//         $arr1 = explode(":",$line1);
//         $sn = preg_replace('/\s+/', '', $arr1[1]);
        
//         $line3 = $line[10];//fetch test result
//         $arr2 = explode(":",$line3);
//         $status = preg_replace('/\s+/', '', $arr2[1]);
    
//         if(isset($data[$sn]['l'])){
//             if($data[$sn]['l'] < $fdate){
//                 $data[$sn][0] = $sn;
//                 $data[$sn][2] =  $status[0];
//                 $data[$sn]['l'] =  $fdate;
//             }
//         }
//         else{
//             $data[$sn][0] = $sn;
//             $data[$sn][2] =  $status[0];
//             $data[$sn]['l'] =  $fdate;
//         }
//     }
//     // rename($file, 'C:/iLOQ/pcba/logged/'.basename($file));
// }



$mydir = "\\\\bts-iloq-rfs\Temp";// RFS Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\bts-iloq-rfs\Temp\*.txt");//open all RFS file 

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

        // rename($file, 'C:/iLOQ/RFS/logged/'.basename($file));
    }

}

$mydir = "\\\\bts-iloq-rfs\Temp\OVAL_C10S_Reports";// RFS Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\bts-iloq-rfs\Temp\OVAL_C10S_Reports\*.txt");//open all RFS file 

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

        // rename($file, 'C:/iLOQ/RFS/logged/'.basename($file));
    }

}


$mydir = "\\\\iloq1846\Results";// NFC Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1846\Results\*_Report*.txt");//open all RFS file 

    foreach($files as $file) {

        $line = file($file);//file in to an array
        $sn =  basename($file, '.txt');
        $fdate = date ("YmdHis", filemtime($file));
        
        if (trim(file_get_contents($file)) == true) {
            $line = file($file);//file in to an array
            $fdate = date ("YmdHis", filemtime($file));
            $line1 = $line[4];//fetch serial number
            $arr1 = explode(":",$line1);
            if(strpos($arr1[0],"Serial")!== false){
                $sn = preg_replace('/\s+/', '', $arr1[1]);
                $line3 = $line[10];//fetch test result
                $arr2 = explode(":",$line3);
                $status = preg_replace('/\s+/', '', $arr2[1]);
            }
            else{
                $line1 = $line[5];//fetch serial number
                $arr1 = explode(":",$line1);         
                $sn = preg_replace('/\s+/', '', $arr1[1]); 
                $line3 = $line[11];//fetch test result
                $arr2 = explode(":",$line3);
                $status = preg_replace('/\s+/', '', $arr2[1]);  
            }
            
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

        // rename($file, 'C:/iLOQ/NFC/logged/'.basename($file));
    }

}



if(isset($nfc)){
    foreach($nfc as $data2){
        $sn = $data2[0];
        $result = $data2[2];
        $fdate = $data2['n'];

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
    // isset($newdata[1])?$durability = $newdata[1]:$durability="NULL";
    isset($newdata[2])?$lock = $newdata[2]:$lock="NULL";
    isset($newdata[3])?$rfs = $newdata[3]:$rfs="NULL";
    // isset($newdata['d'])?$dDate = $newdata['d']:$dDate="NULL";
    isset($newdata['l'])?$lDate = $newdata['l']:$lDate="NULL";
    isset($newdata['r'])?$rDate = $newdata['r']:$rDate="NULL";
    $lupdt = time();
    
    // if($sn != "NULL" && ($durability != "NULL" || $lock != "NULL" || $rfs != "NULL")){
    if($sn != "NULL" && ($lock != "NULL" || $rfs != "NULL")){
        //check for existing data
        // $query=mysqli_query($con,"select lDate, dDate, rDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
        $query=mysqli_query($con,"select lDate, rDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']==0){
            //insert new data
            // mysqli_query($con,"INSERT IGNORE INTO sn_master(sn,lockTest,durTest,lDate,dDate,rfsTest,rDate,lastUpdate)VALUES('$sn','$lock', '$durability', '$lDate', '$dDate','$rfs','$rDate', '$lupdt')")or die(mysqli_error($con));
            mysqli_query($con,"INSERT IGNORE INTO sn_master(sn,lockTest,lDate,rfsTest,rDate,lastUpdate)VALUES('$sn','$lock', '$lDate','$rfs','$rDate', '$lupdt')")or die(mysqli_error($con));
        }
        else{
            //update existing data
            // $dDate2 = preg_replace('/\s+/', '', $row['dDate']);
            // if($dDate!="NULL"){
            //     if($dDate2=="NULL"||$dDate>$dDate2||is_null($dDate2)){
            //         mysqli_query($con,"update sn_master set dDate='$dDate',durTest='$durability',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
            //     }
            // }
            $lDate2 = preg_replace('/\s+/', '', $row['lDate']);
            if($lDate!="NULL"){
                if($lDate2=="NULL"||$lDate>$lDate2||is_null($lDate2)){
                    mysqli_query($con,"update sn_master set lDate='$lDate',lockTest='$lock',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }
            $rDate2 = preg_replace('/\s+/', '', $row['rDate']);
            if($rDate!="NULL"){
                if(($rDate2=="NULL"||$rDate>$rDate2||is_null($rDate2)) && $rfs=="P" ){
                    mysqli_query($con,"update sn_master set rDate='$rDate',rfsTest='$rfs',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }

        }
    }

}
echo "Last Updated on: ".date('d-m-Y H:i:s', time());
?>