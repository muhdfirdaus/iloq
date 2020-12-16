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
    <title>Box Record Search | <?php include('../dist/includes/title.php');include('product_cfg.php');include('../dist/includes/dbcon.php');?></title>
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
              <div class="panel-heading">Box Record - Search</div>
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
                            <option value="sn">SN</option>
                            <option value="box_id">Box ID</option>
                          </select>
                        </td>
                        <td class="text-center"><input autocomplete="off" class="form-control text-center" maxlength="20" required name="val" id="val" </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
                <button type="button" id="btn_search" class="btn btn-warning" style="float: right;"><span class="glyphicon glyphicon-search"></span> Search</button>
              
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                  $criteria = $_POST['criteria'];
                  $val = $_POST['val'];
                  $query2=mysqli_query($con,"SELECT bs.sn, bi.box_id, bi.model_no, bi.timestamp, cb.carton_id
                  FROM box_sn bs
                  LEFT JOIN box_info bi ON bs.box_id = bi.box_id
                  LEFT JOIN carton_box cb on bs.box_id = cb.box_id
                  WHERE bs.$criteria = '$val' ")or die(mysqli_error($con));
                  if(mysqli_num_rows($query2)>0){
                    echo"<br><br><br><hr>
                    <p><b>Result:</b></p>";?>
                    <table class="table table-bordered" width="50%" align="center">
                    <tr>
                        <th class="info text-center">Carton ID</th>  
                        <th class="info text-center">Box ID</th>
                        <th class="info text-center">Model No</th>  
                        <th class="info text-center">SN</th>
                        <th class="info text-center">Time Packed</th>                              
                    </tr><?php
                    while($row2=mysqli_fetch_array($query2)){
                        $sn = $row2['sn'];
                        $box_id = $row2['box_id'];
                        $model_no = $row2['model_no'];
                        $carton_id = $row2['carton_id'];
                        $carton_id!==null?$carton_id=$carton_id:$carton_id="-";
                        $tmstmp = date('d-M-Y h:i:sA', $row2['timestamp']);
                        echo"
                        <tr>
                            <td class='text-center'>$carton_id</td>
                            <td class='text-center'>$box_id</td>
                            <td class='text-center'>$model_no</td>
                            <td class='text-center'>$sn</td>
                            <td class='text-center'>$tmstmp</td>
                        </tr>
                        ";
                    }
                    echo "</table>";
                  }
                  else{
                    echo '<script type="text/javascript">alert("No Record!");</script>';
                  }
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
