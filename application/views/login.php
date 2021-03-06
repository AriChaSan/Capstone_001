<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>../assets/bootstrap/css/bootstrap.min.css">
	<!-- boostrap theme -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>../assets/bootstrap/css/bootstrap-theme.min.css">

	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>../custom/css/custom.css">

	<!-- jquery -->
	<script type="text/javascript" src="<?php echo base_url(); ?>../assets/jquery/jquery.min.js"></script>
	<!-- boostrap js -->
	<script type="text/javascript" src="<?php echo base_url(); ?>../assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<style>
body {background-color: #08721d;}
</style>

<style>
.parallax {
    /* The image used */
    background-image: url("<?php echo base_url(); ?>../assets/images/hospital-background-13.jpg");

    /* Set a specific height */
   	/*height: 500px;*/

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<body class="parallax">


<div class="col-lg-12">
	<div class="panel panel-default login-form" style="margin-top: 10%; width: 450px; margin-left: 35%; border:2px; border-color:#33cc33; border-style:solid;">
	  	<div class="panel-body">


	  		<form method="post" action="index.php/users/login" id="loginForm">
		    	<fieldset>
		    		<legend>
		    			<h3><img src="<?php echo base_url(); ?>../assets/images/LOGO.png" style="width: 67px"> Porac Perpetual Polyclinic</h3>
		    		</legend>

		    		<div id="message"></div>

					<div class="form-group">
				    	<label for="username" style="text-align: left">Username</label>
				    	<input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus>
				  	</div>
				  	<div class="form-group">
				    	<label for="password" style="text-align: left">Password</label>
				    	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				  	</div>

				  	<button type="submit" class="col-md-12 btn btn-success login-button">Submit</button>
		    	</fieldset>
		    </form>
				<br/>
				<div style="text-align: right;">
				    <a href="<?php echo base_url('search'); ?>"> <i> Search result... </i></a>
				</div>
	  	</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>../custom/js/login.js"></script>

</body>
</html>
