<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
// include('../pages/logupdate.php');
// logupd();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Box Start | <?php include('../dist/includes/title.php');?></title>
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
    include('product_cfg.php');
    include('../dist/includes/dbcon.php');
    include('../dist/includes/header.php');
    ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
      
        <div class="container">
          <!-- Content Header (Page header) -->
          <!-- Existing unfinished box -->
          <?php 
          $query=mysqli_query($con,"SELECT DISTINCT id,timestamp,box_id,model_no,qty, line FROM box_info m WHERE m.status=0")or die(mysqli_error($con));
          if(mysqli_num_rows($query)>0){
          ?>
              <section class="content">
                  <div class="panel panel-default">
                      <div class="panel-heading"><b>Unfinished Box</b></div>
                      <div class="panel-body">
                      
                      <form id="form_box" class="form-horizontal" method="post" action="#" enctype='multipart/form-data'>
                      <table class="table table-bordered table-striped" width="50%" align="center">
                          <tr>
                              <th class="info text-center">Box ID</th>
                              <th class="info text-center">Model</th>
                              <th class="info text-center">Quantity</th>  
                              <th class="info text-center">Line</th>  
                              <th class="info text-center">Date Created</th>  
                              <th class="info text-center">Resume</th>                                
                          </tr>
                          <?php 
                          $c = 1;
                          while($row = mysqli_fetch_array($query)){?>
                          <tr>
                          <?php
                          $id = $row['id'];
                          $box_id = $row['box_id'];
                          $model = $row['model_no'];
                          $qty = $row['qty'];
                          $wo = $row['line'];
                          $timestamp = date('d-M-Y h:i:sa',$row['timestamp']);
                          echo  "<td >$box_id</td>
                              <td >$model</td>
                              <td >$qty</td>
                              <td >$wo</td>
                              <td >$timestamp</td>
                              <td  align='center'><a href='box_scan.php?id=$id'><i class='glyphicon glyphicon-chevron-right text-blue'></i></a></td>";
                          $c++;                        
                          ?>
                          
                          </tr>
                          <?php } ?>
                      </table>
                      
                      <br><br>

                      </form>

              
                      </div><!-- /.panel body -->
                  </div><!-- /.panel -->
              </section><!-- /.content -->
          <?php } ?>

        <!-- Main content -->
        <section class="content">
            <div class="panel panel-default">
                <div class="panel-heading">Box Start</div>
                <div class="panel-body">
                
                <form id="form_box" class="form-horizontal" method="post" action="box_start_in.php" enctype='multipart/form-data'>
                <table class="table-bordered table-striped" width="50%" align="center">
                    <tr>
                        <td>Line : </td>
                        <td>
                            <select id="line" name="line" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                    </tr>    
                    <tr>
                        <td >Model : </td>
                        <td>
                            <select name="model" class="form-control">
                            <?php $modellist = get_modelNo2($con);

                            foreach($modellist as $key=>$value ){
                            ?>
                            <option value='<?php echo $key;?>' ><?php echo $value; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity : </td>
                        <td><input type="number" class="form-control pull-right" max='150' value="20" name="qty" placeholder="Quantity" required></td>
                    </tr>
                </table>
                
                <p class="text-red text-center"><b>**Please make sure information is correct before clicking "Start"</b></p>
                <br><br>

                <div>
                    <button id="btn_start" name="btn_start" style="display: block; margin: 0 auto;" class="btn btn-primary">Start</button>
                </div>

                </form>
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
        
        $("#btn_box").click(function () {
          document.getElementById("form_box").submit();
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
