<?php

include('../dist/includes/dbcon.php');

if(isset($_POST['check'])){
    
    $data = "";
    foreach($_POST['check'] as $key=>$value){
        strlen($data)>=1?$data.=",":$data=$data;
        $data .= "'".$value."'";
    }

}

mysqli_query($con,"update model_list set view_opt='0' where id>=1")or die(mysqli_error($con));
mysqli_query($con,"update model_list set view_opt='1' where id in($data)")or die(mysqli_error($con));


echo "<script type='text/javascript'>alert('Successfully updated!');</script>";
echo "<script>document.location='model_list_cfg.php'</script>";  








?>