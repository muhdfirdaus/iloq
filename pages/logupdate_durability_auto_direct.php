<head>
  <meta http-equiv="refresh" content="300"><!-- refresh every 3mins -->
</head>
<h1>Don't close this page!</h1>
<pre>
This page is set to update logfile for iLOQ (Durability) packing system automatically.
</pre>

<?php
include('../dist/includes/dbcon.php');


$mydir = "\\\\iloq1819\\Durability";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1819\\Durability\\Fixture_1\\*.txt");//open all lock file

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
}


$mydir = "\\\\iloq1819\\Durability";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1819\\Durability\\Fixture_2\\*.txt");//open all lock file

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
}



$mydir = "\\\\iloq1819\\Durability";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1819\\Durability\\Fixture_3\\*.txt");//open all lock file

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
}


$mydir = "\\\\iloq1818\\TestReports";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1818\\TestReports\\Durability\\Fixture_1\\*.txt");//open all lock file

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
}

$mydir = "\\\\iloq1818\\TestReports";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1818\\TestReports\\Durability\\Fixture_2\\*.txt");//open all lock file

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
}

$mydir = "\\\\iloq1818\\TestReports";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1818\\TestReports\\Durability\\Fixture_3\\*.txt");//open all lock file

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
}


// $mydir = "\\\\iloq1842\\D\\TestReports";// Lock Logtest Update
// if(file_exists($mydir)){ 

//     $files = glob("\\\\iloq1842\\D\\TestReports\\Durability\\Fixture_1\\*.txt");//open all lock file

//     foreach($files as $file) { 

//         $line = file($file);//file in to an array
//         // echo basename($file)."\n";
//         $fdate = date ("YmdHis", filemtime($file));
//         $line1 = $line[0];//fetch serial number
//         $arr1 = explode(":",$line1);
//         $sn = preg_replace('/\s+/', '', $arr1[1]);
        
//         $line3 = $line[2];//fetch test result
//         $arr2 = explode(":",$line3);
//         $status = preg_replace('/\s+/', '', $arr2[1]);
        
//         if(isset($data[$sn])){
//             if($data[$sn]['d'] < $fdate){
//                 $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
//             }
//         }
//         else{
//             $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
//         }
//         // rename($file, 'C:/iLOQ/Durability/logged/'.basename($file));
//     }
// }


// $mydir = "\\\\iloq1842\\D\\TestReports";// Lock Logtest Update
// if(file_exists($mydir)){ 

//     $files = glob("\\\\iloq1842\\D\\TestReports\\Durability\\Fixture_2\\*.txt");//open all lock file

//     foreach($files as $file) { 

//         $line = file($file);//file in to an array
//         // echo basename($file)."\n";
//         $fdate = date ("YmdHis", filemtime($file));
//         $line1 = $line[0];//fetch serial number
//         $arr1 = explode(":",$line1);
//         $sn = preg_replace('/\s+/', '', $arr1[1]);
        
//         $line3 = $line[2];//fetch test result
//         $arr2 = explode(":",$line3);
//         $status = preg_replace('/\s+/', '', $arr2[1]);
        
//         if(isset($data[$sn])){
//             if($data[$sn]['d'] < $fdate){
//                 $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
//             }
//         }
//         else{
//             $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
//         }
//         // rename($file, 'C:/iLOQ/Durability/logged/'.basename($file));
//     }
// }



// $mydir = "\\\\iloq1842\\D\\TestReports";// Lock Logtest Update
// if(file_exists($mydir)){ 

//     $files = glob("\\\\iloq1842\\D\\TestReports\\Durability\\Fixture_3\\*.txt");//open all lock file

//     foreach($files as $file) { 

//         $line = file($file);//file in to an array
//         // echo basename($file)."\n";
//         $fdate = date ("YmdHis", filemtime($file));
//         $line1 = $line[0];//fetch serial number
//         $arr1 = explode(":",$line1);
//         $sn = preg_replace('/\s+/', '', $arr1[1]);
        
//         $line3 = $line[2];//fetch test result
//         $arr2 = explode(":",$line3);
//         $status = preg_replace('/\s+/', '', $arr2[1]);
        
//         if(isset($data[$sn])){
//             if($data[$sn]['d'] < $fdate){
//                 $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
//             }
//         }
//         else{
//             $data[$sn] = array(0=>$sn, 1=>$status[0], 'd'=>$fdate);
//         }
//         // rename($file, 'C:/iLOQ/Durability/logged/'.basename($file));
//     }
// }

$mydir = "C:\iloq\iloq1842";// temp for iloq1842 dura
if(file_exists($mydir)){ 

    $files = glob("C:\iloq\iloq1842\*.txt");//open all lock file

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
}

$mydir = "\\\\iloq1877\\Durability";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1877\\Durability\\Fixture_1\\*.txt");//open all lock file

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
}


$mydir = "\\\\iloq1877\\Durability";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1877\\Durability\\Fixture_2\\*.txt");//open all lock file

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
}


$mydir = "\\\\iloq1877\\Durability";// Lock Logtest Update
if(file_exists($mydir)){ 

    $files = glob("\\\\iloq1877\\Durability\\Fixture_3\\*.txt");//open all lock file

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
}


$mydir = "\\\\iloq1879\\Durability";// Keytube dur Logtest Update
if(file_exists($mydir)){ 

    $files = glob("//iloq1879/Durability/Fixture_1/*.txt");//open all lock file

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
}


foreach($data as $newdata){
    isset($newdata[0])?$sn = $newdata[0]:$sn="NULL";
    isset($newdata[1])?$durability = $newdata[1]:$durability="NULL";
    // isset($newdata[2])?$lock = $newdata[2]:$lock="NULL";
    // isset($newdata[3])?$rfs = $newdata[3]:$rfs="NULL";
    isset($newdata['d'])?$dDate = $newdata['d']:$dDate="NULL";
    // isset($newdata['l'])?$lDate = $newdata['l']:$lDate="NULL";
    // isset($newdata['r'])?$rDate = $newdata['r']:$rDate="NULL";
    $lupdt = time();
    
    // if($sn != "NULL" && ($durability != "NULL" || $lock != "NULL" || $rfs != "NULL")){
    if($sn != "NULL" && $durability != "NULL"){
        //check for existing data
        // $query=mysqli_query($con,"select lDate, dDate, rDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
        $query=mysqli_query($con,"select dDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']==0){
            //insert new data
            // mysqli_query($con,"INSERT IGNORE INTO sn_master(sn,lockTest,durTest,lDate,dDate,rfsTest,rDate,lastUpdate)VALUES('$sn','$lock', '$durability', '$lDate', '$dDate','$rfs','$rDate', '$lupdt')")or die(mysqli_error($con));
            mysqli_query($con,"INSERT IGNORE INTO sn_master(sn,durTest,dDate,lastUpdate)VALUES('$sn', '$durability', '$dDate', '$lupdt')")or die(mysqli_error($con));
        }
        else{
            //update existing data
            $dDate2 = preg_replace('/\s+/', '', $row['dDate']);
            if($dDate!="NULL"){
                if($dDate2=="NULL"||$dDate>$dDate2||is_null($dDate2)){
                    mysqli_query($con,"update sn_master set dDate='$dDate',durTest='$durability',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }

        }
    }

}

echo "Last Updated on: ".date('d-m-Y H:i:s', time());

?>