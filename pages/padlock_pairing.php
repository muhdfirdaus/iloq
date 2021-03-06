
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Padlock Pairing | <?php include('../dist/includes/title.php');include('product_cfg.php');include('../dist/includes/dbcon.php');?></title>
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
 <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header" style="padding-left:20px">
          <a  class="navbar-brand"><b><i class="glyphicon glyphicon-home"></i> Beyonics | iLOQ </b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

      </div><!-- /.container-fluid -->
    </nav>
  </header>
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
    
      <!-- Full Width Column -->
      <div class="content-wrapper">
      
        <div class="container">
        
          <!-- Main content -->
          <section class="content">
            <div class="panel panel-default">
              <div class="panel-heading">NFC Padlock Pairing</div>
              <div class="panel-body">
                <form id="form_pair" class="form-horizontal" method="post" action="padlock_pairing_in.php" enctype='multipart/form-data'>
                  <br>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th class="info text-center">Item</th>
                      <th class="info text-center">Serial Number</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Core SN</td>
                        <td class="text-center"><input autocomplete="off" class="form-control text-center" maxlength="8" required name="coresn" id="coresn" </td>
                      </tr>
                      <tr>
                        <td class="text-center">Padlock SN</td>
                        <td class="text-center"><input autocomplete="off" class="form-control text-center" maxlength="8" required name="padlocksn" id="padlocsn" </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
                <button type="button" id="btn_pair" class="btn btn-primary" style="float: right;">Save</button>
              </div>
            </div>

	        </section><!-- /.content -->
          
          <!-- Main content -->
          <section class="content">
            <div class="panel panel-default">
              <div class="panel-heading">NFC Padlock Pairing - Search</div>
              <div class="panel-body">
                <form id="form_search" class="form-horizontal" method="post" enctype='multipart/form-data'>
                  <br>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th class="info text-center">Item</th>
                      <th class="info text-center">Serial Number</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">
                          <select id="sntype" name="sntype" class="form-control">
                            <option value="core_sn">Core SN</option>
                            <option value="padlock_sn">Padlock SN</option>
                          </select>
                        </td>
                        <td class="text-center"><input autocomplete="off" class="form-control text-center" maxlength="8" required name="sn" id="sn" </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
                <button type="button" id="btn_search" class="btn btn-warning" style="float: right;"><span class="glyphicon glyphicon-search"></span> Search</button>
              
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                  $sntype = $_POST['sntype'];
                  $sn = $_POST['sn'];
                  $query2=mysqli_query($con,"select * from nfc_padlock where $sntype = '$sn'")or die(mysqli_error($con));
                  $row2=mysqli_fetch_array($query2);
                  if(count($row2)>1){
                    $coresn = $row2['core_sn'];
                    $padlocksn = $row2['padlock_sn'];
                    $tmstmp_ori = $row2['timestamp'];
                    $tmstmp = date('d-M-Y h:i:sA', $row2['timestamp']);
                    echo"<br><br><br><hr>
                      <p><b>Result:</b></p>
                      <p>Core SN    :   <b>$coresn</b></p>
                      <p>Padlock SN :   <b>$padlocksn</b></p>
                      <p>Time       :   <b>$tmstmp</b></p>";?>
                      
                      <!-- <p><button id='btn_del' class='btn btn-danger'  type='button'>DELETE</button></p> -->
                      <a href="#pswd" data-target="#pswd" data-toggle="modal" class="btn btn-danger">Delete</a>

                      

                      <!--start of REPORT modal--> 
                      <div id="pswd" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                      <div class="modal-dialog">
                        <div class="modal-content" style="height:auto">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">SN Pairing Record Delete</h4>
                          </div>
                          <div style="font-size:11px" class="modal-body">
                            <form class="form-horizontal" id="form_report" method="post" action="padlock_pairing_delete.php" enctype='multipart/form-data'>
                              <div class="form-group">
                                <label class="control-label col-lg-2" for="pallet">Please insert password:</label>
                                <div class="col-lg-7">
                                  <input type='text' id="coresn" name='coresn' value='<?php echo $coresn;?>' hidden></input>
                                  <input type='text' id="padlocksn" name='padlocksn' value='<?php echo $padlocksn;?>' hidden></input>
                                  <input type='text' id="tmstmp_ori" name='tmstmp_ori' value='<?php echo $tmstmp_ori;?>' hidden></input>
                                  <input autocomplete="off" type="password" class="form-control" id="pswrd" name="pswrd" placeholder="Password">  
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
