<head>
  <meta http-equiv="refresh" content="300"><!-- refresh every 3mins -->
</head>
<h1>Don't close this page!</h1>
<pre>
This page is set to update logfile for iLOQ ( NFC Padlock) packing system automatically.
</pre>
<?php 


include('../dist/includes/dbcon.php');


$mydir = "\\\\iloq1867\\reports";// IP Logtest Update
if(file_exists($mydir)){

    $files = glob("\\\\iloq1867\\reports\IP*.txt");//open all IP file

    foreach($files as $file) {
        
        if (trim(file_get_contents($file)) == true) {
            $line = file($file);//file in to an array
            // echo basename($file)."\n";
            $fdate = date ("YmdHis", filemtime($file));
            $line1 = $line[3];//fetch serial number
            $arr1 = explode(":",$line1);
            $sn = preg_replace('/\s+/', '', $arr1[1]);
            
            $line3 = $line[9];//fetch test result
            $arr2 = explode(":",$line3);
            $status = preg_replace('/\s+/', '', $arr2[1]);
            if($status[0] == 'P'){
                if(isset($data[$sn]['i'])){
                    if($data[$sn]['i'] < $fdate){
                        $data[$sn][0] = $sn;         
                        $data[$sn][2] =  $status[0];
                        $data[$sn]['i'] =  $fdate;
                    }
                }
                else{
                    $data[$sn][0] = $sn;
                    $data[$sn][2] =  $status[0];
                    $data[$sn]['i'] =  $fdate;
                }
            }
        }
        // rename($file, 'C:/iLOQ/pcba/logged/'.basename($file));
    }
    
    $files = glob("\\\\iloq1867\\reports\NFC*.txt");//open all SN assign file

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

            if($status[0] == 'P'){
                if(isset($data[$sn]['s'])){
                    if($data[$sn]['s'] < $fdate){
                        $data[$sn][0] = $sn;
                        $data[$sn][4] =  $status[0];
                        $data[$sn]['s'] =  $fdate;
                    }
                }
                else{
                    $data[$sn][0] = $sn;
                    $data[$sn][4] =  $status[0];
                    $data[$sn]['s'] =  $fdate;
                }
            }
        }
        // rename($file, 'C:/iLOQ/pcba/logged/'.basename($file));
    }
}


// $mydir = "\\\\iloq1827\\D";// dur Logtest Update
// if(file_exists($mydir)){ 

//     $files = glob("\\\\iloq1827\\D\\Reports\*.txt");//open all dur file

//     foreach($files as $file) { 
// 		if(filesize($file)){
//         $line = file($file);//file in to an array
//         //  echo basename($file)."\n";
//         $fdate = date ("YmdHis", filemtime($file));
//         $line1 = $line[4];//fetch serial number
//         $arr1 = explode(":",$line1);
//         $sn = preg_replace('/\s+/', '', $arr1[1]);
        
//         $line3 = $line[10];//fetch test result
//         $arr2 = explode(":",$line3);
//         $status = preg_replace('/\s+/', '', $arr2[1]);
        
//         if($status[0] =='P'){
//             if(isset($data[$sn]['d'])){
//                 if($data[$sn]['d'] < $fdate){
//                     $data[$sn][0] = $sn;
//                     $data[$sn][1] =  $status[0];
//                     $data[$sn]['d'] =  $fdate;
//                 }
//             }
//             else{
//                 $data[$sn][0] = $sn;
//                 $data[$sn][1] =  $status[0];
//                 $data[$sn]['d'] =  $fdate;
//             }
//         }
//         // rename($file, 'C:/iLOQ/Durability/logged/'.basename($file));
// 		}
//     }
// }


