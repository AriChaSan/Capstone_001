<style>
table, th, td {
   border: 2px solid black;
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
                    <th>Actions</th>
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
<input type="hidden" value="" id="hiddenpatientname"/>
<input type="hidden" value="" id="hiddenqueue_id"/>
<input type="hiddenpatientname" value="" id="patient_number"/>
<input type="text" value="" id="total_amount"/>
<input type="text" value="" id="transaction_id"/>
<!-- add tem modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="choosePackageModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Choose Package</h4>
      </div>
      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="inventory/checkInventory" id="choosePackageForm">
      <div class="modal-body add-modal">       
        <div class="row">
          <div class="col-md-12">
            <div id="choose-test-message"></div>
              <div class="col-md-12"> 
                  <div class="form-group">
                  <label for="alltest" class="control-label">Choose Test: </label>
                  <div class="col-sm-12"><!--  onchange="changeitemtype(this) -->
                    <select class="form-control " name="alltest" id="alltest"">
                      <option value="" disabled="true">Select a Test</option>
                      <?php
                        if(isset($alltest)){
                          foreach ($alltest as $key => $value) {
                      ?>
                        <option value="<?php echo $value['id']; ?>"> <?php echo $value['test_name']; ?> </option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>         
              </div>  
          </div><!-- /col-md-12 -->
        </div><!-- /row -->  
        </div>
        
        <div class="modal-footer edit-group-modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" onclick="checkInventory()" id="inventoryCheckBtn"> 
            <i class="glyphicon glyphicon-ok"></i> Next
          </button>
        </div>         
        </form>
      </div> <!-- /tab-panel of teacher information -->
  </div><!-- /modal-body -->            
</div><!-- /.modal-content --> 

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

<!--
<div class="modal fade" tabindex="-1" role="dialog" id="customPackage" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Custom Package</h4>
      </div>
      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="inventory/checkInventory" id="customPackage">
        <div class="modal-body add-modal">       
          <div id="add-package-message"></div>
          <div class="w3-main" style="margin-left:200px;margin-top:45px;">
            <h1 class="w3-left w3-animate-left"><i class="fa fa-plus-square w3-xxxlarge " ></i> Select Test</h1>
            <br/><br/><hr/>
            <h1 class="w3-center w3-green w3-border">Test List</h1>
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Package</h2>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All" checked>
              <label>Package 1</label><br> - FBS<br>- TAG<br>- TC<br>- BUA<br>- CREA<br>- SGPT</p>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All">
              <label>Package 2</label><br> - FBS<br>- TAG<br>- TC<br>- BUA<br>- CREA<br>- SGPT<br>- CBC w/ PC<br>- UA</p>
               <p>
              <input class="w3-radio" type="radio" name="BB" value="All">
              <label>Package 3</label><br> - FBS<br>- TAG<br>- TC<br>- HDL/LDL<br>- BUA<br>- CREA<br>- SGPT<br>- CBC W/ PC<br>- UA</p>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All">
              <label>Package 4</label><br> - FBS<br>- TAG<br>- TC<br>- HDL/LDL<br>- BUA<br>- CREA<br>- SGPT<br>- CBC W/ PC<br>- UA<br>- Na<br>- k<br>-FBS/RBS<br> - BUN<br>- Creatinine<br>- BUA<br>- Cholesterol<br>- Triglycerides<br>- HDL/LDL<br>- SGPT (ALT)<br>- SGOT (AST)<br>- HbA1C<br>- ALP<br>- ACP<br>Sodium (Na)<br>- Potassium (k)<br>- Chloride (Cl)<br>- Ionized Calcium<br>- Inorganic Phosporus<br>- LDH<br>- TPHA<br>- Total CPK with fraction<br>- Total CPK/CK<br>- CKMB<br>- Amaylase</p>
            </form>
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Clinical Microscopy</h2>
              <p>
              <input class="w3-radio" type="radio" name="CM" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="UNL" value="female">
              <label>Urinalysis</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="FCL" value="female">
              <label>Fecalysis</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="UB" value="female">
              <label>Urine Bile</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="US" value="female">
              <label>Urine Sugar</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="UP" value="female">
              <label>Urine pH</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="OB" value="female">
              <label>Occult Blood</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="PT" value="female">
              <label>Pregnancy Test</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="ALB" value="female">
              <label>Albumin</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="SPA" value="female">
              <label>Sperm Analysis</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="PPS" value="female">
              <label>Pap's Smear</label></p>
            </form>
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Hematology</h2>
              <p>
              <input class="w3-radio" type="radio" name="HMT" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CBC" value="female">
              <label>CBC</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="HGT" value="female">
              <label>HGB &#38; HCT</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="WBC" value="female">
              <label>WBC Count</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="PLC" value="female">
              <label>Platelet Count</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="PRP" value="female">
              <label>Peripheral Smear</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="RTC" value="female">
              <label>Reticulocyte count</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="ESR" value="female">
              <label>ESR</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CTT" value="female">
              <label>Clotting Time</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BDT" value="female">
              <label>Breeding Time</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="PTP" value="female">
              <label>Protime(PT)</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="PTT" value="female">
              <label>Prothrombin Time (PTT)</label></p>
            </form>
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Blood Banking</h2>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Blood typing (ABO)</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTRH" value="female">
              <label>Blood typing (RH)</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Crossmatching</label></p>
              <p>
            </form>
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Serology</h2>
              <p>
              <input class="w3-radio" type="radio" name="SRL" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>RPR/VDRL</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTRH" value="female">
              <label>ASO Titer</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>RA Latex</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>CRO</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>C3</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Dengue NS1</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Widal test</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Malaria</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Typhidot</label></p>
            </form>
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Tumor Markers</h2>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>PSA</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTRH" value="female">
              <label>CEA</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>AFP</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Beta HCG</label></p>
            </form>  
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Clinical Chemistry</h2>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>FBS/RBS</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTRH" value="female">
              <label>BUN</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Creatinine</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>BUA (Uric Acid)</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Cholesterol</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Triglycerides</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>HDL/LDL</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>SGPT (ALT)</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>SGOT (AST)</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>HgbA1C</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Alkaline Phosphatase</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Acid Phosphatase</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Sodium</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Potassium</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Chloride</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Ionized Calcium</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Total Calcium</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Inorganic Phosporus</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>LDH</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>TPHA</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Total CPK/ with fraction</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Total CPK/CK</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>CK_MB</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Amylase</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Lipase</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Total Bili - Direct Bili</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Albumin</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>TP A/G Ratio</label></p>
            </form>  
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Endocrinology</h2>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>T3</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTRH" value="female">
              <label>T4</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>FT4</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>TSH</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>FSH</label></p>
            </form>  
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Microbiology</h2>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Gram stain</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTRH" value="female">
              <label>AFB stain</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>KOH mount</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Stool C/S</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Urine C/S</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Blood C/S</label></p>
            </form>
            <form class="w3-container w3-card-4">
              <h2 class="w3-center w3-blue">Immunology</h2>
              <p>
              <input class="w3-radio" type="radio" name="BB" value="All" >
              <label>Select All</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTABO" value="female">
              <label>Hepatitis B Profile</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="BTRH" value="female">
              <label>Hepatitis B Profile w/HAV IgM</label></p>
              <p>
              <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>HBSAg Screening Test</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>HBSAg ELISA</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Anti-HBS</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>HbeAg</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Anti-Hbe</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Anti-HBc (IgG)</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Anti-HBc (IgM)</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Anti-HAV (IgG)</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Anti-HAV (IgM)</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>Anti-HCV</label></p>
              <p>
               <input class="w3-check" type="checkbox" name="CSM" value="female">
              <label>HIV</label></p>
            </form> 
          </div> 
        </div>  
      </form> 
      <div class="modal-footer edit-group-modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="checkInventory()" id="inventoryCheckBtn"> 
          <i class="glyphicon glyphicon-ok"></i> Next
        </button>
      </div>        
    </div> <!-- /tab-panel of teacher information -->
  </div><!-- /modal-body -->            
</div>
-->

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