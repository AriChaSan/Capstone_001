<style>
table, th, td {
   border: 2px solid black;
}
.modal-dialog{
    overflow-y: initial !important
}
.modal-open{
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}
div#inventoryCheckPackage1Modal {
    overflow: auto;
}
</style>
<?php
  date_default_timezone_set("Asia/Manila");
?>
<ol class="breadcrumb" style="background-color:#60a917;">
  <li style="color:#fff;">Home</li>
  <li class="active" style="color:#fff;">Test</li>
</ol>

<div class="container col-md-12">
  <ul class="nav nav-tabs">
    <li class="active">
      <a data-toggle="tab" href="#pending">All Pending Queue
        (<input type="text" style="width:20px; border: none; outline: none; background-color: transparent; text-align: center; font-weight: bold" readonly="true" id="pendingnumbers" value="<?php echo $pensdingqueuesData; ?>"/>)
      </a>
    </li>
    <li>
      <a data-toggle="tab" href="#active"> All Active Tests
        (<input type="text" style="width:20px; border: none; outline: none; background-color: transparent; text-align: center; font-weight: bold" readonly="true" id="pendingnumbers" value="<?php echo $activetransData; ?>"/>)
      </a>
    </li>
  </ul>
  <div class="tab-content">
    <div id="pending" class="tab-pane fade in active">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">All Pending Queue</div>
          <div class="panel-body" style="display:block">
            <div id="messages"></div>
            <div class="col-md-12">
              <h3>Pending Transactions:</h3>
              <table id="manageQueueAllTable" class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <?php
                    $user_type = $_SESSION['account_type'];
                      if($user_type == 7){ //recept
                    ?>
                    <th>Actions</th>
                  <?php } ?>
                  </tr>
                </thead>
                <tbody><!--tbody content-->
                </tbody>
              </table><!--table end-->
            </div>
          </div><!--panel-body end-->
        </div><!--panel-default end-->
      </div><!--md 12 end-->
    </div>
    <div id="active" class="tab-pane fade in active">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"> All Active Tests
          </div>
            <div class="panel-body" style="display:block">
                <div id="messages"></div>
                <h3>Accepted Transactions:</h3>
                  <table id="manageTransactionAllTable" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Transaction No.</th>
                        <th>Patient Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody><!--tbody content-->
                    </tbody>
                  </table><!--table end-->
            </div><!--panel-body end-->
        </div><!--panel-default end-->
      </div><!--md 12 end-->
    </div>
  </div>
</div>
<input type="text" value="" name="hiddenselectedtest" id="hiddenselectedtest"/>
<input type="text" value="" name="hiddentotalsales" id="hiddentotalsales"/>
<input type="text" value="" name="hiddenpatientname" id="hiddenpatientname"/>
<input type="text" value="" name="hiddenqueue_id" id="hiddenqueue_id"/>
<input type="text" value="" name="patient_number" id="patient_number"/>
<input type="text" value="" name="current_test_123" id="current_test_123"/>
<input type="text" value="" name="transaction_id" id="transaction_id"/>
<!-- add tem modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="inventoryCheckPackage1Modal" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Inventory Check /Package Assessment</h4>
      </div>

      <div class="result"></div>

    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="choosePackageModal" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Test</h4>
      </div>
      <form class="form-horizontal" method="post" style="margin-left:25px;" enctype="multipart/form-data" action="inventory/checkInventory" id="choosePackagForm">
        <div class="modal-body add-modal">
            <table style="width:100%">
              <thead>
                <tr>
                  <th style="font-size:20px;text-align:center">Select</th>
                  <th style="font-size:20px;text-align:center">Name</th>
                  <th style="font-size:20px;text-align:center">Type</th>
                  <th style="font-size:20px;text-align:center">Price</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(isset($alltest)){
                    foreach ($alltest as $key => $value) {
                      if(($value['id'] > 89) || ($value['id'] == 44)){
                ?>
                <tr>
                  <td style="text-align:center;font-size:35px"> <input type="checkbox" name="selected_test" id="selected_test" value="<?php echo $value['id']; ?>" size="150"></td>
                  <td style="font-size:20px;text-align:center"><?php echo $value['test_name']; ?></td>
                  <td style="font-size:20px;text-align:center"><?php echo $value['test_type_name']; ?></td>
                  <td style="font-size:20px;text-align:center"><?php echo $value['test_price']; ?></td>
                </tr>
                <?php
              }}
                  }
                ?>
              </tbody>

            </table>
        </div>
        <div class="modal-footer edit-group-modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" onclick="checkInventory()" id="inventoryCheckBtn">
            <i class="glyphicon glyphicon-ok"></i> Next
          </button>
        </div>
      </form>
    </div><!-- /tab-panel of teacher information -->
   </div><!-- /modal-content -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="viewResultModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Result</h4>
      </div>
      <div class="modal-body add-modal">
        <div class="row">
          <div id="package1" style="border: none; border-color: none; text-align: center;">
            <b>Porac Perpetual Polyclinic and Diagnostics</b><br/>
            <i>Joven St., Babo Sacan, Porac Pampanga</i></br/>
            <i>0943-086-954(SUN)&0975-787-8252(TM)</i><br/><hr/>
            <div style="text-align: center;">
              <center>
                  <b>Patient Name: </b>
                  <input type="text" style="width: 110px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="patient_names" value="Mariah Carey"/>
                  ||
                  <b>Trans-Date   : </b>
                  <input type="text" style="width: 130px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="trans_date" value="<?php echo date('Y-m-d H:i:s',strtotime("now")); ?>"/>
                  ||
                  <b>Trans-No     : </b>
                  <input type="text" style="width: 85px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="transno" value="1"/>
                  ||
                  <b>Trans-Key    : </b>
                  <input type="text" style="width: 90px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="transkey" value="P0R9C-D4I3G"/>
                  <br/> <hr/><br/><br/>
              </center>
            </div>
          </div>
          <table id="viewResult" class="table table-bordered">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="15%">Package/Test</th>
                <th width="15%">Content</th>
                <th width="20%">Normal Value</th>
                <th width="25%">Result</th>
                <th width="20%">Notes</th>
              </tr>
            </thead>
            <tbody><!--tbody content-->
              <div id="result"></div>
            </tbody>
          </table><!--table end-->
        </div>
      </div><!-- /modal-body -->
      <div class="modal-footer view-result-modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><!-- /.modal-content -->

