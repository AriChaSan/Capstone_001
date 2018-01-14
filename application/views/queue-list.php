<ol class="breadcrumb">
  <li>Home</li> 
  <li class="active">Queue List</li>
</ol>

<div class="col-md-12"> 
  <div class="panel panel-default">
    <div class="panel-heading">
      All Queue's 
    </div>
    <div class="panel-body" style="display:block">        
        <div id="messages"></div>

        <div class="pull pull-right">
          <a href="<?php echo base_url('manage-patient'); ?>" type="button" class="btn btn-default"> 
            <i class="glyphicon glyphicon-plus-sign"></i> Add Queue
          </a>
        </div>

        <br /> <br /> <br />
        
        <table id="manageQueueAllTable" class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Created At</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody><!--tbody content-->  
          </tbody>
        </table><!--table end-->  
    
      </div><!--panel-body end-->
    </div><!--panel-default end-->
  </div><!--md 12 end-->

<script type="text/javascript" src="../custom/js/queue-list.js"></script>
