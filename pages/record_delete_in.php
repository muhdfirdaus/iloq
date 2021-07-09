<?php

session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');


$criteria = $_POST['criteria'];
$val = $_POST['val'];
$reason = $_POST['reason'];
$userid = $_SESSION['id'];
$tmstmp = time();


if($criteria == 'carton_id'){
    $query=mysqli_query($con,"SELECT ci.no_of_box no_box, ci.qty, ci.model_no, ci.timestamp, ci.user_id
    FROM carton_info ci
    WHERE ci.carton_id = '$val' ")or die(mysqli_error($con));
    if(mysqli_num_rows($query)>0){
        $row=mysqli_fetch_array($query);
        $modelno = $row['model_no'];
        $qty = $row['qty'];
        $date_created = $row['timestamp'];
        $createdby = $row['user_id'];
        

        mysqli_query($con,"INSERT INTO delete_main (main_type,main_val,model_no,qty,time_created,createdby,time_deleted,deletedby,reason)
        VALUES(2,'$val', '$modelno','$qty', '$date_created', '$createdby', '$tmstmp','$userid','$reason')")or die(mysqli_error($con));
        $newid = mysqli_insert_id($con);


        $query2=mysqli_query($con,"SELECT box_id
        FROM carton_box
        WHERE carton_id = '$val' ")or die(mysqli_error($con));
        while($row2=mysqli_fetch_array($query2)){
            $box_id = $row2['box_id'];
            mysqli_query($con,"INSERT INTO delete_sub (delete_main_id,sub_val) VALUES('$newid', '$box_id')")or die(mysqli_error($con));
        }
        mysqli_query($con,"delete from carton_info where carton_id = '$val'")or die(mysqli_error($con));
        mysqli_query($con,"delete from carton_box where carton_id = '$val'")or die(mysqli_error($con));
        echo '<script type="text/javascript">alert("Succesfully deleted!");</script>';
        echo "<script>document.location='record_delete.php'</script>"; 
    }
}
else{
    $query=mysqli_query($con,"SELECT bi.qty, bi.model_no, bi.timestamp, bi.user_id
    FROM box_info bi
    WHERE bi.box_id = '$val' and bi.status=1")or die(mysqli_error($con));
    if(mysqli_num_rows($query)>0){
        $row=mysqli_fetch_array($query);
        $modelno = $row['model_no'];
        $qty = $row['qty'];
        $date_created = $row['timestamp'];
        $createdby = $row['user_id'];

        mysqli_query($con,"INSERT INTO delete_main (main_type,main_val,model_no,qty,time_created,createdby,time_deleted,deletedby,reason)
        VALUES(1,'$val', '$modelno','$qty', '$date_created', '$createdby', '$tmstmp','$userid','$reason')")or die(mysqli_error($con));
        $newid = mysqli_insert_id($con);

        $query2=mysqli_query($con,"SELECT sn
        FROM box_sn
        WHERE box_id = '$val' ")or die(mysqli_error($con));
        while($row2=mysqli_fetch_array($query2)){
            $sn = $row2['sn'];
            mysqli_query($con,"INSERT INTO delete_sub (delete_main_id,sub_val) VALUES('$newid', '$sn')")or die(mysqli_error($con));
        }
        mysqli_query($con,"delete from box_info where box_id = '$val'")or die(mysqli_error($con));
        mysqli_query($con,"delete from box_sn where box_id = '$val'")or die(mysqli_error($con));
        echo '<script type="text/javascript">alert("Succesfully deleted!");</script>';
        echo "<script>document.location='record_delete.php'</script>"; 
    }

}







?>

