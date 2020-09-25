<head>
  <meta http-equiv="refresh" content="240"><!-- refresh every 3mins -->
</head>
<h1>Don't close this page!</h1>
<pre>
This page is set to update logfile for iLOQ packing system automatically.
</pre>
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
    // rename($file, 'C:/iLOQ/Durability/logged/'.basename($file));
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


$mydir = "\\\\iloq1841\\reports";// Skogen Key Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1841\\reports\*.txt");//open all lock file

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
        // rename($file, 'C:/iLOQ/skogen_key/logged/'.basename($file));
    }


}

$mydir = "\\\\iloq1843\\TestReports";// Skogen Lock Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1843\\TestReports\Skogen_Assy_*.txt");//open all lock file

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

$mydir = "\\\\iloq1845\\TestReports";// Skogen Lock Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1845\\TestReports\Skogen_Assy_*.txt");//open all lock file

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

$files = glob("C:\iLOQ\RFS_skogen\*.txt"); //RFS skogen

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
            //only save data if 'Pass'
            // if($status=='P' && $data[$sn]['r']<$fdate){ 
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
    // rename($file, 'C:/iLOQ/RFS_skogen/logged/'.basename($file));
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


$mydir = "\\\\iloq1858\Reports";// D5 Burn Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1858\Reports\*.txt");//open D5 burn-in log

    foreach($files as $file) {
        
        if (trim(file_get_contents($file)) == true) {
            $line = file($file);//file in to an array
            $fdate = date ("YmdHis", filemtime($file));
            $line1 = $line[4];//fetch serial number
            $arr1 = explode(":",$line1);
            $sn = preg_replace('/\s+/', '', $arr1[1]);
            
            $line3 = $line[10];//fetch test result
            $arr2 = explode(":",$line3);
            $status = preg_replace('/\s+/', '', $arr2[1]);
        
            if(isset($d5burn[$sn]['bdate'])){
                if($d5burn[$sn]['bdate'] < $fdate){
                    $d5burn[$sn][0] = $sn;
                    $d5burn[$sn]['res'] =  $status[0];
                    $d5burn[$sn]['bdate'] =  $fdate;
                }
            }
            else{
                $d5burn[$sn][0] = $sn;
                $d5burn[$sn]['res'] =  $status[0];
                $d5burn[$sn]['bdate'] =  $fdate;
            }
        }
        // rename($file, 'C:/iLOQ/burn_D5/logged/'.basename($file));
    }
}



$mydir = "\\\\iloq1869\Test_Reports";// D5 Durability Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1869\Test_Reports\*.txt");

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
        
            if(isset($d5dur[$sn]['bdate'])){
                if($d5dur[$sn]['bdate'] < $fdate){
                    $d5dur[$sn][0] = $sn;
                    $d5dur[$sn]['res'] =  $status[0];
                    $d5dur[$sn]['bdate'] =  $fdate;
                }
            }
            else{
                $d5dur[$sn][0] = $sn;
                $d5dur[$sn]['res'] =  $status[0];
                $d5dur[$sn]['bdate'] =  $fdate;
            }
        }
        // rename($file, 'C:/iLOQ/burn_D5/logged/'.basename($file));
    }

}


$mydir = "\\\\iloq1852\Test_Reports";// D5 Durability Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1852\Test_Reports\*.txt");

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
        
            if(isset($d5dur[$sn]['bdate'])){
                if($d5dur[$sn]['bdate'] < $fdate){
                    $d5dur[$sn][0] = $sn;
                    $d5dur[$sn]['res'] =  $status[0];
                    $d5dur[$sn]['bdate'] =  $fdate;
                }
            }
            else{
                $d5dur[$sn][0] = $sn;
                $d5dur[$sn]['res'] =  $status[0];
                $d5dur[$sn]['bdate'] =  $fdate;
            }
        }
        // rename($file, 'C:/iLOQ/burn_D5/logged/'.basename($file));
    }

}


