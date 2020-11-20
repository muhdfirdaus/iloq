<?php 
session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Model | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    

    </head>

    <body class="hold-transition skin-black layout-top-nav" onload="myFunction()">
    <div class="wrapper">
        <?php include('../dist/includes/header.php');?>
        <div class="content-wrapper">
            <div class="container">
                <!-- Main content -->
                <section class="content">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Model List Configuration</b></div>
                        <div class="panel-body">
                        
                        <?php include('../dist/includes/dbcon.php');
                        
                        $query=mysqli_query($con,"SELECT id,model, model_name, view_opt
                        FROM model_list order by id asc")or die(mysqli_error());
                        
                        ?>
                        <form id="form_model_cfg" class="form-horizontal" method="post" action="model_list_cfg_in.php" enctype='multipart/form-data'>
                        <table class="table table-bordered table-striped" width="50%">
                            <tr>
                                <th class="info text-center">Model</th>
                                <th class="info text-center">Model Name</th>
                                <th class="info text-center">View on Option</th>
                            </tr>

                            <?php 
                            $rowcount=mysqli_num_rows($query);
                            if($rowcount>=1){
                            while($row = mysqli_fetch_assoc($query)) {
                            ?>

                            <tr>
                                <!-- <td class="text-center"><input type="checkbox" name="id[<?php echo $row['id']; ?>]" value="<?php echo $row['id']; ?>"> </td> -->
                                <td><?php echo $row['model']; ?></td>
                                <td><?php echo $row['model_name']; ?></td>
                                <td width="20%" class="text-center">
                                    <input type="checkbox" name="check[]" value="<?php echo $row['id'];?>" <?php if($row['view_opt'] == 1){echo "checked";} ?>>
                                </td>
                                
                            </tr>

                            <?php } }
                            
                            else{
                            ?>
                            <tr>
                                <td class="text-center">No Data To Be Shown.</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <input type="hidden" name="prc" id="prc" value=""/>
                        </table>

                        <br><br>
                        
                        </form>
                        <br>
                        <button type="button" id="btn_box" class="btn btn-success" style="float: right;">Save</button>
                        <br><br><br><br><br>

                
                        </div><!-- /.panel body -->
                    </div><!-- /.panel -->
                </section><!-- /.content -->
            
            </div><!-- /.container -->
        </div><!-- /.content-wrapper -->
        <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    
        <script type="text/javascript" src="autosum.js"></script>
    
        <!-- jQuery 2.1.4 -->
        <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="../dist/js/jquery.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../plugins/select2/select2.full.min.js"></script>
        <!-- SlimScroll -->
        <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script> 
        
                                      
        <script>
        $(function () {

            $("#btn_box").click(function () {
            document.getElementById("form_model_cfg").submit();
            });
        });
        </script>

    </body>
</html>