<?php
//session_start();
// if(empty($_SESSION['id'])):
// header('Location:../index.php');
// endif;
date_default_timezone_set("Asia/Singapore"); 
?>
<?php include('../dist/includes/dbcon.php');

  $query=mysqli_query($con,"select ip from printer_cfg where id=1")or die(mysqli_error($con));
  $row=mysqli_fetch_array($query);
  $ip1=$row['ip'];
  $query=mysqli_query($con,"select ip from printer_cfg where id=2")or die(mysqli_error($con));
  $row=mysqli_fetch_array($query);
  $ip2=$row['ip'];
  $query=mysqli_query($con,"select * from printer_cfg order by id asc")or die(mysqli_error($con));
  while($row=mysqli_fetch_array($query)){
    $printer[$row['id']]['ip'] = $row['ip'];
    $printer[$row['id']]['name'] = $row['name'];
  }
?>
<meta http-equiv="refresh" content="900;url=logout.php" />
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
            <div class="navbar-header" style="padding-left:20px">
              <a  class="navbar-brand"><b><i class="glyphicon glyphicon-home"></i> Beyonics | iLOQ </b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li class="">
                    <!-- Menu Toggle Button -->
                    <a href="box_start.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-tasks text-blue"></i>
                      Box
                    </a>
                  </li>

                  
                  <li class="dropdown notifications-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-list-alt text-blue"></i>
                      Carton
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                          <li><!-- start notification -->
                              <a href="carton_padlock.php" class="dropdown-toggle" >
                                <i class="glyphicon glyphicon-list-alt text-blue"></i>Padlock model
                              </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                              <a href="carton.php" class="dropdown-toggle" >
                                <i class="glyphicon glyphicon-list-alt text-blue"></i>Other model
                              </a>
                          </li><!-- end notification -->
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown notifications-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#labelprint" class="dropdown-toggle"  data-toggle="dropdown">
                      <i class="glyphicon glyphicon-time text-yellow"></i>
                      Temperature Test
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                          <li><!-- start notification -->
                              <a href="temp_tray_sn.php" class="dropdown-toggle">
                                <i class="glyphicon glyphicon-time text-yellow"></i>Tray Registration
                              </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                              <a href="temperature_test.php" class="dropdown-toggle" >
                                <i class="glyphicon glyphicon-time text-yellow"></i>Start Temperature Test
                              </a>
                          </li><!-- end notification -->
                          <?php  if($_SESSION['admin']==1){?>
                          <li><!-- start notification -->
                              <a href="report_temptest.php" class="dropdown-toggle" >
                                <i class="glyphicon glyphicon-time text-yellow"></i>Test Log
                              </a>
                          </li><!-- end notification -->
                          <?php } ?>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="">
                    <!-- Menu Toggle Button -->
                    <a href="#reportmodal" class="dropdown-toggle" data-target="#reportmodal" data-toggle="modal">
                      <i class="glyphicon glyphicon-file text-green"></i>
                      Report
                    </a>
                  </li>
                  <li class="dropdown notifications-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#labelprint" class="dropdown-toggle"  data-toggle="dropdown">
                      <i class="glyphicon glyphicon-barcode text-black"></i>
                      Label Printing
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                          <li><!-- start notification -->
                              <a href="#boxprint" class="dropdown-toggle" data-target="#boxprint" data-toggle="modal">
                                <i class="glyphicon glyphicon-barcode text-black"></i>Box Label
                              </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                              <a href="#cartonprint" class="dropdown-toggle" data-target="#cartonprint" data-toggle="modal">
                                <i class="glyphicon glyphicon-barcode text-black"></i>Carton Label
                              </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                              <a href="#m004446box" class="dropdown-toggle" data-target="#m004446box" data-toggle="modal">
                                <i class="glyphicon glyphicon-barcode text-black"></i>IQ-M004446-L-01 (Box)
                              </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                              <a href="#m004446carton" class="dropdown-toggle" data-target="#m004446carton" data-toggle="modal">
                                <i class="glyphicon glyphicon-barcode text-black"></i>IQ-M004446-L-01 (Carton)
                              </a>
                          </li><!-- end notification -->
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="">
                    <!-- Menu Toggle Button -->
                    <a href="rma.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-tasks text-red"></i>
                      Box (RMA)
                    </a>
                  </li>
                  <li class="dropdown notifications-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-cog text-red"></i>
                      Configuration
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">

                          <li><!-- start notification -->
                              <a href="profile.php">
                                <i class="glyphicon glyphicon-user text-orange"></i>
                                User profile ( <?php echo $_SESSION['name'];?> )
                              </a>
                          </li><!-- end notification -->
                          <!--<li> start notification 
                              <a href="box_cfg.php">
                                <i class="glyphicon glyphicon-th-list text-orange"></i>Box Configuration
                              </a>
                          </li> -->
                          <li><!-- start notification -->
                              <a href="#printerip" class="dropdown-toggle" data-target="#printerip" data-toggle="modal">
                                <i class="glyphicon glyphicon-print text-orange"></i>Printer IP
                              </a>
                          </li><!-- end notification -->
                          <?php if($_SESSION['admin']==1){ ?>
                          <li><!-- start notification -->
                              <a href="model.php" class="dropdown-toggle" >
                                <i class="glyphicon glyphicon-list-alt text-orange"></i>Model List
                              </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                              <a href="model_list_cfg.php" class="dropdown-toggle" >
                                <i class="glyphicon glyphicon-list-alt text-orange"></i>Model List View Cfg.
                              </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                              <a href="box_record_search.php" class="dropdown-toggle" >
                                <i class="glyphicon glyphicon-search text-orange"></i>Box Record - Search
                              </a>
                          </li><!-- end notification -->
                          <?php } ?>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="">
                    <!-- Menu Toggle Button -->
                    <a href="logout.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-off text-red"></i> Logout 
                      
                    </a>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>


