<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Printer | <?php include('../dist/includes/title.php');?></title>
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
                        <div class="panel-heading"><b>Printer List</b></div>
                        <div class="panel-body">
                        

                        <div>
                            <button class="btn btn-primary" style="float: right;" onclick="document.location='printer_add.php'"><i class="glyphicon glyphicon-plus"></i> Add New</button>
                        </div>
                        <br><br><br>
                        <?php include('../dist/includes/dbcon.php');
                        
                        $query=mysqli_query($con,"SELECT *
                        FROM printer_cfg order by id asc")or die(mysqli_error());
                        
                        ?>
                        <form id="form_temp" class="form-horizontal" method="post" action="#" enctype='multipart/form-data'>
                        <table class="table table-bordered table-striped" width="50%">
                            <tr>
                                <th class="info text-center">Name</th>
                                <th class="info text-center">Printer IP</th>
                                <th class="info text-center">Action</th>
                            </tr>

                            <?php 
                            $rowcount=mysqli_num_rows($query);
                            if($rowcount>=1){
                            while($row = mysqli_fetch_assoc($query)) {
                            ?>

                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['ip']; ?></td>
                                <td width="20%" class="text-center"><a class="glyphicon glyphicon-pencil " href="printer_update.php?id=<?php echo$row['id']; ?>">Edit</a>&nbsp;<a class="glyphicon glyphicon-trash text-red" href="#delete">Delete</a></td>
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

                        </form><br><br><br><br><br><br><br>

                
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

            //process code(prc) 0=start, 1=stop, 2=finish
        
            // $("#btn_start").click(function () {
            //     document.getElementById("prc").value = '0';
            //     document.getElementById("form_temp").submit();
            // });
            // $("#btn_stop").click(function () {
            //     document.getElementById("prc").value = '1';
            //     document.getElementById("form_temp").submit();
            // });
            // $("#btn_finish").click(function () {
            //     document.getElementById("prc").value = '2';
            //     document.getElementById("form_temp").submit();
            // });
        });
        </script>

    </body>
</html>
