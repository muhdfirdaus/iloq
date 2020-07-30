<?php 

include('../dist/includes/dbcon.php');
include('product_cfg.php');
	$box_id = $_POST['box_id'];
	$qty = $_POST['qty'];
	$no = $_POST['model'];
	$tmstmp = time(); 

	$allmodel = get_model($con);
	$allmodelNo = get_modelNo($con);
	$allmodelNo2 = get_modelNo2($con);
	$allmodel_name = get_model_name($con);
	$model = $allmodel[$no];
	$model_no = $allmodelNo[$no];
	$model_name = $allmodel_name[$no];
	$model_no2 = $allmodelNo2[$no];

	if((strpos($model_no,"M009249.1")!== false) ){//for K5 Key just proceed to print
		//Check for duplicate SN
		$dupmsg = 'Duplicate SN detected in: \n';
		$dupmsg_T = 0;
		for($i=1;$i<=$qty;$i++){
			$dup_detect = 0;
			for($c=1;$c<=$qty;$c++){
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

			$invalidmsg = '';
			$invalidsn = 0;
			for($i=1;$i<=$qty;$i++){
				$sn = $_POST['sn'.$i];
				if(strlen($sn)>9 && strlen($sn)<20){
					$invalidsn = 1;
					$invalidmsg.=$sn.' on line '.$i.' is invalid!\n';
				}
			}
			if($invalidsn){
				echo '<script type="text/javascript">alert("'.$invalidmsg.'");</script>';
				echo "<script>window.history.back();</script>"; 
			}
			else{
				//check for existing data
				$existmsg='';
				$testmsg='';
				$existed = 0;
				$testfailed=0;
				for($i=1;$i<=$qty;$i++){
					$sn= $_POST['sn'.$i];
					$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']!=0){
						$existed = 1;
						$existmsg.=$sn.' on line '.$i.' already exist in the system!\n';
					}
				}
				if($existed){
					echo '<script type="text/javascript">alert("'.$existmsg.'");</script>';
					echo "<script>window.history.back();</script>"; 
				}
				else{
					
					echo "<script type='text/javascript'>alert('All SN is OKAY!');</script>";
					echo "<script>window.history.back();</script>"; 
					
				}
			}
		}
	}
	else{
	
	$printlbl = 1;
	$model_no=="IQ-M009453-J-00"?$printlbl=0:$printlbl=1;
	//Check for duplicate SN
	$dupmsg = 'Duplicate SN detected in: \n';
    $dupmsg_T = 0;
    for($i=1;$i<=$qty;$i++){
        $dup_detect = 0;
        for($c=1;$c<=$qty;$c++){
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
		$testmsg='';
		$existed = 0;
		$testfailed=0;
		for($i=1;$i<=$qty;$i++){
			$sn= $_POST['sn'.$i];
			
			$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn='$sn'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query);
			if($row['cnt']!=0){
				$existed = 1;
				$existmsg.=$sn.' on line '.$i.' already exist in the system!\n';
			}
		}
		if($existed){
			echo '<script type="text/javascript">alert("'.$existmsg.'");</script>';
        	echo "<script>window.history.back();</script>"; 
		}
		else{

			for($i=1;$i<=$qty;$i++){
				$rfsissue = 0;
				$sn= $_POST['sn'.$i];
				if(strpos($model_name,"NFC")!== false){//temporary for NFC 
					$query=mysqli_query($con,"select result,fdate, count(*) as cnt from nfc_test where sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']==0 || $row['result']!="P"){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass NFC Core test yet!.\n';
					}
				}
				elseif(strpos($model_no,"IQ-M011795")!== false){//for D5  Core
					$printlbl = 0;
					$query=mysqli_query($con,"select result,count(*) as cnt from d5_burn where sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']==0 || ($row['result']!="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Burn-in test yet!.\n';
					}
				}
				elseif(strpos($model_no,"IQ-M011793")!== false){//for D5 FG
					$printlbl = 0;
					$query=mysqli_query($con,"select result,count(*) as cnt from d5_durability where sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']==0 || ($row['result']!="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
					}

					if($tempres = checkTempTest($sn,$con)){
						if($tempres['result']!="P"){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Temperature test yet.\n';
						}
					}
					else{
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Temperature test yet.\n';
					}
				}
				elseif(strpos($model_name,"SKOGEN KEY")!== false){//temporary for skogen  
					$printlbl = 0;
					$query=mysqli_query($con,"select lockTest,lDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']==0 || ($row['lockTest']!="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Lock test yet!.\n';
					}
				}
				else{
					$query=mysqli_query($con,"select lockTest, durTest, rfsTest,lDate,rDate,dDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']==0 || ($row['lockTest']!="P"&&$row['durTest']!="P"&&$row['rfsTest']!="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass ANY test yet!.\n';
					}
					elseif(($row['lockTest']=="P"&&$row['durTest']!="P"&&$row['rfsTest']=="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!\n';
					}
					elseif(($row['lockTest']!="P"&&$row['durTest']=="P"&&$row['rfsTest']=="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Lock test yet!\n';
					}
					elseif(($row['lockTest']=="P"&&$row['durTest']=="P"&&$row['rfsTest']!="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!\n';
					}
					elseif(($row['lockTest']!="P"&&$row['durTest']!="P"&&$row['rfsTest']=="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Lock & Durability test yet!\n';
					}
					elseif(($row['lockTest']!="P"&&$row['durTest']=="P"&&$row['rfsTest']!="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Lock & RFS test yet!\n';
					}
					elseif(($row['lockTest']=="P"&&$row['durTest']!="P"&&$row['rfsTest']!="P")){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass RFS & Durability test yet!\n';
					}
					elseif(($row['rDate']<=$row['dDate']||$row['rDate']<=$row['dDate'])){
						$testfailed = 1;
						$rfsissue = 1;
						$testmsg.=$sn.' on line '.$i.' RFS Test is not valid! Please start over test process.\n';
					}
				}

				if(strpos($model_name,"OUTDOOR")){

					if($tempres = checkTempTest($sn,$con)){
						$rdate = strtotime($row['rDate']);
						if($tempres['result']!="P"){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Temperature test yet.\n';
						}
						elseif($tempres['time_out']<$rdate && $rfsissue==0){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' RFS Test is not valid! Please start over test process.\n';
						}
					}
					else{
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Temperature test yet.\n';
					}

				}
				
			}
			if($testfailed){
				echo '<script type="text/javascript">alert("'.$testmsg.'");</script>';
				echo "<script>window.history.back();</script>"; 
			}
			else{
			
			
				
				echo "<script type='text/javascript'>alert('All data is OKAY!');</script>";
				echo "<script>window.history.back();</script>"; 
				
				
			}
		}
	}

		
	}

	function checkTempTest($sn,$con){
		
        $query=mysqli_query($con,"SELECT tt.id, tt.temperature, ts.sn, tt.time_out, ts.result
        FROM temp_test tt
        JOIN temp_test_sn ts ON tt.id = ts.batch_id
        WHERE ts.sn = $sn AND ts.result IS NOT NULL
        ORDER BY tt.id DESC")or die(mysqli_error($con));

        $rowcount=mysqli_num_rows($query);
		$retval = array();
        if($rowcount>=1){

            while($row = mysqli_fetch_assoc($query)) {

                if($row['temperature']==1){
					$timeout = date("YmdHis", $retval['time_out']);
                    isset($retval['result'])?$retval['result']=$retval['result']:$retval['result']=$row['result'];
                    isset($retval['time_out'])?$retval['time_out']=$retval['time_out']:$retval['time_out']=$timeout;
                }

                // if($row['temperature']==2){
					// $timeout = date("YmdHis", $retval['time_out']);
                //     isset($retval['result2'])?$retval['result2']=$retval['result2']:$retval['result2']=$row['result'];
                //     isset($retval['time_out2'])?$retval['time_out2']=$retval['time_out2']:$retval['time_out2']=$timeout;
                // }
            }
        }
        else{            
            $retval['result'] = '';
            $retval['time_out'] ='';
            // $retval['result2'] = '';
            // $retval['time_out2'] ='';
        }

		return $retval;
	}
	
?>