<!--start of REPORT modal--> 
<div id="reportmodal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Report by Box/Pallet ID</h4>
      </div>
      <div style="font-size:11px" class="modal-body">
        <form class="form-horizontal" id="form_report" method="post" action="report_box.php" enctype='multipart/form-data'>
          <div class="form-group">
            <label class="control-label col-lg-2" for="box">Box ID</label>
            <div class="col-lg-7">
              <input autocomplete="off" type="text" class="form-control" id="box_id" name="box_id" placeholder="Box ID">  
            </div>
          </div><hr>
          <div class="form-group">
            <label class="control-label col-lg-2" for="pallet">Pallet ID</label>
            <div class="col-lg-7">
              <input autocomplete="off" type="text" class="form-control" id="pallet_id" name="pallet_id" placeholder="Pallet ID">  
            </div>
          </div>
          <div class="form-group control-label text-red">*Please insert ONE(1) field only</div>
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


<!--start of LABEL PRINTING M004446 Box modal--> 
<div id="m004446box" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Print Label M004446(Box)</h4>
      </div>
      <div style="font-size:11px" class="modal-body">
        <form class="form-horizontal" id="form_report" method="post" action="print_4446.php" enctype='multipart/form-data'>
          <div class="form-group">
            <label class="control-label col-lg-2" for="box">Quantity</label>
            <div class="col-lg-7">
              <input autocomplete="off" type="text" class="form-control" id="qty" name="qty" placeholder="Quantity" value="63">  
            </div>
          </div><hr>
          <!-- <div class="form-group control-label text-red">*Please insert ONE(1) field only</div> -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_submit">Send</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>  
  </div><!--end of modal-dialog-->
</div> 
<!--end of BOX LABEL PRINTING modal--> 


