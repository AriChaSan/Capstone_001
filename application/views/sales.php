<ol class="breadcrumb">
  <li>Home</li> 
  <li class="active">Sales</li>
</ol>

<div class="col-md-12"> 
  <div class="panel panel-default">
    <div class="panel-heading">
      Total Sales 
    </div>
    <div class="panel-body" style="display:block">   
      <div id="messages"></div>     
        <form action="" name="myForm" enctype="multipart/form-data" method="post" >      
         <input type="text" style=" width: 50px; height:42px; border:none;"  value="From:" readonly/> 
         <input type="date" name="dateFrom" style=" width: 140px;" required /> 
         <input type="text" style=" width: 50px; height:42px; border:none;"  value="To:" readonly/> 
         <input type="date" name="dateTo" style=" width: 140px;" required />
         <input type="submit" class="btn btn-warning" style=" width: 100px;height:42px;border:none;" name="submit" value="Submit" >  
        </form>

        <br /> <br /> <br />
        
        <table id="manageAllSalesTable" class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Date</th>
              <th>Amount (₱)</th>
            </tr>
          </thead>
          <tbody><!--tbody content-->  
          </tbody>
        </table><!--table end-->  
      <br/></br/>
      <?php
        $amount;
        foreach ($countTotalSales as $key => $value) {
            if($value['totalsales'] != null){
                $amount = $value['totalsales'];
            } else{
                $amount = '0.00';
            }  
            if(is_float($amount) === false){
              $amount = $amount . '.00';
            }
        }
      ?>
      <input type="text" style=" text-align:right; width: 100%; height:42px; border:none; font-size: 50px; font-weight:bold;" value="TOTAL: ₱<?php echo $amount; ?>" readonly/>     
      </div><!--panel-body end-->
    </div><!--panel-default end-->
  </div><!--md 12 end-->

<script type="text/javascript" src="../custom/js/sales.js"></script>
