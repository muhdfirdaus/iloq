<?php

$files = glob("C:\iLOQ\Test1\*.txt");//open all RFS file 

foreach($files as $file) {

    $line = file($file);//file in to an array
    $fdate = date ("YmdHis", filemtime($file));
    $line1 = $line[3];//fetch serial number
    $arr1 = explode(":",$line1);
    $sn = preg_replace('/\s+/', '', $arr1[1]);
    
    $line3 = $line[9];//fetch test result
    $arr2 = explode(":",$line3);
    $status = preg_replace('/\s+/', '', $arr2[1]);

    $line165 = $line[165];
    $arr3 = explode(":",$line165);
    $vers = preg_replace('/\s+/', '', $arr3[1]);
    
    echo "sn = $sn <br>status = $status <br>version = $vers<br><br>";
    // if(isset($data[$sn])){
    //     if(isset($data[$sn]['r'])){
    //         if($data[$sn]['r'] < $fdate){
    //             $data[$sn][0] = $sn;
    //             $data[$sn][3] =   $status[0];
    //             $data[$sn]['r'] =  $fdate;
    //         }
    //     }
    //     else{
    //         $data[$sn][3] =  $status[0];
    //         $data[$sn]['r'] =  $fdate;
    //     }
    // }
    // else{
    //     $data[$sn][0] = $sn;
    //     $data[$sn][3] =  $status[0];
    //     $data[$sn]['r'] =  $fdate;
    // }
    // rename($file, 'C:/iLOQ/RFS_skogen/logged/'.basename($file));
}

?>