<!--start of LABEL PRINTING M004446 Carton modal--> 
<div id="m004446carton" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Print Label M004446(Carton)</h4>
      </div>
      <div style="font-size:11px" class="modal-body">
        <form class="form-horizontal" id="form_report" method="post" action="print_4446_carton.php" enctype='multipart/form-data'>
          <div class="form-group">
            <label class="control-label col-lg-2" for="box">Quantity</label>
            <div class="col-lg-7">
              <input autocomplete="off" type="text" class="form-control" id="qty" name="qty" placeholder="Quantity" value="189">  
            </div>
          </div><hr>
          <div class="form-group">
            <label class="control-label col-lg-2" for="box">Weight (kg)</label>
            <div class="col-lg-7">
              <input autocomplete="off" type="text" class="form-control" id="weight" name="weight" placeholder="Weight" value="20">  
            </div>
          </div>
          <!-- <div class="form-group control-label text-red">*Please insert ONE(1) field only</div> -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_submit">Send</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>  
  </div><!--end of modal-dialog-->
</div> 
<!--end of BOX LABEL PRINTING modal--> 


<!--start of LABEL PRINTING modal--> 
<div id="boxprint" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Print Label (Box)</h4>
      </div>
      <div style="font-size:11px" class="modal-body">
        <form class="form-horizontal" id="form_report" method="post" action="print_box.php" enctype='multipart/form-data'>
          <div class="form-group">
            <label class="control-label col-lg-2" for="box">Box ID</label>
            <div class="col-lg-7">
              <input autocomplete="off" type="text" class="form-control" id="box_id" name="box_id" placeholder="Box ID">  
            </div>
          </div><hr>
          <div class="form-group">
            <label class="control-label col-lg-2" for="printer_ip">Printer </label>
            <div class="col-lg-7">
              <select name="printer_ip" id="printer_ip" class="form-control">
              <?php foreach($printer as $data){
                echo "<option value='{$data['ip']}'>{$data['name']}</option>";
              }
              ?>
              </select>
            </div>
          </div>
          <!-- <div class="form-group control-label text-red">*Please insert ONE(1) field only</div> -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_submit">Send</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>  
  </div><!--end of modal-dialog-->
</div> 
<!--end of BOX LABEL PRINTING modal--> 


<!--start of Carton LABEL PRINTING modal--> 
<div id="cartonprint" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Print Label (Carton)</h4>
      </div>
      <div style="font-size:11px" class="modal-body">
        <form class="form-horizontal" id="form_report" method="post" action="print_carton.php" enctype='multipart/form-data'>
          <div class="form-group">
            <label class="control-label col-lg-2" for="box">Carton ID</label>
            <div class="col-lg-7">
              <input autocomplete="off" type="text" class="form-control" id="carton_id" name="carton_id" placeholder="Carton ID">  
            </div>
          </div><hr>
          <div class="form-group">
            <label class="control-label col-lg-2" for="printer_ip">Printer </label>
            <div class="col-lg-7">
              <select name="printer_ip" id="printer_ip" class="form-control">
              <?php foreach($printer as $data){
                echo "<option value='{$data['ip']}'>{$data['name']}</option>";
              }
              ?>
              </select>
              
            </div>
          </div>
          <!-- <div class="form-group control-label text-red">*Please insert ONE(1) field only</div> -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_submit">Send</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>  
  </div><!--end of modal-dialog-->
</div> 
<!--end of Carton LABEL PRINTING modal--> 



<!--start of PRINTER IP CONFIG modal--> 
<div id="printerip" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Printer IP Setup</h4>
      </div>
      <div style="font-size:11px" class="modal-body">
        <form class="form-horizontal" id="form_report" method="post" action="printer_cfg.php" enctype='multipart/form-data'>
          <?php foreach($printer as $key=>$value){?>
          <div class="form-group">
            <label class="control-label col-lg-2" for="printer_ip"><?php echo $value['name'];?></label>
            <div class="col-lg-7">
              <input autocomplete="off" type="text" class="form-control" id="ip[<?php echo $key?>]" name="ip[<?php echo $key?>]" placeholder="Printer IP for Carton" value="<?php echo $value['ip']; ?>">  
            </div>
          </div>
          <?php } ?>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_submit">Send</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>  
  </div><!--end of modal-dialog-->
</div> 
<!--end of LABEL PRINTING modal--> 