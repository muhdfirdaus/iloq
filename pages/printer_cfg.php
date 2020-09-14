<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	foreach($_POST as $data){
		foreach($data as $id=>$ip){
			mysqli_query($con,"update printer_cfg set ip='$ip' where id='$id'")or die(mysqli_error($con));
		}
	}
	
	echo "<script type='text/javascript'>alert('Printer IP updated!');</script>";
	echo "<script>window.history.back();</script>";  
?>
