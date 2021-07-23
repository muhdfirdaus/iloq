<head>
  <meta http-equiv="refresh" content="240"><!-- refresh every 3mins -->
</head>
<h1>Don't close this page!</h1>
<pre>
This page is set to update logfile for iLOQ packing system (D5) automatically.
</pre>
<?php 


include('../dist/includes/dbcon.php');




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



$mydir = "\\\\iloq1866\Test_Reports";// D5 Durability Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1866\Test_Reports\*.txt");

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
    $files = glob("\\\\iloq1859\\reports\\*RTC*.txt");//open all lock file
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


$mydir = "\\\\iloq1876\\reports";// D5 RFS Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1876\\reports\\*RTC*.txt");//open all lock file
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

echo "Last Updated on: ".date('d-m-Y H:i:s', time());
?>