$mydir = "C:\iloq\iloq1827";// temp for iloq1842 dura
if(file_exists($mydir)){ 

    $files = glob("C:\iloq\iloq1827\*.txt");//open all lock file
    
    foreach($files as $file) { 
		if(filesize($file)){
        $line = file($file);//file in to an array
        //  echo basename($file)."\n";
        $fdate = date ("YmdHis", filemtime($file));
        $line1 = $line[4];//fetch serial number
        $arr1 = explode(":",$line1);
        $sn = preg_replace('/\s+/', '', $arr1[1]);
        
        $line3 = $line[10];//fetch test result
        $arr2 = explode(":",$line3);
        $status = preg_replace('/\s+/', '', $arr2[1]);
        
        if($status[0] =='P'){
            if(isset($data[$sn]['d'])){
                if($data[$sn]['d'] < $fdate){
                    $data[$sn][0] = $sn;
                    $data[$sn][1] =  $status[0];
                    $data[$sn]['d'] =  $fdate;
                }
            }
            else{
                $data[$sn][0] = $sn;
                $data[$sn][1] =  $status[0];
                $data[$sn]['d'] =  $fdate;
            }
        }
        // rename($file, 'C:/iLOQ/Durability/logged/'.basename($file));
		}
    }
}


$mydir = "\\\\iloq1863\\reports";// RFS Logtest Update
if(file_exists($mydir)){
    $files = glob("\\\\iloq1863\\reports\*.txt");//open all RFS file 

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
            
            if($status[0] =='P'){
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
            }
        }     
        // rename($file, 'C:/iLOQ/RFS/logged/'.basename($file));
    }

}

foreach($data as $newdata){
    isset($newdata[0])?$sn = $newdata[0]:$sn="NULL";
    isset($newdata[1])?$durability = $newdata[1]:$durability="NULL";
    isset($newdata[2])?$ip = $newdata[2]:$ip="NULL";
    isset($newdata[3])?$rfs = $newdata[3]:$rfs="NULL";
    isset($newdata[4])?$sa = $newdata[4]:$sa="NULL";
    isset($newdata['d'])?$dDate = $newdata['d']:$dDate="NULL";
    isset($newdata['i'])?$iDate = $newdata['i']:$iDate="NULL";
    isset($newdata['r'])?$rDate = $newdata['r']:$rDate="NULL";
    isset($newdata['s'])?$sDate = $newdata['s']:$sDate="NULL";
    $lupdt = time();
    
    if($sn != "NULL" && ($durability != "NULL" || $ip != "NULL" || $rfs != "NULL"|| $sa != "NULL")){
        //check for existing data
        $query=mysqli_query($con,"select ipdate, ddate, rdate,sadate, count(*) as cnt from padlock_test where sn='$sn'")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
        if($row['cnt']==0){
            //insert new data
            mysqli_query($con,"INSERT IGNORE INTO padlock_test(sn,satest,sadate,iptest,durtest,ipdate,ddate,rfstest,rdate,lastUpdate)VALUES('$sn','$sa','$sDate','$ip', '$durability', '$iDate', '$dDate','$rfs','$rDate', '$lupdt')")or die(mysqli_error($con));
        }
        else{
            //update existing data
            $dDate2 = preg_replace('/\s+/', '', $row['ddate']);
            if($dDate!="NULL"){
                if($dDate2=="NULL"||$dDate>$dDate2||is_null($dDate2)){
                    mysqli_query($con,"update padlock_test set ddate='$dDate',durtest='$durability',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }
            $iDate2 = preg_replace('/\s+/', '', $row['ipdate']);
            if($iDate!="NULL"){
                if($iDate2=="NULL"||$iDate>$iDate2||is_null($iDate2)){
                    mysqli_query($con,"update padlock_test set ipdate='$iDate',iptest='$ip',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }
            $rDate2 = preg_replace('/\s+/', '', $row['rdate']);
            if($rDate!="NULL"){
                if(($rDate2=="NULL"||$rDate>$rDate2||is_null($rDate2)) && $rfs=="P" ){
                    mysqli_query($con,"update padlock_test set rdate='$rDate',rfstest='$rfs',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }
            $sDate2 = preg_replace('/\s+/', '', $row['sadate']);
            if($sDate!="NULL"){
                if(($sDate2=="NULL"||$sDate>$sDate2||is_null($sDate2)) ){
                    mysqli_query($con,"update padlock_test set sadate='$sDate',satest='$sa',lastUpdate='$lupdt' where sn='$sn'")or die(mysqli_error($con));
                }
            }

        }
    }

}
echo "Last Updated on: ".date('d-m-Y H:i:s', time());
?>