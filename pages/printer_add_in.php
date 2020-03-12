<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$ip = $_POST['ip'];
	$name = $_POST['name'];
	
	
	mysqli_query($con,"insert into printer_cfg(ip, name) values('$ip','$name')")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Printer information updated!');</script>";
	echo "<script>document.location='printer.php'</script>";   
?>
