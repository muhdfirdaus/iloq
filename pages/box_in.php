<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('../dist/includes/dbcon.php');
include('product_cfg.php');
	$box_info_id = $_POST['id'];
	$box_id = $_POST['box_id'];
	$scanned = $_POST['scanned'];
	$qty = $_POST['qty'];
	$no = $_POST['model'];
	$line = $_POST['line'];
	$id = $_SESSION['id'];
	$tmstmp = time(); 

	$allmodel = get_model($con);
	$allmodelNo = get_modelNo($con);
	$allmodelNo2 = get_modelNo2($con);
	$allmodel_name = get_model_name($con);
	$allshippn = get_shipPN($con);
	$model = $allmodel[$no];
	$model_no = $allmodelNo[$no];
	$model_name = $allmodel_name[$no];
	$model_no2 = $allmodelNo2[$no];
	$shippn = $allshippn[$no];

	$wrongmodel = 0;
	if(isset($_POST['modellbl1'])){
		$modellbl = $_POST['modellbl1'];
		$explbl = explode(".", $modellbl);
		$lblV = $explbl[1];
		$lblH = $explbl[2];

		$expmodel  = explode(".", $model_no2);
		$expmodel2 = explode("-", $expmodel[1]);
		$sysV = $expmodel2[0];
		$sysH = $expmodel2[1];

		if(($lblH !== $sysH)||($lblV !== $sysV)){
			$wrongmodel = 1;
		}
	}
	if($wrongmodel==1){
		echo '<script type="text/javascript">alert("Wrong model");</script>';
		echo "<script>window.history.back();</script>"; 
	}
	else{
		// if((strpos($model_no,"M009249.1")!== false) ){//for K5 Key just proceed to print
			
		// 		$invalidmsg = '';
		// 		$invalidsn = 0;
		// 		for($i=1;$i<=1;$i++){
		// 			$sn = $_POST['sn'.$i];
		// 			if(strlen($sn)>9 && strlen($sn)<20){
		// 				$invalidsn = 1;
		// 				$invalidmsg.=$sn.' on line '.$i.' is invalid!\n';
		// 			}
		// 		}
		// 		if($invalidsn){
		// 			echo '<script type="text/javascript">alert("'.$invalidmsg.'");</script>';
		// 			echo "<script>window.history.back();</script>"; 
		// 		}
		// 		else{
		// 			//check for existing data
		// 			$existmsg='';
		// 			$testmsg='';
		// 			$existed = 0;
		// 			$testfailed=0;
		// 			for($i=1;$i<=1;$i++){
		// 				$sn= $_POST['sn'.$i];
		// 				$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn='$sn'")or die(mysqli_error($con));
		// 				$row=mysqli_fetch_array($query);
		// 				if($row['cnt']!=0){
		// 					$existed = 1;
		// 					$existmsg.=$sn.' on line '.$i.' already exist in the system!\n';
		// 				}
		// 			}
		// 			if($existed){
		// 				echo '<script type="text/javascript">alert("'.$existmsg.'");</script>';
		// 				echo "<script>window.history.back();</script>"; 
		// 			}
		// 			else{
		// 				// mysqli_query($con,"INSERT INTO box_info(box_id,user_id,qty,timestamp,model_no,model)
		// 				// VALUES('$box_id','$id', '$qty', '$tmstmp', '$model_no2', '$model_name')")or die(mysqli_error($con));
		// 				mysqli_query($con, "UPDATE box_info set status=1 where box_id ='$box_id'")or die(mysqli_error($con));
		// 				echo "<script type='text/javascript'>alert('Data saved!');</script>";
						
		// 				$query=mysqli_query($con,"select ip from printer_cfg where name='Box$line'")or die(mysqli_error($con));
		// 				$row=mysqli_fetch_array($query);
		// 				$ip=$row['ip'];

		// 				//edit label file
		// 				$lbldate = date('d/m/y',$tmstmp);
		// 				$lblbox = '^XA

		// 				^FO60,45^GFA,1625,1625,25,,1FE,3FF,7FF8,7FFC,:IFCW01FF8R01FFC,IFC001FFEP01JF8Q0JFC,7FFC003FFEP0KFEP07KF8,7FFC003FFEO03LF8N01LF8,7FF8003FFEO0MFEN07LF8,3FF8003FFEN03NF8M0MF,3FFI03FFEN07NFCL03MF,0FCI03FFEN0OFEL07LFE018,L03FFEM01PFL0MFC03C,L03FFEM03PF8J01MFC03E,L03FFEM07PFCJ03MF807F,L03FFEM0QFEJ07MF00FF,L03FFEL01JFC007JFJ07JF00300FF8,L03FFEL01JFI01JF8I0JF8J01FFC,L03FFEL03IFCJ07IF8001JFK01FFE,7FF8003FFEL07IF8J03IFC001IFCK03FFE,7FF8003FFEL07FFEL0IFC003IF8K07IF,7FF8003FFEL0IFCL07FFE003IFL03IF,7FF8003FFEL0IFCL07FFE007FFEL01IF8,7FF8003FFEL0IF8L03FFE007FFCL01IF8,7FF8003FFEK01IFM01IF007FF8M0IF8,7FF8003FFEK01IFM01IF00IF8M07FFC,7FF8003FFEK01FFEN0IF80IF8M07FFC,7FF8003FFEK03FFEN0IF80IFN03FFC,7FF8003FFEK03FFCN07FF80IFN03FFC,7FF8003FFEK03FFCN07FF81IFN03FFC,7FF8003FFEK03FFCN07FF81FFEN01FFE,::::::7FF8003FFEK03FFCN07FF81IFN03FFC,7FF8003FFEK03FFCN07FF80IFN03FFC,7FF8003FFEK03FFEN0IF80IFN03FFC,7FF8003FFEK01FFEN0IF00IF8M07FFC,7FF8003FFEK01IFM01IF00IF8M07FFC,7FF8003FFEK01IFM01IF007FFCM0IF8,7FF8003FFEL0IF8L03FFE007FFCL01IF8,7FF8003FFEL0IFCL07FFE003FFEL01IF,7FF8003FFEL0IFEL07FFE003IFL03IF,7FF8003FFEL07IFL0IFC003IF8K07IF,7FF8003FFEL07IF8J03IFC001IFL0IFE,7FF8003FFEL03IFEJ07IF8001FFEK03IFC,7FF8003FFEL01JFI01JF8I0FFEK0JFC,7FF8003NF01JFE00KFJ07FC03807JF8,7FF8003MFE00QFEJ03FC03QF87FF8003MFE007PFCJ03F807QF87FF8003MFC003PF8J01F00RF,7FF8003MF8001PFL0F00RF,7FF8003MF8I0OFEL0601QFE,7FF8003MFJ07NFCN01QFE,7FF8003MFJ03NF8N03QFC,7FF8003LFEK0MFEO07QF8,7FF8003LFEK03LF8O07QF8,7FF8003LFCL0KFEP07QF,g01JFR0QF,gH07CT03NFE,^FS
						
						
						
						
						
							
		// 				^CFP,50,50
		// 				^FO450,55^FDwww.iloq.com^FS
						
		// 				^CFP,60,50
		// 				^FO50,130^FD'.$model_name.'^FS
						
		// 				^CFP,50,36
		// 				^FO50,190^FDPN: '.$model_no.'^FS
		// 				^FO600,190^FDQTY: '.$qty.'^FS
						
		// 				^BY2
		// 				^FO50,240^BCn,40,N^FD'.$model_no .'^FS
		// 				^FO580,240^BCn,40,N^FD'.$qty.'^FS
						
		// 				^FO50,295^FDBOX NO: '.$box_id.'^FS
		// 				^FO580,295^FDDATE: '.$lbldate.'^FS
						
		// 				^BY2
		// 				^FO50,345^BCn,40,N^FD'.$box_id.'^FS
		// 				^FO540,345^BCn,40,N^FD'.$lbldate.'^FS
						
		// 				^XZ';

		// 				// end of label editting


		// 				// function to ping ip address
		// 				function pingAddress($ip1) {
		// 					$pingresult = exec("ping -n 2 $ip1", $outcome, $status);
		// 					if (0 == $status) {//status-alive
		// 						$toReturn = true;
		// 					} else {//status-dead
		// 						$toReturn = false;
		// 					}
		// 					return $toReturn;
		// 				}
						
		// 				$printable = pingAddress($ip);
		// 				if($printable){
		// 					try//attempt to print label
		// 					{
		// 						// Number of seconds to wait for a response from remote host
		// 						$timeout = 2;
		// 						if($fp=@fsockopen($ip,9100, $errNo, $errStr, $timeout)){
		// 							fputs($fp,$lblbox);
		// 							fclose($fp);				
		// 							echo '<script type="text/javascript">alert("Label printed successfully!");</script>';
		// 							echo "<script>document.location='box_start.php'</script>";
		// 						}
		// 						else{
		// 							echo '<script type="text/javascript">alert("Printer is not available!");</script>';
		// 							echo "<script>document.location='box_start.php'</script>";
		// 						} 
		// 					}
		// 					catch (Exception $e) 
		// 					{
		// 						echo 'Caught exception: ',  $e->getMessage(), "\n";
		// 					}
		// 				}
		// 				else{
		// 					echo '<script type="text/javascript">alert("Printer is not available!");</script>';
		// 					echo "<script>document.location='box_start.php'</script>";
		// 				}
		// 			}
		// 		}
		// }
		if((strpos($model_no,"M011442.3")!== false)){//for NFC Padlock Grade 3
			
			$expall = $expall = explode("-",$model_no);
			$lblheight = $expall[2];
			if(($lblheight=="60")||($lblheight=="110")){
				//Check if SN is already in the system
				$sn1 = $_POST['sn1'];
				$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn in ('$sn1')")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']!=0){
					echo '<script type="text/javascript">alert("SN '.$sn1.' already exist in the system!");</script>';
					echo "<script>window.history.back();</script>"; 
				}
				else{
					$testfailed=0;
					$testmsg='';
					for($i=1;$i<=$qty;$i++){
						$rfsissue = 0;
						$sn= $_POST['sn'.$i];
						// $query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,ts.result AS thermaltest,
						// COUNT(*) AS cnt 
						// FROM padlock_test pt
						// LEFT JOIN temp_test_sn ts ON pt.sn = ts.sn
						// LEFT JOIN temp_test tt ON ts.batch_id=tt.id
						// WHERE tt.temperature=1 AND pt.sn='$sn'")or die(mysqli_error($con));
						$query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,
						(SELECT ts.result FROM temp_test_sn ts
						LEFT JOIN temp_test tt ON ts.batch_id=tt.id
						WHERE tt.temperature=1 AND ts.sn='$sn'
						ORDER BY ts.id DESC LIMIT 1) AS thermaltest,
						COUNT(*) AS cnt 
						FROM padlock_test pt
						WHERE pt.sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
						}
						else{
							if($row['iptest']!='P'){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass IP test yet!.\n';
							}
							if($row['satest']!='P'){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
							}
							if($row['rfstest']!='P'){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
							}
							if($row['thermaltest']!='P'){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Thermal test yet!.\n';
							}
						}
						$query=mysqli_query($con,"select count(*) as cnt from nfc_padlock where core_sn='$sn' or padlock_sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' have not do Padlock Pairing yet!.\n';
						}
					}
					if($testfailed==1){
						echo '<script type="text/javascript">alert("'.$testmsg.'");</script>';
						echo "<script>window.history.back();</script>"; 
					}
					else{
						mysqli_query($con,"INSERT INTO box_sn(box_id,sn)VALUES('$box_id','$sn1')")or die(mysqli_error($con));
						mysqli_query($con, "UPDATE box_info set status=1 where box_id ='$box_id'")or die(mysqli_error($con));
						echo "<script type='text/javascript'>alert('Data saved!');</script>";

						//set label content and send to print function
						$lbldate = date('j.n.Y');
						if(strpos($model_no,"M011442.341")!==false){
							$lblmodel='341.'.$lblheight;
						}
						else{
							$lblmodel='331.'.$lblheight;
						}
						// $lblbox = "^XA
								
						// ^FX first section
						// 		^FO350,100

						// 	^BXN,22,200
						// 	^FD$sn1^FS

						// 		^CFA,45
						// 		^FO360,400^FD$sn1^FS

						// 		^CFP,130,99
						// 		^FO180,490^FDH50S.$lblmodel.15.HC^FS
								
						// 		^CFA,50
						// 		^FO40,680^FD$lbldate^FS
								
						// ^FX secondsection

						// 		^FO1400,100

						// 	^BXN,22,200
						// 	^FD$sn2^FS

						// 		^CFA,45
						// 		^FO1410,400^FD$sn2^FS

						// 		^CFP,130,99
						// 		^FO1230,490^FDH50S.$lblmodel.15.HC^FS

						// 		^CFA,50
						// 		^FO1090,680^FD$lbldate^FS
						// 		^XZ ";
						$lblbox = "^XA
								
						^FX first section
								^FO360,100
			
							^BXN,15,200
							^FD$sn1^FS
			
								^CFA,30
								^FO380,320^FD$sn1^FS
			
								^CFP,80,90
								^FO220,370^FDH50S.$lblmodel.HC^FS
								
								^CFA,40
								^FO60,500^FD$lbldate^FS
								^XZ ";
						printpadlocklabel($lblbox,$line,$con);
					}
				}
			}
			else{
				//Check if SN is already in the system
				$sn1 = $_POST['sn1'];
				$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn='$sn1'")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']!=0){
					echo '<script type="text/javascript">alert("SN '.$sn1.','.$lblheight.' already exist in the system!");</script>';
					echo "<script>window.history.back();</script>"; 
				}
				else{
					$testfailed=0;
					$testmsg='';
					$rfsissue = 0;
					$sn= $_POST['sn1'];
					// $query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,ts.result AS thermaltest,
					// COUNT(*) AS cnt 
					// FROM padlock_test pt
					// LEFT JOIN temp_test_sn ts ON pt.sn = ts.sn
					// LEFT JOIN temp_test tt ON ts.batch_id=tt.id
					// WHERE tt.temperature=1 AND pt.sn='$sn'")or die(mysqli_error($con));
					$query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,
					(SELECT ts.result FROM temp_test_sn ts
					LEFT JOIN temp_test tt ON ts.batch_id=tt.id
					WHERE tt.temperature=1 AND ts.sn='$sn'
					ORDER BY ts.id DESC LIMIT 1) AS thermaltest,
					COUNT(*) AS cnt 
					FROM padlock_test pt
					WHERE pt.sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']==0){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
					}
					else{
						if($row['iptest']!='P'){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass IP test yet!.\n';
						}
						if($row['satest']!='P'){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
						}
						if($row['rfstest']!='P'){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
						}
						if($row['thermaltest']!='P'){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' not pass Thermal test yet!.\n';
						}
					}
					$query=mysqli_query($con,"select count(*) as cnt from nfc_padlock where core_sn='$sn' or padlock_sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']==0){
						$testfailed = 1;
						$testmsg.=$sn.' on line '.$i.' have not do Padlock Pairing yet!.\n';
					}
					if($testfailed==1){
						echo '<script type="text/javascript">alert("'.$testmsg.'");</script>';
						echo "<script>window.history.back();</script>"; 
					}
					else{
						mysqli_query($con,"INSERT INTO box_sn(box_id,sn)VALUES('$box_id','$sn1')")or die(mysqli_error($con));
						if(($scanned+1)==$qty){
							mysqli_query($con, "UPDATE box_info set status=1 where box_id ='$box_id'")or die(mysqli_error($con));
							echo "<script type='text/javascript'>alert('Data saved!');</script>";

							$query=mysqli_query($con,"select sn from box_sn where box_id='$box_id'")or die(mysqli_error($con));
							$i = 1;
							while($row=mysqli_fetch_array($query)){
							${"sn".$i} = $row['sn'];
							$i++;
							}
							//set label content and send to print function
							$lbldate = date('j.n.Y');
							if(strpos($model_no,"M011442.341")!==false){
								$lblmodel='341.'.$lblheight;
							}
							else{
								$lblmodel='331.'.$lblheight;
							}
							$lblbox = "^XA
									
							^FX first section
									^FO360,100
				
								^BXN,15,200
								^FD$sn1^FS
				
									^CFA,30
									^FO380,320^FD$sn1^FS
				
									^CFP,80,90
									^FO220,370^FDH50S.$lblmodel.HC^FS
									
									^CFA,40
									^FO60,500^FD$lbldate^FS
									^XZ ";
							$lblbox2 = "^XA
									
							^FX first section
									^FO360,100
				
								^BXN,15,200
								^FD$sn2^FS
				
									^CFA,30
									^FO380,320^FD$sn2^FS
				
									^CFP,80,90
									^FO220,370^FDH50S.$lblmodel.HC^FS
									
									^CFA,40
									^FO60,500^FD$lbldate^FS
									^XZ ";
									printpadlocklabel($lblbox,$line,$con,$lblbox2);
						}
						else{
							echo "<script>document.location='box_scan.php?id=$box_info_id'</script>"; 
						}
					}
				}
			}
			
		}
		elseif((strpos($model_no,"M009801.4")!== false)){//for NFC Padlock Grade 4
			//Check if SN is already in the system
			$sn1 = $_POST['sn1'];
			$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn = '$sn1'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query);
			if($row['cnt']!=0){
				echo '<script type="text/javascript">alert("SN already exist in the system!");</script>';
				echo "<script>window.history.back();</script>";  
			}
			else{
				$testfailed=0;
				$testmsg='';

				$sn= $_POST['sn1'];
				// $query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,ts.result AS thermaltest,
				// COUNT(*) AS cnt 
				// FROM padlock_test pt
				// LEFT JOIN temp_test_sn ts ON pt.sn = ts.sn
				// LEFT JOIN temp_test tt ON ts.batch_id=tt.id
				// WHERE tt.temperature=1 AND pt.sn='$sn'")or die(mysqli_error($con));
				$query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,
				(SELECT ts.result FROM temp_test_sn ts
				LEFT JOIN temp_test tt ON ts.batch_id=tt.id
				WHERE tt.temperature=1 AND ts.sn='$sn'
				ORDER BY ts.id DESC LIMIT 1) AS thermaltest,
				COUNT(*) AS cnt 
				FROM padlock_test pt
				WHERE pt.sn='$sn'")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']==0){
					$testfailed = 1;
					$testmsg.=$sn.' not pass any test yet!.\n';
				}
				else{
					// if($row['iptest']!='P'){
					// $testfailed = 1;
					// $testmsg.=$sn.' not pass IP test yet!.\n';
					// }
					if($row['satest']!='P'){
					$testfailed = 1;
					$testmsg.=$sn.' not pass SN Assign test yet!.\n';
					}
					if($row['rfstest']!='P'){
					$testfailed = 1;
					$testmsg.=$sn.' not pass RFS test yet!.\n';
					}
					if($row['thermaltest']!='P'){
					$testfailed = 1;
					$testmsg.=$sn.' not pass Thermal test yet!.\n';
					}
				}
				$query=mysqli_query($con,"select count(*) as cnt from nfc_padlock where core_sn='$sn' or padlock_sn='$sn'")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']==0){
					$testfailed = 1;
					$testmsg.=$sn.' have not do Padlock Pairing yet!.\n';
				}
				if($testfailed==1){
					echo '<script type="text/javascript">alert("'.$testmsg.'");</script>';
					echo "<script>window.history.back();</script>"; 
				}
				else{
					mysqli_query($con,"INSERT INTO box_sn(box_id,sn)VALUES('$box_id','$sn')")or die(mysqli_error($con));
					mysqli_query($con, "UPDATE box_info set status=1 where box_id ='$box_id'")or die(mysqli_error($con));
					echo "<script type='text/javascript'>alert('Data saved!');</script>";

					//set label content and send to print function
					$lbldate = date('j.n.Y');
					$expall = $expall = explode("-",$model_no);
					$lblheight = $expall[2];
					if(strpos($model_no,"M009801.431")!==false){
						$lblmodel='431.'.$lblheight;
					}
					else{
						$lblmodel='441.'.$lblheight;
					}
					// $lblbox = "^XA
							
					// ^FX first section
					// 		^FO850,100

					// 	^BXN,22,200
					// 	^FD$sn^FS

					// 		^CFA,45
					// 		^FO860,400^FD$sn^FS

					// 		^CFP,130,99
					// 		^FO600,490^FDH50S.$lblmodel.15.HC^FS
							
					// 		^CFA,50
					// 		^FO540,680^FD$lbldate^FS
					// 		^XZ ";
					
					$lblbox = "^XA
							
					^FX first section
							^FO360,100
		
						^BXN,15,200
						^FD$sn^FS
		
							^CFA,30
							^FO380,320^FD$sn^FS
		
							^CFP,80,90
							^FO220,370^FDH50S.$lblmodel.HC^FS
							
							^CFA,40
							^FO60,500^FD$lbldate^FS
							^XZ ";
					printpadlocklabel($lblbox,$line,$con);
				}
			}
		}
		elseif((strpos($model_no,"M010293.5")!== false)){//for NFC Padlock Grade 5
			//Check if SN is already in the system
			$sn1 = $_POST['sn1'];
			$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn = '$sn1'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query);
			if($row['cnt']!=0){
				echo '<script type="text/javascript">alert("SN already exist in the system!");</script>';
				echo "<script>window.history.back();</script>";  
			}
			else{
				$testfailed=0;
				$testmsg='';

				$sn= $_POST['sn1'];
				// $query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,ts.result AS thermaltest,
				// COUNT(*) AS cnt 
				// FROM padlock_test pt
				// LEFT JOIN temp_test_sn ts ON pt.sn = ts.sn
				// LEFT JOIN temp_test tt ON ts.batch_id=tt.id
				// WHERE tt.temperature=1 AND pt.sn='$sn'")or die(mysqli_error($con));
				$query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,
				(SELECT ts.result FROM temp_test_sn ts
				LEFT JOIN temp_test tt ON ts.batch_id=tt.id
				WHERE tt.temperature=1 AND ts.sn='$sn'
				ORDER BY ts.id DESC LIMIT 1) AS thermaltest,
				COUNT(*) AS cnt 
				FROM padlock_test pt
				WHERE pt.sn='$sn'")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']==0){
					$testfailed = 1;
					$testmsg.=$sn.' not pass any test yet!.\n';
				}
				else{
					// if($row['iptest']!='P'){
					// $testfailed = 1;
					// $testmsg.=$sn.' not pass IP test yet!.\n';
					// }
					if($row['satest']!='P'){
					$testfailed = 1;
					$testmsg.=$sn.' not pass SN Assign test yet!.\n';
					}
					if($row['rfstest']!='P'){
					$testfailed = 1;
					$testmsg.=$sn.' not pass RFS test yet!.\n';
					}
					if($row['thermaltest']!='P'){
					$testfailed = 1;
					$testmsg.=$sn.' not pass Thermal test yet!.\n';
					}
				}
				$query=mysqli_query($con,"select count(*) as cnt from nfc_padlock where core_sn='$sn' or padlock_sn='$sn'")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']==0){
					$testfailed = 1;
					$testmsg.=$sn.' have not do Padlock Pairing yet!.\n';
				}
				if($testfailed==1){
					echo '<script type="text/javascript">alert("'.$testmsg.'");</script>';
					echo "<script>window.history.back();</script>"; 
				}
				else{
					mysqli_query($con,"INSERT INTO box_sn(box_id,sn)VALUES('$box_id','$sn')")or die(mysqli_error($con));
					mysqli_query($con, "UPDATE box_info set status=1 where box_id ='$box_id'")or die(mysqli_error($con));
					echo "<script type='text/javascript'>alert('Data saved!');</script>";

					//set label content and send to print function
					$lbldate = date('j.n.Y');
					$expall = $expall = explode("-",$model_no);
					$lblheight = $expall[2];
					if(strpos($model_no,"M010293.531")!==false){
						$lblmodel='531.'.$lblheight;
					}
					else{
						$lblmodel='541.'.$lblheight;
					}
					// $lblbox = "^XA
							
					// ^FX first section
					// 		^FO850,100

					// 	^BXN,22,200
					// 	^FD$sn^FS

					// 		^CFA,45
					// 		^FO860,400^FD$sn^FS

					// 		^CFP,130,99
					// 		^FO600,490^FDH50S.$lblmodel.15.HC^FS
							
					// 		^CFA,50
					// 		^FO540,680^FD$lbldate^FS
					// 		^XZ ";
					
					$lblbox = "^XA
							
					^FX first section
							^FO360,100
		
						^BXN,15,200
						^FD$sn^FS
		
							^CFA,30
							^FO380,320^FD$sn^FS
		
							^CFP,80,90
							^FO220,370^FDH50S.$lblmodel.HC^FS
							
							^CFA,40
							^FO60,500^FD$lbldate^FS
							^XZ ";
					printpadlocklabel($lblbox,$line,$con);
				}
			}
		}
		elseif((strpos($shippn,"F50")!== false)){//for F50 Corona key safe
			//Check if SN is already in the system
			$sn = $_POST['sn1'];
			$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn = '$sn'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query);
			if($row['cnt']!=0){
				echo '<script type="text/javascript">alert("SN already exist in the system!");</script>';
				echo "<script>window.history.back();</script>";  
			}
			else{
				$testfailed=0;
				$testmsg='';
				$query=mysqli_query($con,"select count(*) as cnt, satest, durtest, rfstest FROM padlock_test WHERE sn ='$sn'")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']==0 ){
					$testfailed = 1;
					$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
				} 
				elseif(($row['durtest']!="P")){
					$testfailed = 1;
					$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
				}
				elseif(($row['satest']!="P")){
					$testfailed = 1;
					$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
				}
				elseif(($row['rfstest']!="P")){
					$testfailed = 1;
					$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
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
				if($testfailed==1){
					echo '<script type="text/javascript">alert("'.$testmsg.'");</script>';
					echo "<script>window.history.back();</script>"; 
				}
				else{
					mysqli_query($con,"INSERT INTO box_sn(box_id,sn)VALUES('$box_id','$sn')")or die(mysqli_error($con));
					mysqli_query($con, "UPDATE box_info set status=1 where box_id ='$box_id'")or die(mysqli_error($con));
					echo "<script type='text/javascript'>alert('Data saved!');</script>";

					$lbldate = date('j.n.Y');
					$lblbox="^XA
			
					^CF0,100
					^FO180,600^FD$shippn^FS

					^CF0,70
					^FO190,760^FD$lbldate^FS

					^CF0,80
					^FO980,710^FD$sn^FS

					^FO1060,520
					^BXN,11,200
					^FD$sn^FS

					^XZ";
					printpadlocklabel($lblbox,$line,$con);

				}

			}
		

		}
		elseif((strpos($model_no,"IQ-M012005")!== false)){//for D5 Vuolu 
			//Check if SN is already in the system
			$sn = $_POST['sn1'];
			$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn = '$sn'")or die(mysqli_error($con));
			$row=mysqli_fetch_array($query);
			if($row['cnt']!=0){
				echo '<script type="text/javascript">alert("SN already exist in the system!");</script>';
				echo "<script>window.history.back();</script>";  
			}
			else{
				$testfailed=0;
				$testmsg='';
				// $query=mysqli_query($con,"select result,count(*) as cnt from d5_burn where sn='$sn'")or die(mysqli_error($con));
				// $row=mysqli_fetch_array($query);
				// if($row['cnt']==0 || ($row['result']!="P")){
				// 	$testfailed = 1;
				// 	$testmsg.=$sn.' on line '.$i.' not pass Burn-in test yet!.\n';
				// }
				$query=mysqli_query($con,"select result,count(*) as cnt from d5_durability where sn='$sn'")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']==0 || ($row['result']!="P")){
					$testfailed = 1;
					$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
				}

				$query=mysqli_query($con,"select result,count(*) as cnt from d5_rfs where sn='$sn'")or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
				if($row['cnt']==0 || ($row['result']!="P")){
					$testfailed = 1;
					$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
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

				if($testfailed==1){
					echo '<script type="text/javascript">alert("'.$testmsg.'");</script>';
					echo "<script>window.history.back();</script>"; 
				}
				else{
					mysqli_query($con,"INSERT INTO box_sn(box_id,sn)VALUES('$box_id','$sn')")or die(mysqli_error($con));
					
					if(($scanned+1)==$qty){
						mysqli_query($con, "UPDATE box_info set status=1 where box_id ='$box_id'")or die(mysqli_error($con));
						echo "<script type='text/javascript'>alert('Data saved!');</script>";

						$lbldate = date('j.n.Y');
						$lblbox="^XA
				
						^CF0,100
						^FO180,600^FD$shippn^FS

						^CF0,70
						^FO190,760^FD$lbldate^FS

						^FO1060,520
						^BXN,11,200
						^FD$shippn^FS

						^XZ";
						printpadlocklabel($lblbox,$line,$con);

						if(strpos($model_name,"SKOGEN")!==false){
							if(strpos($model_no,"M010267")!==false){
								$swversion = "1.5.10W";
							}
							else{
								$swversion = "1.5.17W";
							}    
						}
						elseif((strpos($model_no2,"M010358")!==false)||(strpos($model_no2,"M010349")!==false)||(strpos($model_no2,"M010339")!==false)||(strpos($model_no2,"M010308")!==false)||(strpos($model_no2,"M010356")!==false)){
							$swversion = "1.5.17W";
						}
						else{
							$swversion = "2.9";
						}
						$lblbox2 ="^XA
						^CFP,180,120
						^FO60,50^FD$model_no2^FS
						
						^CFP,190,230
						^FO40,280^FD$box_id^FS
						^FO38,280^FD$box_id^FS
						^FO40,282^FD$box_id^FS
						
						^CFP,180,180
						^FO40,510^FD$lbldate^FS
					
						^CFP,150,140
						^FO40,720^FDS/W Ver:$swversion^FS
						
						^XZ";

						//function to print second label

						// if($line==2){
						// 	printpizzaline2($lblbox2);
						// }
						// else{
							$filename = "lbliloq2.txt";
							$file = fopen($filename, "r+")or die("ERROR: Cannot open the file .")  ;
							if($file){
								fwrite($file, $lblbox2);      
								fclose($file);
							} 

							//print second label
							copy($filename, "//BTS-iLOQ-1/iloqpizza"); 
						// }
					}
					else{
						echo "<script>document.location='box_scan.php?id=$box_info_id'</script>"; 
					}

				}

			}
		

		}
		// elseif((strpos($model_no,"M011795.1")!== false) ){//for D5 just proceed to print
		// 	//Check for duplicate SN
		// 	$dupmsg = 'Duplicate SN detected in: \n';
		// 	$dupmsg_T = 0;
		// 	for($i=1;$i<=$qty;$i++){
		// 		$dup_detect = 0;
		// 		for($c=1;$c<=$qty;$c++){
		// 			if($c!=$i){
		// 				$_POST['sn'.$i]==$_POST['sn'.$c]?$dup_detect=1:$dup_detect=$dup_detect;
		// 			}
		// 		}
		// 		$dup_detect==1?$dupmsg.='-line '.$i.'\n':$dupmsg = $dupmsg;
		// 		$dup_detect==1?$dupmsg_T = 1: $dupmsg_T=$dupmsg_T;
		// 	}
		// 	if($dupmsg_T==1){
		// 		echo '<script type="text/javascript">alert("'.$dupmsg.'");</script>';
		// 		echo "<script>window.history.back();</script>"; 
		// 	}
		// 	else{
		// 		//check for existing data
		// 		$existmsg='';
		// 		$testmsg='';
		// 		$existed = 0;
		// 		$testfailed=0;
		// 		for($i=1;$i<=$qty;$i++){
		// 			$sn= $_POST['sn'.$i];
		// 			$query=mysqli_query($con,"select count(*) as cnt from box_sn where sn='$sn'")or die(mysqli_error($con));
		// 			$row=mysqli_fetch_array($query);
		// 			if($row['cnt']!=0){
		// 				$existed = 1;
		// 				$existmsg.=$sn.' on line '.$i.' already exist in the system!\n';
		// 			}
		// 		}
		// 		if($existed){
		// 			echo '<script type="text/javascript">alert("'.$existmsg.'");</script>';
		// 			echo "<script>window.history.back();</script>"; 
		// 		}
		// 		else{
		// 			mysqli_query($con,"INSERT INTO box_info(box_id,user_id,qty,timestamp,model_no,model)
		// 			VALUES('$box_id','$id', '$qty', '$tmstmp', '$model_no2', '$model_name')")or die(mysqli_error($con));
		// 			echo "<script type='text/javascript'>alert('Data saved!');</script>";
					
		// 			$query=mysqli_query($con,"select ip from printer_cfg where id=1")or die(mysqli_error($con));
		// 			$row=mysqli_fetch_array($query);
		// 			$ip=$row['ip'];

		// 			//edit label file
		// 			$lbldate = date('d/m/y',$tmstmp);
		// 			$lblbox = '^XA
					
		// 			^FO30,10^GFA,12412,12412,58,,::::::::::::::::::::::::::::::::::::::O07FE,N01IF8,N03IFE,N0KF,M01KF8,:M03KFC,M07KFE,::M0MF,M0MFgW07FF8gN01IF8,M0MFgU01KFEgL03KFE,M0MFgT01MFEgJ03MFE,M0MFL07KFCgG0OFEgH03OFC,M0MFL07KFCg07PFCgG0QF8,M0MFL07KFCY01RFg07QFE,M07LFL07KFCY0SFCX01SF,M07KFEL07KFCX03TFX07RFE,M07KFEL07KFCX07TF8W0SFC,M03KFCL07KFCW01UFEV03SFC,M03KFCL07KFCW07VF8U07SF8,M01KF8L07KFCW0WFCT01TF8,N0KFM07KFCV01XFT03TF,N07IFEM07KFCV03XF8S0TFE,N01IFCM07KFCV0YFCR01TFEI018,O0IFN07KFCU01YFER03TFCI03C,O01F8N07KFCU03gFR07TF8I03E,g07KFCU07gF8Q0UF8I07F,g07KFCU0gGFCP01UFJ07F8,g07KFCT01gGFEP03TFEJ0FFC,g07KFCT03gHFP07TFEI01FFE,g07KFCT07gHF8O0UFCI01IF,g07KFCT07gHFCN01UFCI03IF8,g07KFCT0gIFCN01UF8I07IF8,g07KFCS01PFI03OFEN03OFEI03FJ07IFC,g07KFCS03OFK03OFN07NFEK07J0JFE,g07KFCS03NFCL07NF8M07NFQ0KF,g07KFCS07MFEM01NF8M0NFCP01KF,g07KFCS0NF8N07MFCL01NFQ03KF8,g07KFCS0NFO01MFEL01MFCQ03KFC,M03KFCL07KFCR01MFCP0MFEL03MF8Q07KFC,M03KFCL07KFCR01MF8P07MFL03MFR0LFE,M03KFCL07KFCR03MFQ01MFL07LFER0LFE,M03KFCL07KFCR03LFER0MF8K07LF8Q01MF,M03KFCL07KFCR07LFCR07LF8K0MFS0MF,M03KFCL07KFCR07LF8R03LFCK0MFS07LF8,M03KFCL07KFCR0MFS01LFCJ01LFES03LF8,M03KFCL07KFCR0LFES01LFEJ01LFCS03LFC,M03KFCL07KFCQ01LFCT0LFEJ03LF8S01LFC,M03KFCL07KFCQ01LFCT07KFEJ03LFU0LFC,M03KFCL07KFCQ01LF8T03LFJ03LFU07KFE,M03KFCL07KFCQ03LFU03LFJ07KFEU07KFE,M03KFCL07KFCQ03LFU01LFJ07KFEU03KFE,M03KFCL07KFCQ03KFEU01LF8I07KFCU03LF,M03KFCL07KFCQ07KFEV0LF8I0LFCU01LF,M03KFCL07KFCQ07KFCV0LF8I0LF8U01LF,M03KFCL07KFCQ07KFCV07KF8I0LF8V0LF,M03KFCL07KFCQ07KF8V07KFCI0LFW0LF8,:M03KFCL07KFCQ0LF8V03KFC001LFW07KF8,M03KFCL07KFCQ0LFW03KFC001KFEW07KF8,::M03KFCL07KFCQ0LFW01KFC001KFEW03KFC,M03KFCL07KFCQ0LFW01KFE001KFEW03KFC,:M03KFCL07KFCQ0KFEW01KFE001KFCW03KFC,::::::M03KFCL07KFCQ0LFW01KFE001KFEW03KFC,:M03KFCL07KFCQ0LFW01KFC001KFEW03KFC,M03KFCL07KFCQ0LFW03KFC001KFEW07KF8,:M03KFCL07KFCQ0LFW03KFC001LFW07KF8,M03KFCL07KFCQ0LF8V03KFC001LFW07KF8,M03KFCL07KFCQ07KF8V07KFCI0LFW0LF8,:M03KFCL07KFCQ07KFCV07KF8I0LF8V0LF,M03KFCL07KFCQ07KFCV0LF8I0LF8U01LF,M03KFCL07KFCQ03KFEV0LF8I07KFCU01LF,M03KFCL07KFCQ03KFEU01LF8I07KFCU03LF,M03KFCL07KFCQ03LFU01LFJ07KFEU03KFE,M03KFCL07KFCQ03LFU03LFJ07KFEU07KFE,M03KFCL07KFCQ01LF8T03LFJ03LFU07KFE,M03KFCL07KFCQ01LFCT07KFEJ03LF8T0LFC,M03KFCL07KFCQ01LFCT0LFEJ01LF8S01LFC,M03KFCL07KFCR0LFES01LFEJ01LFCS03LFC,M03KFCL07KFCR0MFS01LFCJ01LFES03LF8,M03KFCL07KFCR07LF8R03LFCK0MFS07LF8,M03KFCL07KFCR07LFCR07LF8K0MF8R0MF,M03KFCL07KFCR03LFER0MF8K07LFCQ01MF,M03KFCL07KFCR03MFQ03MFL07LF8Q03LFE,M03KFCL07KFCR01MF8P07MFL03LF8Q0MFE,M03KFCL07KFCR01MFEP0MFEL03LFQ01MFC,M03KFCL07KFCS0NFO03MFEL01KFEQ07MFC,M03KFCL07KFCS0NFCN07MFCM0KFEQ0NF8,M03KFCL07KFCS07MFEM01NF8M0KFCP03NF,M03KFCL07KFCS03NFCL07NF8M07JFCP0OF,M03KFCL07VFI03OF8J03OFN07JF8I07K07NFE,M03KFCL07UFEI01PF8003OFEN03JFJ07FI07OFC,M03KFCL07UFCJ0gIFCN01JFJ0gIFD,M03KFCL07UFCJ07gHFCO0IFEI01gJF,M03KFCL07UF8J07gHF8O07FFEI01gIFE,M03KFCL07UF8J03gHFP03FFCI03gIFC,M03KFCL07UFK01gGFEP03FF8I03gIFC,M03KFCL07UFL0gGFCP01FFJ07gIF8,M03KFCL07TFEL07gF8Q0FFJ0gJF8,M03KFCL07TFCL03gFR07EJ0gJF,M03KFCL07TFCL01YFER01EI01gIFE,M03KFCL07TF8M07XFCS0CI03gIFC,M03KFCL07TF8M03XF8W03gIFC,M03KFCL07TFN01WFEX07gIF8,M03KFCL07TFO0WFCX0gJF8,M03KFCL07SFEO03VF8X0gJF,M03KFCL07SFCO01UFEX01gIFE,M03KFCL07SFCP07TF8X01gIFE,M03KFCL07SF8P01SFEY03gIFC,M03KFCL07SF8Q07RFCY07gIFC,M03KFCL07SFR01RFg03gIF8,M03KFCL07SFS07PF8gG0gIF,M03KFCL07RFET0OFCgH01gHF,hN01MFEgJ01gFE,hO01KFEgL01YFC,hR0FCgP01WFC,,::::::::::::::::::::::::::::::::::::::::::::^FS

		// 			^CFP,120,99
		// 			^FO840,70^FDwww.iloq.com^FS
					
		// 			^CFP,130,99
		// 			^FO45,220^FD'.$model_name.'^FS
					
		// 			^CFP,120,85
		// 			^FO45,330^FDPN: '.$model_no.'^FS
		// 			^FO1160,330^FDQTY: '.$qty.'^FS
					
		// 			^BY5,2
		// 			^FO45,430^BCn,80,N^FD'.$model_no.'^FS
		// 			^FO1150,430^BCn,80,N^FD'.$qty.'^FS
					
		// 			^FO45,555^FDBOX NO: '.$box_id.'^FS
		// 			^FO1000,555^FDDATE: '.$lbldate.'^FS
					
		// 			^BY5,2
		// 			^FO45,655^BCn,80,N^FD'.$box_id.'^FS
		// 			^FO1000,655^BCn,80,N^FD'.$lbldate.'^FS
					
		// 			^XZ';

		// 			if(strpos($model_name,"SKOGEN")!==false){
		// 				$swversion = "1.5.12W";
		// 			}
		// 			else{
		// 				$swversion = "2.6";
		// 			}
		// 			$lblbox2 ="^XA
		// 			^CFP,180,120
		// 			^FO60,50^FD$model_no2^FS
					
		// 			^CFP,190,230
		// 			^FO40,280^FD$box_id^FS
		// 			^FO38,280^FD$box_id^FS
		// 			^FO40,282^FD$box_id^FS
					
		// 			^CFP,180,180
		// 			^FO40,510^FD$lbldate^FS
				
		// 			^CFP,150,140
		// 			^FO40,720^FDS/W Ver:$swversion^FS
					
		// 			^XZ";

		// 			// end of label editting


		// 			// function to ping ip address
		// 			function pingAddress($ip1) {
		// 				$pingresult = exec("ping -n 2 $ip1", $outcome, $status);
		// 				if (0 == $status) {//status-alive
		// 					$toReturn = true;
		// 				} else {//status-dead
		// 					$toReturn = false;
		// 				}
		// 				return $toReturn;
		// 			}
					
		// 			$printable = pingAddress($ip);
		// 			if($printable){
		// 				try//attempt to print label
		// 				{
		// 					// Number of seconds to wait for a response from remote host
		// 					$timeout = 2;
		// 					if($fp=@fsockopen($ip,9100, $errNo, $errStr, $timeout)){
		// 						fputs($fp,$lblbox);
		// 						fclose($fp);				
		// 						echo '<script type="text/javascript">alert("Label printed successfully!");</script>';
		// 						echo "<script>window.history.back();</script>"; 
		// 					}
		// 					else{
		// 						echo '<script type="text/javascript">alert("Printer is not available!");</script>';
		// 						echo "<script>window.history.back();</script>";  
		// 					} 
		// 				}
		// 				catch (Exception $e) 
		// 				{
		// 					echo 'Caught exception: ',  $e->getMessage(), "\n";
		// 				}
		// 			}
		// 			else{
		// 				echo '<script type="text/javascript">alert("Printer is not available!");</script>';
		// 				echo "<script>window.history.back();</script>";  
		// 			}
		// 		}
		// 	}
		// }
		else{
		
		$printlbl = 1;
		$model_no=="IQ-M009453-J-00"?$printlbl=0:$printlbl=1;

		$snlength2msg = 'Wrong SN length for selected model in: \n';
		$snlength2_T = 0;
		for($i=1;$i<=1;$i++){
			if(strpos($model_name,"OVAL")!== false){
				if(strlen($_POST['sn'.$i])!==8){
					$snlength2_T=1;
					$snlength2msg.='-line '.$i.'\n';
				}
			}
			elseif(strpos($model_name,"SKOGEN")!== false){
				if(strlen($_POST['sn'.$i])!==9){
					$snlength2_T=1;
					$snlength2msg.='-line '.$i.'\n';
				}
			}
			elseif(strpos($model_name,"CAM LOCK")!== false){
				if(strpos($model_no,"IQ-M0103")!== false){				
					if(strlen($_POST['sn'.$i])!==9){
						$snlength2_T=1;
						$snlength2msg.='-line '.$i.'\n';
					}
				}
				elseif(strpos($model_no,"IQ-M005")!== false){				
					if(strlen($_POST['sn'.$i])!==8){
						$snlength2_T=1;
						$snlength2msg.='-line '.$i.'\n';
					}
				}
			}
		}
		if($snlength2_T==1){
			echo '<script type="text/javascript">alert("'.$snlength2msg.'");</script>';
			echo "<script>window.history.back();</script>"; 
		}
		else{

			//check for NFC Padlock pairing record
			if(strpos($model_name,"PADLOCK")!== false){
				$pairingmsg = 'No pairing record for: \n';
				$pairingmsgT = 0;
				for($i=1;$i<=$qty;$i++){
					$sn = $_POST['sn'.$i];
					$query=mysqli_query($con,"select count(*) as cnt from nfc_padlock where core_sn='$sn' or padlock_sn='$sn'")or die(mysqli_error($con));
					$row=mysqli_fetch_array($query);
					if($row['cnt']!=0){
						$pairingmsgT=1;
						$pairingmsg.='- '.$sn.' in line : '.$i.'\n';
					}

				}
				if($pairingmsgT==1){
					echo '<script type="text/javascript">alert("'.$pairingmsg.'");</script>';
					echo "<script>window.history.back();</script>"; 
				}

			}
			
			//check for existing data
			$existmsg='';
			$testmsg='';
			$existed = 0;
			$testfailed=0;
			for($i=1;$i<=1;$i++){
				$sn= $_POST['sn'.$i];

				//check if serial number have reached maximum range to engineers
				if($sn == '16194999'){
					notificationemail('iLOQ Oval Lock Serial Number (IQ-2061-xx)','16194999');
				}
				if($sn == '138407031'){
					notificationemail('iLOQ Skogen Lock Serial Number (IQ-2083-xx)','138407031');
				}
				if($sn == '113241207'){
					notificationemail('iLOQ Skogen Key Serial Number (IQ-2109-xx)','113241207');
				}
				if($sn == '63994999'){
					notificationemail('iLOQ NFC Core Serial Number (IQ-2100-xxxx)','16194999');
				}
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

				for($i=1;$i<=1;$i++){
					$rfsissue = 0;
					$sn= $_POST['sn'.$i];

					/*
					Check if need to print label
					$printlbl
					0 = no label to be printed
					1 = one label to be printed
					2 = two label to be printed
					*/
					if(strpos($model_name,"G50")!== false){//For G50 PVT
						$printlbl = 2;
						$query=mysqli_query($con,"select count(*) as cnt, satest, durtest,iptest, rfstest FROM padlock_test WHERE sn ='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 ){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
						} 
						elseif(($row['durtest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
						}
						elseif(($row['satest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
						}
						elseif(($row['rfstest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
						}
						elseif(($row['iptest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass iP test yet!.\n';
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

						$query=mysqli_query($con,"select count(*) as cnt,core_sn from nfc_padlock where padlock_sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' have not do SN Pairing yet!.\n';
						}
						else{
							$coresn = $row['core_sn'];
							$query=mysqli_query($con,"select count(*) as cnt,result from nfc_test where sn='$coresn'")or die(mysqli_error($con));
							$row=mysqli_fetch_array($query);
							if($row['cnt']==0 || $row['result']!="P"){
								$testfailed = 1;
								$testmsg.=$sn.' on line '.$i.' have not passed NFC Core test yet!.\n';
							}
						}
						
					}
					elseif(strpos($model_name,"NFC")!== false){//temporary for NFC 
						$printlbl = 1;
						$query=mysqli_query($con,"select result,fdate, count(*) as cnt from nfc_test where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || $row['result']!="P"){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass NFC Core test yet!.\n';
						}
					}
					elseif(strpos($model_no,"IQ-M013218")!== false){//for NFC Middle core
						$printlbl = 1;
						$query=mysqli_query($con,"select result,fdate, count(*) as cnt from nfc_test where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || $row['result']!="P"){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass NFC Core test yet!.\n';
						}
					}
					elseif(strpos($model_no,"M011259")!== false){//for NFC core short
						$printlbl = 1;
						$query=mysqli_query($con,"select result,fdate, count(*) as cnt from nfc_test where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || $row['result']!="P"){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass NFC Core test yet!.\n';
						}
					}
					elseif(strpos($model_no,"IQ-M011795")!== false){//for D5  Core
						$printlbl = 1;
						$query=mysqli_query($con,"select result,count(*) as cnt from d5_burn where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || ($row['result']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Burn-in test yet!.\n';
						}

						// $query=mysqli_query($con,"select result,count(*) as cnt from d5_rfs where sn='$sn'")or die(mysqli_error($con));
						// $row=mysqli_fetch_array($query);
						// if($row['cnt']==0 || ($row['result']!="P")){
						// 	$testfailed = 1;
						// 	$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
						// }
					}
					elseif(strpos($model_no,"IQ-M013208")!== false){//for D5 3E
						$printlbl = 1;
						$query=mysqli_query($con,"select result,count(*) as cnt from d5_burn where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || ($row['result']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Burn-in test yet!.\n';
						}
					}
					elseif(strpos($model_name,"CAM LOCK")!== false){//for Camlock model
						$printlbl = 2;
						$query=mysqli_query($con,"select rfsTest,durTest,count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 ){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
						}
						elseif(($row['durTest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
						}
						elseif(($row['rfsTest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
						}
					}
					elseif(strpos($model_name,"OBELIX")!== false){//for Obelix Model

						$printlbl = 2;
						$query=mysqli_query($con,"select count(*) as cnt, satest, durtest, rfstest FROM padlock_test WHERE sn ='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 ){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
						} 
						elseif(($row['durtest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
						}
						elseif(($row['satest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
						}
						elseif(($row['rfstest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
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
						
						$query=mysqli_query($con,"select count(*) as cnt,core_sn from nfc_padlock where padlock_sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' have not do Padlock Pairing yet!.\n';
						}
						else{
							$coresn = $row['core_sn'];
							$query=mysqli_query($con,"select count(*) as cnt,result from nfc_test where sn='$coresn'")or die(mysqli_error($con));
							$row=mysqli_fetch_array($query);
							if($row['cnt']==0 || $row['result']!="P"){
								$testfailed = 1;
								$testmsg.=$sn.' on line '.$i.' have not passed NFC Main PWB test yet!.\n';
							}
						}

					}
					elseif(strpos($model_no,"IQ-M011793")!== false){//for D5 FG
						$printlbl = 2;
						$query=mysqli_query($con,"select result,count(*) as cnt from d5_durability where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || ($row['result']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
						}

						$query=mysqli_query($con,"select result,count(*) as cnt from d5_rfs where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || ($row['result']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
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
					elseif(strpos($model_no,"IQ-M010475")!== false){//for D5 core
						$printlbl = 1;
						$query=mysqli_query($con,"select result,count(*) as cnt from d5_burn where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || ($row['result']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass burn-in test yet!.\n';
						}
					}
					elseif(strpos($model_no,"IQ-M010158")!== false){//for D5 FG
						$printlbl = 2;
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
					elseif(strpos($model_no,"IQ-M009453-J-00")!== false){//temporary for skogen  
						$printlbl = 2;
						$query=mysqli_query($con,"select lockTest,lDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || ($row['lockTest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Lock test yet!.\n';
						}
					}
					elseif(strpos($model_no,"IQ-M010243")!== false){//For Key PCBA Potted  
						$printlbl = 2;
						$query=mysqli_query($con,"select lockTest,lDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || ($row['lockTest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Lock test yet!.\n';
						}
					}
					elseif(strpos($model_name,"KEY-TUBE")!== false){//For keytube
						$printlbl = 2;
						$query=mysqli_query($con,"select lockTest,rfsTest,durTest, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 || ($row['durTest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
						}
						if($row['cnt']==0 || ($row['rfsTest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
						}
						if($row['cnt']==0 || ($row['lockTest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass FCT test yet!.\n';
						}
					
					}
					elseif(strpos($model_name,"KEY SAFE")!== false){//For F50 Corona Key Safe
						$printlbl = 2;
						$query=mysqli_query($con,"select count(*) as cnt, satest, durtest, rfstest FROM padlock_test WHERE sn ='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 ){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
						} 
						elseif(($row['durtest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
						}
						elseif(($row['satest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
						}
						elseif(($row['rfstest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
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
						
						// $query=mysqli_query($con,"select count(*) as cnt,core_sn from nfc_padlock where padlock_sn='$sn'")or die(mysqli_error($con));
						// $row=mysqli_fetch_array($query);
						// if($row['cnt']==0){
						// 	$testfailed = 1;
						// 	$testmsg.=$sn.' on line '.$i.' have not do Padlock Pairing yet!.\n';
						// }
						// else{
						// 	$coresn = $row['core_sn'];
						// 	$query=mysqli_query($con,"select count(*) as cnt,result from nfc_test where sn='$coresn'")or die(mysqli_error($con));
						// 	$row=mysqli_fetch_array($query);
						// 	if($row['cnt']==0 || $row['result']!="P"){
						// 		$testfailed = 1;
						// 		$testmsg.=$sn.' on line '.$i.' have not passed NFC Main PWB test yet!.\n';
						// 	}
						// }
						
					}
					elseif(strpos($model_name,"D50")!== false){//For obelix D50x and s
						$printlbl = 2;
						$query=mysqli_query($con,"select count(*) as cnt, satest, durtest, rfstest FROM padlock_test WHERE sn ='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0 ){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
						} 
						elseif(($row['durtest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!.\n';
						}
						elseif(($row['satest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
						}
						elseif(($row['rfstest']!="P")){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
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
						
						$query=mysqli_query($con,"select count(*) as cnt,core_sn from nfc_padlock where padlock_sn='$sn'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						if($row['cnt']==0){
							$testfailed = 1;
							$testmsg.=$sn.' on line '.$i.' have not do Padlock Pairing yet!.\n';
						}
						else{
							$coresn = $row['core_sn'];
							$query=mysqli_query($con,"select count(*) as cnt,result from nfc_test where sn='$coresn'")or die(mysqli_error($con));
							$row=mysqli_fetch_array($query);
							if($row['cnt']==0 || $row['result']!="P"){
								$testfailed = 1;
								$testmsg.=$sn.' on line '.$i.' have not passed NFC Main PWB test yet!.\n';
							}
						}
						// $query=mysqli_query($con,"SELECT pt.iptest,pt.satest,pt.rfstest,ts.result AS thermaltest,
						// COUNT(*) AS cnt 
						// FROM padlock_test pt
						// LEFT JOIN temp_test_sn ts ON pt.sn = ts.sn
						// LEFT JOIN temp_test tt ON ts.batch_id=tt.id
						// WHERE tt.temperature=1 AND pt.sn='$sn'")or die(mysqli_error($con));
						// $row=mysqli_fetch_array($query);
						// if($row['cnt']==0){
						// 	$testfailed = 1;
						// 	$testmsg.=$sn.' on line '.$i.' not pass any test yet!.\n';
						// }
						// else{
						// 	if($row['iptest']!='P'){
						// 	$testfailed = 1;
						// 	$testmsg.=$sn.' on line '.$i.' not pass IP test yet!.\n';
						// 	}
						// 	if($row['satest']!='P'){
						// 	$testfailed = 1;
						// 	$testmsg.=$sn.' on line '.$i.' not pass SN Assign test yet!.\n';
						// 	}
						// 	if($row['rfstest']!='P'){
						// 	$testfailed = 1;
						// 	$testmsg.=$sn.' on line '.$i.' not pass RFS test yet!.\n';
						// 	}
						// 	if($row['thermaltest']!='P'){
						// 	$testfailed = 1;
						// 	$testmsg.=$sn.' on line '.$i.' not pass Thermal test yet!.\n';
						// 	}
						// }
						// $query=mysqli_query($con,"select count(*) as cnt from nfc_padlock where core_sn='$sn' or padlock_sn='$sn'")or die(mysqli_error($con));
						// $row=mysqli_fetch_array($query);
						// if($row['cnt']==0){
						// 	$testfailed = 1;
						// 	$testmsg.=$sn.' on line '.$i.' have not do Padlock Pairing yet!.\n';
						// }
						
					}
					// elseif(strpos($model_name,"OVAL LOCK INDOOR C5S.10.SB")!== false){//temporary for skogen 
					// 	$query=mysqli_query($con,"select lockTest, durTest, rfsTest,lDate,rDate,dDate, count(*) as cnt from sn_master where sn='$sn'")or die(mysqli_error($con));
					// 	$row=mysqli_fetch_array($query);
					// 	if($row['cnt']==0 || ($row['lockTest']!="P"&&$row['durTest']!="P")){
					// 		$testfailed = 1;
					// 		$testmsg.=$sn.' on line '.$i.' not pass ANY test yet!.\n';
					// 	}
					// 	elseif(($row['lockTest']=="P"&&$row['durTest']!="P")){
					// 		$testfailed = 1;
					// 		$testmsg.=$sn.' on line '.$i.' not pass Durability test yet!\n';
					// 	}
					// 	elseif(($row['lockTest']!="P"&&$row['durTest']=="P")){
					// 		$testfailed = 1;
					// 		$testmsg.=$sn.' on line '.$i.' not pass Lock test yet!\n';
					// 	}
					// }
					else{
						if(strpos($model_no,"IQ-M009453")!== false){//for D5 FG
							$printlbl = 1;
						}
						else{
							$printlbl = 2;
						}
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

					if(strpos($model_name,"OUTDOOR")!==false){

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
					

					if(strpos($model_name,"INDOOR")!==false){
						if($tempres = checkTempTest($sn,$con)){
							$rdate = strtotime($row['rDate']);
							if($tempres['result']=="P"){
								$testfailed = 1;
								$testmsg.=$sn.' on line '.$i.' is for Outdoor model.\n';
							}
						}
					}
				}
				if($testfailed){
					echo '<script type="text/javascript">alert("'.$testmsg.'");</script>';
					echo "<script>window.history.back();</script>"; 
				}
				else{
					$sn= $_POST['sn1'];
					mysqli_query($con,"INSERT INTO box_sn(box_id,sn)VALUES('$box_id','$sn')")or die(mysqli_error($con));
					
					if(($scanned+1)==$qty){
						mysqli_query($con, "UPDATE box_info set status=1 where box_id ='$box_id'")or die(mysqli_error($con));
						echo "<script type='text/javascript'>alert('Data saved!');</script>";
						
						$query=mysqli_query($con,"select ip from printer_cfg where name='Box$line'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
						$ip=$row['ip'];

						//edit label file
						$lbldate = date('d/m/y',$tmstmp);
						$lblbox = '^XA
						
						^FO30,10^GFA,12412,12412,58,,::::::::::::::::::::::::::::::::::::::O07FE,N01IF8,N03IFE,N0KF,M01KF8,:M03KFC,M07KFE,::M0MF,M0MFgW07FF8gN01IF8,M0MFgU01KFEgL03KFE,M0MFgT01MFEgJ03MFE,M0MFL07KFCgG0OFEgH03OFC,M0MFL07KFCg07PFCgG0QF8,M0MFL07KFCY01RFg07QFE,M07LFL07KFCY0SFCX01SF,M07KFEL07KFCX03TFX07RFE,M07KFEL07KFCX07TF8W0SFC,M03KFCL07KFCW01UFEV03SFC,M03KFCL07KFCW07VF8U07SF8,M01KF8L07KFCW0WFCT01TF8,N0KFM07KFCV01XFT03TF,N07IFEM07KFCV03XF8S0TFE,N01IFCM07KFCV0YFCR01TFEI018,O0IFN07KFCU01YFER03TFCI03C,O01F8N07KFCU03gFR07TF8I03E,g07KFCU07gF8Q0UF8I07F,g07KFCU0gGFCP01UFJ07F8,g07KFCT01gGFEP03TFEJ0FFC,g07KFCT03gHFP07TFEI01FFE,g07KFCT07gHF8O0UFCI01IF,g07KFCT07gHFCN01UFCI03IF8,g07KFCT0gIFCN01UF8I07IF8,g07KFCS01PFI03OFEN03OFEI03FJ07IFC,g07KFCS03OFK03OFN07NFEK07J0JFE,g07KFCS03NFCL07NF8M07NFQ0KF,g07KFCS07MFEM01NF8M0NFCP01KF,g07KFCS0NF8N07MFCL01NFQ03KF8,g07KFCS0NFO01MFEL01MFCQ03KFC,M03KFCL07KFCR01MFCP0MFEL03MF8Q07KFC,M03KFCL07KFCR01MF8P07MFL03MFR0LFE,M03KFCL07KFCR03MFQ01MFL07LFER0LFE,M03KFCL07KFCR03LFER0MF8K07LF8Q01MF,M03KFCL07KFCR07LFCR07LF8K0MFS0MF,M03KFCL07KFCR07LF8R03LFCK0MFS07LF8,M03KFCL07KFCR0MFS01LFCJ01LFES03LF8,M03KFCL07KFCR0LFES01LFEJ01LFCS03LFC,M03KFCL07KFCQ01LFCT0LFEJ03LF8S01LFC,M03KFCL07KFCQ01LFCT07KFEJ03LFU0LFC,M03KFCL07KFCQ01LF8T03LFJ03LFU07KFE,M03KFCL07KFCQ03LFU03LFJ07KFEU07KFE,M03KFCL07KFCQ03LFU01LFJ07KFEU03KFE,M03KFCL07KFCQ03KFEU01LF8I07KFCU03LF,M03KFCL07KFCQ07KFEV0LF8I0LFCU01LF,M03KFCL07KFCQ07KFCV0LF8I0LF8U01LF,M03KFCL07KFCQ07KFCV07KF8I0LF8V0LF,M03KFCL07KFCQ07KF8V07KFCI0LFW0LF8,:M03KFCL07KFCQ0LF8V03KFC001LFW07KF8,M03KFCL07KFCQ0LFW03KFC001KFEW07KF8,::M03KFCL07KFCQ0LFW01KFC001KFEW03KFC,M03KFCL07KFCQ0LFW01KFE001KFEW03KFC,:M03KFCL07KFCQ0KFEW01KFE001KFCW03KFC,::::::M03KFCL07KFCQ0LFW01KFE001KFEW03KFC,:M03KFCL07KFCQ0LFW01KFC001KFEW03KFC,M03KFCL07KFCQ0LFW03KFC001KFEW07KF8,:M03KFCL07KFCQ0LFW03KFC001LFW07KF8,M03KFCL07KFCQ0LF8V03KFC001LFW07KF8,M03KFCL07KFCQ07KF8V07KFCI0LFW0LF8,:M03KFCL07KFCQ07KFCV07KF8I0LF8V0LF,M03KFCL07KFCQ07KFCV0LF8I0LF8U01LF,M03KFCL07KFCQ03KFEV0LF8I07KFCU01LF,M03KFCL07KFCQ03KFEU01LF8I07KFCU03LF,M03KFCL07KFCQ03LFU01LFJ07KFEU03KFE,M03KFCL07KFCQ03LFU03LFJ07KFEU07KFE,M03KFCL07KFCQ01LF8T03LFJ03LFU07KFE,M03KFCL07KFCQ01LFCT07KFEJ03LF8T0LFC,M03KFCL07KFCQ01LFCT0LFEJ01LF8S01LFC,M03KFCL07KFCR0LFES01LFEJ01LFCS03LFC,M03KFCL07KFCR0MFS01LFCJ01LFES03LF8,M03KFCL07KFCR07LF8R03LFCK0MFS07LF8,M03KFCL07KFCR07LFCR07LF8K0MF8R0MF,M03KFCL07KFCR03LFER0MF8K07LFCQ01MF,M03KFCL07KFCR03MFQ03MFL07LF8Q03LFE,M03KFCL07KFCR01MF8P07MFL03LF8Q0MFE,M03KFCL07KFCR01MFEP0MFEL03LFQ01MFC,M03KFCL07KFCS0NFO03MFEL01KFEQ07MFC,M03KFCL07KFCS0NFCN07MFCM0KFEQ0NF8,M03KFCL07KFCS07MFEM01NF8M0KFCP03NF,M03KFCL07KFCS03NFCL07NF8M07JFCP0OF,M03KFCL07VFI03OF8J03OFN07JF8I07K07NFE,M03KFCL07UFEI01PF8003OFEN03JFJ07FI07OFC,M03KFCL07UFCJ0gIFCN01JFJ0gIFD,M03KFCL07UFCJ07gHFCO0IFEI01gJF,M03KFCL07UF8J07gHF8O07FFEI01gIFE,M03KFCL07UF8J03gHFP03FFCI03gIFC,M03KFCL07UFK01gGFEP03FF8I03gIFC,M03KFCL07UFL0gGFCP01FFJ07gIF8,M03KFCL07TFEL07gF8Q0FFJ0gJF8,M03KFCL07TFCL03gFR07EJ0gJF,M03KFCL07TFCL01YFER01EI01gIFE,M03KFCL07TF8M07XFCS0CI03gIFC,M03KFCL07TF8M03XF8W03gIFC,M03KFCL07TFN01WFEX07gIF8,M03KFCL07TFO0WFCX0gJF8,M03KFCL07SFEO03VF8X0gJF,M03KFCL07SFCO01UFEX01gIFE,M03KFCL07SFCP07TF8X01gIFE,M03KFCL07SF8P01SFEY03gIFC,M03KFCL07SF8Q07RFCY07gIFC,M03KFCL07SFR01RFg03gIF8,M03KFCL07SFS07PF8gG0gIF,M03KFCL07RFET0OFCgH01gHF,hN01MFEgJ01gFE,hO01KFEgL01YFC,hR0FCgP01WFC,,::::::::::::::::::::::::::::::::::::::::::::^FS

						^CFP,120,99
						^FO840,70^FDwww.iloq.com^FS
						
						^CFP,130,99
						^FO45,220^FD'.$model_name.'^FS
						
						^CFP,120,85
						^FO45,330^FDPN: '.$model_no.'^FS
						^FO1160,330^FDQTY: '.$qty.'^FS
						
						^BY5,2
						^FO45,430^BCn,80,N^FD'.$model_no.'^FS
						^FO1150,430^BCn,80,N^FD'.$qty.'^FS
						
						^FO45,555^FDBOX NO: '.$box_id.'^FS
						^FO1000,555^FDDATE: '.$lbldate.'^FS
						
						^BY5,2
						^FO45,655^BCn,80,N^FD'.$box_id.'^FS
						^FO1000,655^BCn,80,N^FD'.$lbldate.'^FS
						
						^XZ';

						if(strpos($model_name,"SKOGEN")!==false){
							if(strpos($model_no,"M010267")!==false){
								$swversion = "1.5.10W";
							}
							else{
								$swversion = "1.5.17W";
							}    
						}
						elseif((strpos($model_no2,"M010358")!==false)||(strpos($model_no2,"M010349")!==false)||(strpos($model_no2,"M010339")!==false)||(strpos($model_no2,"M010308")!==false)||(strpos($model_no2,"M010356")!==false)){
							$swversion = "1.5.17W";
						}
						else{
							$swversion = "2.9";
						}
						$lblbox2 ="^XA
						^CFP,180,120
						^FO60,50^FD$model_no2^FS
						
						^CFP,190,230
						^FO40,280^FD$box_id^FS
						^FO38,280^FD$box_id^FS
						^FO40,282^FD$box_id^FS
						
						^CFP,180,180
						^FO40,510^FD$lbldate^FS
					
						^CFP,150,140
						^FO40,720^FDS/W Ver:$swversion^FS
						
						^XZ";

						// end of label editting
						
						
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

						if($printlbl==1){
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
										echo "<script>document.location='box_start.php'</script>";
									}
									else{
										echo '<script type="text/javascript">alert("Printer is not available!");</script>';
										echo "<script>document.location='box_start.php'</script>";
									} 
								}
								catch (Exception $e) 
								{
									echo 'Caught exception: ',  $e->getMessage(), "\n";
								}
							}
							else{
								echo '<script type="text/javascript">alert("Printer is not available!");</script>';
								echo "<script>document.location='box_start.php'</script>";
							}
						}

						elseif($printlbl == 2){

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
										echo "<script>document.location='box_start.php'</script>";
									}
									else{
										echo '<script type="text/javascript">alert("Printer is not available!");</script>';
										echo "<script>document.location='box_start.php'</script>";
									} 
								}
								catch (Exception $e) 
								{
									echo 'Caught exception: ',  $e->getMessage(), "\n";
								}
							}
							else{
								echo '<script type="text/javascript">alert("Printer is not available!");</script>';
								echo "<script>document.location='box_start.php'</script>";
							}

							//function to print second label
							// if($line==2){
							// 	printpizzaline2($lblbox2);
							// }
							// else{
								$filename = "lbliloq2.txt";
								$file = fopen($filename, "r+")or die("ERROR: Cannot open the file .")  ;
								if($file){
									fwrite($file, $lblbox2);      
									fclose($file);
								} 

								//print second label
								copy($filename, "//BTS-iLOQ-1/iloqpizza"); 
							// }
						}
						else{
							echo '<script type="text/javascript">alert("Data Saved!");</script>';
							echo "<script>document.location='box_start.php'</script>"; 
						}
					}
					else{
						echo "<script>document.location='box_scan.php?id=$box_info_id'</script>"; 
					}
				}
				}
			}	

			
		}
	}

	function checkTempTest($sn,$con){
		
		$timeout = "";
		$query=mysqli_query($con,"SELECT tt.id, tt.temperature, ts.sn, tt.time_out, ts.result
		FROM temp_test tt
		JOIN temp_test_sn ts ON tt.id = ts.batch_id
		WHERE ts.sn = $sn AND ts.result IS NOT NULL
		ORDER BY tt.id DESC")or die(mysqli_error($con));

		$rowcount=mysqli_num_rows($query);
		$retval = array();
		$timeout = 0;
		if($rowcount>=1){

			while($row = mysqli_fetch_assoc($query)) {

				if($row['temperature']==1){
					$timeout = date("YmdHis", $row['time_out']);
					isset($retval['result'])?$retval['result']=$retval['result']:$retval['result']=$row['result'];
					isset($retval['time_out'])?$retval['time_out']=$retval['time_out']:$retval['time_out']=$timeout;
				}

				// if($row['temperature']==2){
					// $timeout = date("YmdHis", $row['time_out']);
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
	function notificationemail($model,$sn){

		include('../dist/includes/mail_config.php');
		//Load Composer's autoloader
		require '../vendor/autoload.php';
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = $mHost;                                 // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = $mUname;                          // SMTP username
			$mail->Password = $mPass;                           // SMTP password
			$mail->SMTPSecure = $mSMTP;                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = $mPort;         
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);                           // TCP port to connect to

			//Recipients
			$mail->setFrom($mUname, 'iLOQ Packing System');
			$mail->addAddress('muhammadfirdauss@my.beyonics.com');     // Add a recipient
			$mail->addAddress('jamesteoh@my.beyonics.com');               // Name is optional
			$mail->addAddress('felicisimoaceveda@my.beyonics.com');               // Name is optional
			$mail->addAddress('abdulrahimcm@my.beyonics.com');               // Name is optional

			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'iLOQ SN Max Range Alert';
			$mail->Body    = 'Hi, <br><br>Please be alert that SN for <b>'.$model.'</b> have reached <b>'.$sn.'</b>.<br>';
			$mail->AltBody = 'Hi, <br><br>Please be alert that SN for <b>'.$model.'</b> have reached <b>'.$sn.'</b>.<br>';
			$mail->Body    .= "<br><br><i>Don't reply to this email. Please contact Admin for further information.</i>";
			$mail->AltBody .= "<br><br><i>Don't reply to this email. Please contact Admin for further information.</i>";

			$mail->send();
			// echo'<script type="text/javascript">
			// alert("Message has been sent");
			// window.history.back();
			// </script>';
		} catch (Exception $e) {
			// echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			// echo'<script type="text/javascript">
			// alert("Message could not be sent.");
			// window.history.back();
			// </script>';
		}
	}
	function printpadlocklabel($lblcontent,$line,$con,$secondlabel = null){
		$query=mysqli_query($con,"select ip from printer_cfg where name='Box$line'")or die(mysqli_error($con));
		$row=mysqli_fetch_array($query);
		$ip=$row['ip'];

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
					fputs($fp,$lblcontent);
					if($secondlabel!=null){					
						fputs($fp,$secondlabel);
					}
					fclose($fp);				
					echo '<script type="text/javascript">alert("Label printed successfully!");</script>';
					echo "<script>document.location='box_start.php'</script>";
				}
				else{
					echo '<script type="text/javascript">alert("Printer is not available!");</script>';
					echo "<script>document.location='box_start.php'</script>";
				} 
			}
			catch (Exception $e) 
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		else{
			echo '<script type="text/javascript">alert("Printer is not available!");</script>';
			echo "<script>document.location='box_start.php'</script>";
		}
	}
	function printpizzaline2($lblcontent){
		$ip='10.38.28.30';

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
					fputs($fp,$lblcontent);
					fclose($fp);				
				}
			}
			catch (Exception $e) 
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
	}
?>
