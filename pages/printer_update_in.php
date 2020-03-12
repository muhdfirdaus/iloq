<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
    $id = $_GET['id'];
	$ip = $_POST['ip'];
	$name = $_POST['name'];
	
	
	mysqli_query($con,"update printer_cfg set ip='$ip',name='$name' where id=$id")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Printer information updated!');</script>";
	echo "<script>document.location='printer.php'</script>";   
?>
