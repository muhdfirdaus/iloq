<head>
  <meta http-equiv="refresh" content="240"><!-- refresh every 3mins -->
</head>
<h1>Don't close this page!</h1>
<pre>
This page is set to update logfile for iLOQ packing system (Skogen) automatically.
</pre>
<?php 


include('../dist/includes/dbcon.php');



$mydir = "\\\\iloq1841\\reports";// Skogen Key Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1841\\reports\*.txt");//open all lock file

    foreach($files as $file) {
        
        if (trim(file_get_contents($file)) == true) {
            $line = file($file);//file in to an array
            $fdate = date ("YmdHis", filemtime($file));
            $line1 = $line[3];//fetch serial number
            $arr1 = explode(":",$line1);
            $sn = preg_replace('/[^0-9]/', '', $arr1[1]);
            
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

$mydir = "\\\\iloq1865\\reports";// Skogen Key Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1865\\reports\*.txt");//open all lock file

    foreach($files as $file) {
        
        if (trim(file_get_contents($file)) == true) {
            $line = file($file);//file in to an array
            $fdate = date ("YmdHis", filemtime($file));
            $line1 = $line[3];//fetch serial number
            $arr1 = explode(":",$line1);
            $sn = preg_replace('/[^0-9]/', '', $arr1[1]);
            
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
            $sn = preg_replace('/[^0-9]/', '', $arr1[1]);
            
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
            $sn = preg_replace('/[^0-9]/', '', $arr1[1]);
            
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


$mydir = "\\\\iloq1830\\Skogen RFS";// RFS Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1830\\Skogen RFS\\Reports\\*.txt"); //RFS skogen

    foreach($files as $file) {

        $line = file($file);//file in to an array
        $fdate = date ("YmdHis", filemtime($file));
        $line1 = $line[3];//fetch serial number
        $arr1 = explode(":",$line1);
        $sn = preg_replace('/[^0-9]/', '', $arr1[1]);
        
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