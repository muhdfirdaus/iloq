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
    <title>Box/Carton Record Delete | <?php include('../dist/includes/title.php');include('product_cfg.php');include('../dist/includes/dbcon.php');?></title>
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
    <style>
      .col-lg-3{
        margin:50px 0px;
      }
      
    </style>
 </head>
  <script language="javascript">
           var message="This function is not allowed here.";
           function clickIE4(){
                 if (event.button==2){
                     alert(message);
                     return false;
                 }
           }
           function clickNS4(e){
                if (document.layers||document.getElementById&&!document.all){
                        if (e.which==2||e.which==3){
                                  alert(message);
                                  return false;
                        }
                }
           }
           if (document.layers){
                 document.captureEvents(Event.MOUSEDOWN);
                 document.onmousedown=clickNS4;
           }
           else if (document.all&&!document.getElementById){
                 document.onmousedown=clickIE4;
           }
           document.oncontextmenu=new Function("alert(message);return false;")
</script>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-black layout-top-nav" onload="myFunction()">
    <div class="wrapper">
    <?php 
    include('../dist/includes/header.php');
    ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
      
        <div class="container">
          
          <!-- Main content -->
          <section class="content">
            <div class="panel panel-default">
              <div class="panel-heading">Box/Carton Record - Delete</div>
              <div class="panel-body">
                <form id="form_search" class="form-horizontal" method="post" enctype='multipart/form-data'>
                  <br>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th class="info text-center">Item</th>
                      <th class="info text-center">Value</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">
                          <select id="criteria" name="criteria" class="form-control">
                            <option value="carton_id">Carton ID</option>
                            <option value="box_id">Box ID</option>
                          </select>
                        </td>
                        <td class="text-center"><input autocomplete="off" class="form-control text-center" maxlength="20" required name="val" id="val" </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
                <button type="button" id="btn_search" class="btn btn-danger" style="float: right;"><span class="glyphicon glyphicon-search"></span> Search</button>
              
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $criteria = $_POST['criteria'];
                    $val = $_POST['val'];
                    if($val == null || $val ==""){
                        echo '<script type="text/javascript">alert("Incorrect value inserted!");</script>';
                    }
                    elseif($criteria == 'carton_id'){
                        $query=mysqli_query($con,"SELECT ci.no_of_box no_box, ci.qty, ci.model_no, ci.timestamp, us.username
                        FROM carton_info ci
                        LEFT JOIN user us ON us.user_id = ci.user_id
                        WHERE ci.carton_id = '$val' ")or die(mysqli_error($con));
                        if(mysqli_num_rows($query)>0){
                            $row=mysqli_fetch_array($query);
                            echo "<br><br><br><br>
                            <p><b>Carton ID</b>: $val</p>
                            <p><b>Model</b>: ".$row['model_no']."</p>
                            <p><b>Qty</b>: ".$row['qty']."</p>
                            <p><b>No. of Box</b>: ".$row['no_box']."</p>
                            <p><b>Time Packed</b>: ".date('d-M-Y h:i:sA', $row['timestamp'])."</p>
                            <p><b>User</b>: ".$row['username']."</p>
                            <p><b>Box Inside</b>:<p>";


                            $query2=mysqli_query($con,"SELECT box_id
                            FROM carton_box
                            WHERE carton_id = '$val' ")or die(mysqli_error($con));
                            while($row2=mysqli_fetch_array($query2)){
                                echo $row2['box_id']."<br>";
                            }?>
                            <a href="#dlt" data-target="#dlt" data-toggle="modal" class="btn btn-danger">Delete</a>
                            <?php
                        }
                        else{
                            echo '<script type="text/javascript">alert("No Record!");</script>';
                        }
                    }
                    elseif($criteria == 'box_id'){
                        $query=mysqli_query($con,"SELECT bi.qty, bi.model_no, bi.timestamp, us.username
                        FROM box_info bi
                        LEFT JOIN user us ON us.user_id = bi.user_id
                        WHERE bi.box_id = '$val' and bi.status=1")or die(mysqli_error($con));
                        if(mysqli_num_rows($query)>0){
                            $row=mysqli_fetch_array($query);
                            echo "<br><br><br><br>
                            <p><b>Box ID</b>: $val</p>
                            <p><b>Model</b>: ".$row['model_no']."</p>
                            <p><b>Qty</b>: ".$row['qty']."</p>
                            <p><b>Time Packed</b>: ".date('d-M-Y h:i:sA', $row['timestamp'])."</p>
                            <p><b>User</b>: ".$row['username']."</p>
                            <p><b>SN Inside</b>:<p>";


                            $query2=mysqli_query($con,"SELECT sn
                            FROM box_sn
                            WHERE box_id = '$val' ")or die(mysqli_error($con));
                            while($row2=mysqli_fetch_array($query2)){
                                echo $row2['sn']."<br>";
                            }?>
                            <a href="#dlt" data-target="#dlt" data-toggle="modal" class="btn btn-danger">Delete</a>
                            <?php
                        }
                        else{
                            echo '<script type="text/javascript">alert("No Record!");</script>';
                        }
                    }
                    ?>                      
      
                    <!--start of delete modal--> 
                    <div id="dlt" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                    <div class="modal-dialog">
                        <div class="modal-content" style="height:auto">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Box/Carton Record Delete</h4>
                        </div>
                        <div style="font-size:11px" class="modal-body">
                            <form class="form-horizontal" id="form_report" method="post" action="record_delete_in.php" enctype='multipart/form-data'>
                            <div class="form-group">
                                <label class="control-label col-lg-2" for="pallet">Please insert reason:</label>
                                <div class="col-lg-7">
                                <input type='text' id="criteria" name='criteria' value='<?php echo $criteria;?>' hidden></input>
                                <input type='text' id="val" name='val' value='<?php echo $val;?>' hidden></input> 
                                <input autocomplete="off" type="text" class="form-control" id="reason" name="reason" placeholder="Reason">  
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="btn_submit">Send</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                        </div>  
                    </div><!--end of modal-dialog-->
                    </div> 
                    <!--end of REPORT modal--> 
                    <?php
                }

                ?>
              </div>
            </div>

	        </section><!-- /.content -->
          
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->


	<script>
    $(function() {
      $(".btn_delete").click(function(){
      var element = $(this);
      var id = element.attr("id");
      var dataString = 'id=' + id;
      if(confirm("Sure you want to delete this item?"))
      {
	$.ajax({
	type: "GET",
	url: "temp_trans_del.php",
	data: dataString,
	success: function(){
		
	      }
	  });
	  
	  $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
	  .animate({ opacity: "hide" }, "slow");
      }
      return false;
      });

      });
    </script>
	
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
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
     <script>
      $(function () {
        
        $("#btn_pair").click(function () {
          document.getElementById("form_pair").submit();
          // var valid = true;
          // var i;
          // for (i = 1; i < 21; i++) { 
          //   var sn_name = "sn"+i;
          //   var pass1 = document.getElementById(sn_name).value;
          //   var pass_t = pass1.trim();
          //   if(pass_t.length < 1 || pass_t == ""){
          //     valid = false;
          //   }
          // }
          // if(valid = false){
          //   alert("Product is not enough");
          // }
        });
        $("#btn_search").click(function () {
          document.getElementById("form_search").submit();
        });
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>
</html>
