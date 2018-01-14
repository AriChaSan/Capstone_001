<link rel="stylesheet" href="W3.css">



<ol class="breadcrumb" style="background-color:#60a917;">
  <li style="color:#fff;">Home</li> 
  <li class="active" style="color:#fff;">Inventory</li>
</ol>

<div class="panel panel-default" >
  <div class="panel-body">
  <div id="messages"></div>
  <div class="pull pull-right">
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#additemModal" id="addItemModelBtn" style="background-color:#60a917;"> 
      <i class="glyphicon glyphicon-plus-sign"  ></i> Add Item
    </button>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#viewInventoryHistoryModal" onclick="getInventoryHistory()" id="inventoryhistoryModelBtn"> 
      <i class="glyphicon glyphicon-eye-open"></i> View Inventory History
    </button>
  </div>
  <br/><br/>
    <form action="inventory/updateInfo" method="post" id="updatePatientForm" enctype="multipart/form-data">  
      <div class="col-md-3">
        <fieldset>
          <legend>Item Info</legend>
            <div class="form-group">
              <label for="itemid">ID</label>
              <input type="text" class="form-control" id="itemid" name="itemid" placeholder="ID" readonly="true" autocomplete="off" >
            </div>
            <div class="form-group">
              <label for="itemname">Item Name</label>
                <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Item Name" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="itemq">Quantity</label>
              <input type="text" class="form-control" id="itemq" name="itemq" placeholder="Quantity" autocomplete="off" >
            </div>
            <div class="form-group">
              <label for="itemtype">Item Type</label>
              <input type="text" class="form-control" id="itemtype" name="itemtype" readonly="true" placeholder="Item Type" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="lastupdate">Last Updated Date</label>
                <input type="text" class="form-control" id="lastupdate" name="lastupdate" readonly="true" placeholder="Last Updated Date" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="updatedby">Last Updated By</label>
                <input type="text" class="form-control" id="updatedby" name="updatedby" readonly="true" placeholder="Last Updated By" autocomplete="off">
            </div>
        </fieldset> 

         <br/> <br/>
            <center>  
              <button type="submit" class="btn btn-primary">Save Changes</button>
              <button type="button" class="btn btn-default">Reset</button>      
            </center>   
          <br/><br/> 

      </div>
    </form>
    
    <div class="col-md-9"> 
      <table id="manageInventoryTable" class="table table-bordered">
        <thead>
          <tr>
            <th>Item ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Last Updated</th>
            <th>Last Updated By</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody><!--tbody content-->  
        </tbody>
      </table><!--table end-->
    </div>  
  </div>
</div> 

<!-- add tem modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewInventoryHistoryModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Inventory History</h4>
      </div>

      <div class="modal-body">       
        <div class="col-md-12"> 
          <table id="viewInventoryHistoryTable" class="table table-bordered">
            <thead>
              <tr>
                <th>Item ID</th>
                <th>Qty. Old</th>
                <th>Qty. New</th>
                <th>Summary</th>
                <th>Last Updated</th>
                <th>Last Updated By</th>
              </tr>
            </thead>

            <tbody><!--tbody content-->  

            </tbody>
          </table><!--table end-->
        </div>  
      </div>

      <div class="modal-footer edit-group-modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> 

    </div> <!-- /tab-panel of teacher information -->
  </div><!-- /modal-body -->            
</div><!-- /.modal-content -->  

<!-- add tem modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="additemModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Item</h4>
      </div>
      <form class="form-horizontal" method="post" action="inventory/create" id="addItemForm">
      <div class="modal-body add-modal">       
        <div class="row">
          <div class="col-md-12">
            <div id="add-item-message"></div>
              <div class="col-md-12">

                <div class="form-group">
                  <label for="itemname" class="col-sm-4 control-label">Item Name : </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Item Name" />
                    </div>
                </div>

                <div class="form-group">
                  <label for="itemtype" class="col-sm-4 control-label">Item Type: </label>
                  <div class="col-sm-8">
                    <select class="form-control " name="itemtype" id="itemtype">
                      <option value="" disabled="true">Select Item Type</option>
                      <option value="1">TUBES</option>
                      <option value="2">RGT</option>
                      <option value="3">TIPS</option>
                      <option value="4">KIT</option>
                      <option value="5">GENERAL</option>
                    </select>
                  </div>
                </div>              
              </div> <!-- /col-md-12 -->   
          </div><!-- /col-md-12 -->
        </div><!-- /row -->  
        </div>

        <div class="modal-footer edit-group-modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>         
        </form>
      </div> <!-- /tab-panel of teacher information -->
  </div><!-- /modal-body -->            
</div><!-- /.modal-content -->         
      
<script type="text/javascript" src="../custom/js/inventory.js"></script>
