<?php



function get_model($con){
    $query=mysqli_query($con,"SELECT id, model FROM model_list order by id asc")or die(mysqli_error());
    while($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $mdl = $row['model'];
        $model[$id] = $mdl;
    }
    return $model;
}

function get_modelNo($con){
    $query=mysqli_query($con,"SELECT id, model_no FROM model_list order by id asc")or die(mysqli_error());
    while($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $mdl = $row['model_no'];
        $model_no[$id] = $mdl;
    }
    return $model_no;
}

function get_model_name($con){
    $query=mysqli_query($con,"SELECT id, model_name FROM model_list order by id asc")or die(mysqli_error());
    while($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $mdl = $row['model_name'];
        $model_name[$id] = $mdl;
    }
    return $model_name;
}


function get_modelNo2($con){
    $query=mysqli_query($con,"SELECT id, model_no2 FROM model_list order by id asc")or die(mysqli_error());
    while($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $mdl = $row['model_no2'];
        $modelno2[$id] = $mdl;
    }
    return $modelno2;
}

function get_custProd($con){
    $query=mysqli_query($con,"SELECT id, model_cust FROM model_list order by id asc")or die(mysqli_error());
    while($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $mdl = $row['model_cust'];
        $model_cust[$id] = $mdl;
    }
    return $model_cust;
}

function get_shipPN($con){
    $query=mysqli_query($con,"SELECT id, model_ship FROM model_list order by id asc")or die(mysqli_error());
    while($row = mysqli_fetch_assoc($query)) {
        $id = $row['id'];
        $mdl = $row['model_ship'];
        $model_ship[$id] = $mdl;
    }
    return $model_ship;
}
?>