$mydir = "\\\\iloq1859\\reports";// D5 RFS Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1859\\reports\#D5 RFS LOGFILE_2020\D5 RFS LogFile_(8)_AUG.20\D5 RFS LogFile_08.10.20\*.txt");//open all lock file
    foreach($files as $file) {
        
        if (trim(file_get_contents($file)) == true) {
            $line = file($file);//file in to an array
            $fdate = date ("YmdHis", filemtime($file));
            $line1 = $line[3];//fetch serial number
            $arr1 = explode(":",$line1);
            $sn = preg_replace('/\s+/', '', $arr1[1]);
            
            if(is_numeric($sn)){
                $line3 = $line[9];//fetch test result
                $arr2 = explode(":",$line3);
                $status = preg_replace('/\s+/', '', $arr2[1]);
            
                if(isset($d5rfs[$sn]['bdate'])){
                    if($d5rfs[$sn]['bdate'] < $fdate){
                        $d5rfs[$sn][0] = $sn;
                        $d5rfs[$sn]['res'] =  $status[0];
                        $d5rfs[$sn]['bdate'] =  $fdate;
                    }
                }
                else{
                    $d5rfs[$sn][0] = $sn;
                    $d5rfs[$sn]['res'] =  $status[0];
                    $d5rfs[$sn]['bdate'] =  $fdate;
                }
            }
        }
        // rename($file, 'C:/iLOQ/skogen_key/logged/'.basename($file));
    }


}

if(isset($d5rfs)){
    foreach($d5rfs as $d5rfs2){
        $sn = $d5rfs2[0];
        $result = $d5rfs2['res'];
        $fdate = $d5rfs2['bdate'];

        $query=mysqli_query($con,"select filetime, count(*) as cnt from d5_rfs where sn='$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']==0){
            //insert new data
            mysqli_query($con,"INSERT INTO d5_rfs(sn,result,filetime)VALUES('$sn','$result', '$fdate')")or die(mysqli_error($con));
        }
        else{
            $fdate2 = preg_replace('/\s+/', '', $row['filetime']);
            if($fdate!="NULL"){
                if($fdate2=="NULL"||$fdate>$fdate2){
                    mysqli_query($con,"update d5_rfs set filetime='$fdate',result='$result' where sn='$sn'")or die(mysqli_error($con));
                }
            }
        }
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

if(isset($d5burn)){
    foreach($d5burn as $d5burn2){
        $sn = $d5burn2[0];
        $result = $d5burn2['res'];
        $fdate = $d5burn2['bdate'];

        $query=mysqli_query($con,"select filetime, count(*) as cnt from d5_burn where sn='$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']==0){
            //insert new data
            mysqli_query($con,"INSERT INTO d5_burn(sn,result,filetime)VALUES('$sn','$result', '$fdate')")or die(mysqli_error($con));
        }
        else{
            $fdate2 = preg_replace('/\s+/', '', $row['filetime']);
            if($fdate!="NULL"){
                if($fdate2=="NULL"||$fdate>$fdate2){
                    mysqli_query($con,"update d5_burn set filetime='$fdate',result='$result' where sn='$sn'")or die(mysqli_error($con));
                }
            }
        }
    }
}


if(isset($d5dur)){
    foreach($d5dur as $d5dur2){
        $sn = $d5dur2[0];
        $result = $d5dur2['res'];
        $fdate = $d5dur2['bdate'];

        $query=mysqli_query($con,"select filetime, count(*) as cnt from d5_durability where sn='$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']==0){
            //insert new data
            mysqli_query($con,"INSERT INTO d5_durability(sn,result,filetime)VALUES('$sn','$result', '$fdate')")or die(mysqli_error($con));
        }
        else{
            $fdate2 = preg_replace('/\s+/', '', $row['filetime']);
            if($fdate!="NULL"){
                if($fdate2=="NULL"||$fdate>$fdate2){
                    mysqli_query($con,"update d5_durability set filetime='$fdate',result='$result' where sn='$sn'")or die(mysqli_error($con));
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
            mysqli_query($con,"INSERT IGNORE INTO sn_master(sn,lockTest,durTest,lDate,dDate,rfsTest,rDate,lastUpdate)VALUES('$sn','$lock', '$durability', '$lDate', '$dDate','$rfs','$rDate', '$lupdt')")or die(mysqli_error($con));
        }
        else{
            //update existing data
            $dDate2 = preg_replace('/\s+/', '', $row['dDate']);
            if($dDate!="NULL"){
                if($dDate2=="NULL"||$dDate>$dDate2||is_null($dDate2)){
                    mysqli_query($con,"update sn_master set dDate='$dDate',durTest='$durability',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }
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