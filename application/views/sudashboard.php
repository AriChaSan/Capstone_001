<?php
date_default_timezone_set("Asia/Manila");
$date = date("M d Y H:i:s");
?>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <a href="#">
                <div class="panel panel-info" style="font-weight: bold; font-size: 15px;">
                    <div class="panel-heading"  style="text-align: center;">
                        <p style="text-align: left;">Total Number of Patients :<p>
                        <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-heart-empty"></span>&nbsp;<?php echo $countTotalPatient; ?></h1>
                        <p style="text-align: right; font-weight:normal; font-size: 10px;"><i>(Last Checked: <?php echo $date; ?>)</i></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="#">
                <div class="panel panel-info" style="font-weight: bold; font-size: 15px;">
                    <div class="panel-heading"  style="text-align: center;">
                        <p style="text-align: left;">Total Number of Visitors for <i><?php echo date("M d Y"); ?></i> :<p>
                        <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-heart"></span>&nbsp;<?php echo $countTotalPatientToday; ?></h1>
                        <p style="text-align: right; font-weight:normal; font-size: 10px;"><i>(Last Checked: <?php echo $date; ?>)</i></p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <a href="#">
                <div class="panel panel-info" style="font-weight: bold; font-size: 15px;">
                    <div class="panel-heading"  style="text-align: center;">
                        <p style="text-align: left;">Total Sales :<p>
                        <h1 style="font-size: 109px;">₱</span>&nbsp;
                            <?php
                                $amount;
                                foreach ($countTotalSales as $key => $value) {
                                    $amount = number_format($value['totalsales'],2,".",",");
                                }
                                echo $amount;
                            ?>
                        </h1>
                        <p style="text-align: right; font-weight:normal; font-size: 10px;"><i>(Last Checked: <?php echo $date; ?>)</i></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="#">
                <div class="panel panel-info" style="font-weight: bold; font-size: 15px;">
                    <div class="panel-heading"  style="text-align: center;">
                        <p style="text-align: left;">Total Number of Sales for <i><?php echo date("M d Y"); ?></i> :<p>
                        <h1 style="font-size: 109px;">₱</span>&nbsp;
                            <?php
                                $amount;
                                foreach ($countTotalSalesToday as $key => $value) {
                                    $amount = number_format($value['salestoday'],2,".",",");
                                }
                                echo $amount;
                            ?>
                        </h1>
                        <p style="text-align: right; font-weight:normal; font-size: 10px;"><i>(Last Checked: <?php echo $date; ?>)</i></p>
                    </div>
                </div>
            </a>
        </div>
    </div>

     <div class="col-md-12">
        <div class="col-md-6">
            <a href="<?php echo base_url('manage-employee') ?>">
                <div class="panel panel-info" style="font-weight: bold; font-size: 15px;">
                    <div class="panel-heading"  style="text-align: center;">
                        <p style="text-align: left;">Total Number of Employees :<p>
                        <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $countTotalEmployee; ?></h1>
                        <p style="text-align: right; font-weight:normal; font-size: 10px;"><i>(Last Checked: <?php echo $date; ?>)</i></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="<?php echo base_url('inventory') ?>">
                <div class="panel panel-info" style="font-weight: bold; font-size: 15px;">
                    <div class="panel-heading"  style="text-align: center;">
                        <p style="text-align: left;">Total Number of Inventory Items :<p><!-- echo strtotime(date("M d Y 08:00:01"))-->
                        <h1 style="font-size: 100px;"><span class="glyphicon glyphicon-inbox"></span>&nbsp;<?php echo $countTotalItems; ?></h1>
                        <p style="text-align: right; font-weight:normal; font-size: 10px;"><i>(Last Checked: <?php echo $date; ?>)</i></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