<div class="modal fade" tabindex="-1" role="dialog" id="UpdateResultModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Result</h4>
      </div>
      <div class="modal-body add-modal">
        <div class="row">
          <div id="package1" style="border: none; border-color: none; text-align: center;">
            <b>Porac Perpetual Polyclinic and Diagnostics</b><br/>
            <i>Joven St., Babo Sacan, Porac Pampanga</i></br/>
            <i>0943-086-954(SUN)&0975-787-8252(TM)</i><br/><hr/>
            <div style="text-align: center;">
              <center>
                  <b>Patient Name: </b>
                  <input type="text" style="width: 110px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="patient_names1" value="Mariah Carey"/>
                  ||
                  <b>Trans-Date   : </b>
                  <input type="text" style="width: 130px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="trans_date1" value="<?php echo date('Y-m-d H:i:s',strtotime("now")); ?>"/>
                  ||
                  <b>Trans-No     : </b>
                  <input type="text" style="width: 85px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="transno1" value="1"/>
                  ||
                  <b>Trans-Key    : </b>
                  <input type="text" style="width: 90px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="transkey1" value="P0R9C-D4I3G"/>
                  <br/> <hr/><br/><br/>
              </center>
            </div>
          </div>
          <table id="updateResult" class="table table-bordered">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="15%">Package/Test</th>
                <th width="15%">Content</th>
                <th width="20%">Normal Value</th>
                <th width="25%">Result</th>
                <th width="20%">Notes</th>
              </tr>
            </thead>
            <tbody><!--tbody content-->
              <div id="result"></div>
            </tbody>
          </table><!--table end-->
        </div>
      </div><!-- /modal-body -->
      <div class="modal-footer view-result-modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="updateTestResult(this)" id="updateTestResult">
          <i class="glyphicon glyphicon-ok"></i> Save Result
        </button>

      </div>
    </div>
  </div>
</div><!-- /.modal-content -->

<!-- add tem modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewRecPackage1Modal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Receipt Generation</h4>
      </div>
      <div class="modal-body add-modal">
        <div class="row">
          <div class="col-md-12">
            <div id="generate-receipt-message"></div>
              <div class="form-group">
                <div id="package1" style="border: none; border-color: none; text-align: center;">
                  <b>Porac Perpetual Polyclinic and Diagnostics</b><br/>
                  <i>Joven St., Babo Sacan, Porac Pampanga</i></br/>
                  <i>0943-086-954(SUN)&0975-787-8252(TM)</i><br/>

                  <hr>
                  <div style="text-align: left; ">
                        <b>Patient Name: </b>
                        <input type="text" style="width: 150px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="patient_names" value="Mariah Carey"/>
                        <br/>
                        <b>Trans-Date   : </b>
                        <input type="text" style="width: 150px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="pendingnumbers" value="<?php echo date('Y-m-d H:i:s',strtotime("now")); ?>"/>
                        <br/>
                        <b>Trans-No     : </b>
                        <input type="text" style="width: 150px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="transno" value="1"/>
                        <br/>
                        <b>Trans-Key    : </b>
                        <input type="text" style="width: 150px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="transkey" value="P0R9C-D4I3G"/>
                        <br/>
                        <b>Frontdesk No : </b>
                        <input type="text" style="width: 150px; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="00001" value="1"/>
                        <br/>
                  </div>
                  <hr/>
                    <h3><b> - C H A R G E - </b></h3>
                    <h3><b> - S L I P - </b></h3>
                  <hr/>
         <div class="receiptResults"></div>
      </div> <!-- /tab-panel of teacher information -->
  </div><!-- /modal-body -->
</div><!-- /.modal-content -->


<script type="text/javascript" src="../custom/js/tests.js"></script>
