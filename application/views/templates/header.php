<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>

  <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- boostrap theme -->
  <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap-theme.min.css">
  <!-- datatables css -->
  <link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/jquery.dataTables.min.css">
  <!-- fileinput css -->
  <link rel="stylesheet" type="text/css" href="../assets/fileinput/css/fileinput.min.css">
  <!-- fullcalendar css -->
  <link rel="stylesheet" type="text/css" href="../assets/fullcalendar/fullcalendar.min.css">
  <!-- keith calendar css -->
  <link rel="stylesheet" type="text/css" href="../assets/keith-calendar/jquery.calendars.picker.css">

  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="../custom/css/custom.css">

  <!-- jquery -->
  <script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>



</head>
<body>


<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <?php if(($_SESSION['account_type']) === '8'){ ?><!--medtech -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('mtdash') ?>  ">Porac Perpetual Polyclinic</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
        <ul class="nav navbar-nav">
          <li id="navHome"><a href="<?php echo base_url('mtdash') ?>"> <i class="glyphicon glyphicon-home"></i> Home <span class="sr-only">(current)</span></a></li>

          <li id="navInventory"><a href="<?php echo base_url('inventory') ?>"> <i class="glyphicon glyphicon-inbox"></i> Inventory <span class="sr-only">(current)</span></a></li>

          <li id="navTests"><a href="<?php echo base_url('tests') ?>"> <i class="glyphicon glyphicon-tasks"></i> Tests <span class="sr-only">(current)</span></a></li>

           <!--<li id="navResult"><a href="<?php echo base_url('PPP.php') ?>"> <i class="glyphicon glyphicon-list-alt"></i> Result <span class="sr-only">(current)</span></a></li>-->
        </ul>
    <?php }elseif(($_SESSION['account_type']) === '9'){ //an owner?>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('sudashboard'); ?>">Porac Perpetual Polyclinic</a>
      </div>
       <ul class="nav navbar-nav">
          <li id="navDash"><a href="<?php echo base_url('sudashboard'); ?>"> <i class="glyphicon glyphicon-dashboard"></i> Home <span class="sr-only">(current)</span></a></li>
          <li id="navCalendar"><a href="<?php echo base_url('coactivities'); ?>"> <i class="glyphicon glyphicon-calendar"></i> Calendar <span class="sr-only">(current)</span></a></li>
          <li class="dropdown" id="navEmployee">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> Employee <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li id="navCreateEmployee"><a href="<?php echo base_url('add-employee') ?>">Create</a></li>
              <li id="navManageEmployee"><a href="<?php echo base_url('manage-employee') ?>">Manage</a></li>
            </ul>
          </li>
          <li id="navSales"><a href="<?php echo base_url('sales'); ?>"> <b>₱</b> Sales</a></li>
        </ul>
    <?php }else if(($_SESSION['account_type']) === '7'){ //a recept?>
      <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('rcdash'); ?>"><img src="../LOGO.png" style="width:70px"></a>
        </div>
        <ul class="nav navbar-nav">
          <li><a class="navbar-brand" href="<?php echo base_url('rcdash'); ?>">Porac Perpetual Polyclinic</a></li>
          <li id="navHome"><a href="<?php echo base_url('rcdash') ?>"> <i class="glyphicon glyphicon-home"></i> Home <span class="sr-only">(current)</span></a></li>

           <li class="dropdown" id="navPatient">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-heart-empty"></i> Patients <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li id="navCreatePatient"><a href="<?php echo base_url('add-patient') ?>">Create</a></li>
              <li id="navManagePatient"><a href="<?php echo base_url('manage-patient') ?>">Manage</a></li>
            </ul>
          </li>

          <!--<li id="navInventory"><a href="<?php echo base_url('queue-list') ?>"> <i class="glyphicon glyphicon glyphicon-th-list"></i> Queue List <span class="sr-only">(current)</span></a></li>-->
          <li id="navTests"><a href="<?php echo base_url('tests') ?>"> <i class="glyphicon glyphicon-tasks"></i> Queue and Tests <span class="sr-only">(current)</span></a></li>

           <!--<li id="navResult"><a href="<?php echo base_url('PPP.php') ?>"> <i class="glyphicon glyphicon-list-alt"></i> Result <span class="sr-only">(current)</span></a></li> -->
        </ul>
    <?php } ?>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('setting') ?>">Setting</a></li>
            <li><a href="<?php echo base_url('users/logout'); ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
