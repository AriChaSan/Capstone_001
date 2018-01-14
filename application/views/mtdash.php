<!DOCTYPE html>
<html>
<title>Porac Perpetual Polyclinic and Diagnostics	</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3.css">
<link rel="stylesheet" href="TB.css">
<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.css">

<link rel="icon" href="Hosi.png">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-barw3-left-align w3-large w3-green">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large " href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="PPP.php" class="w3-bar-item w3-button w3-padding-large w3-text-white w3-emerald">Porac Perpetual Polyclinic</a>
  <a href="PPP.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-light-emerald w3-text-white" title="Home"><i class="fa fa-home"></i> Home</a>
  <a href="PPPP.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-light-emerald" title="Account Settings"><i class="fa fa-address-card-o"> Patients</i></a>
  <a href="PPPI.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-light-emerald" title="Messages"><i class="fa fa-th-list"></i> Inventory</a>
 <a href="PPPT.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-light-emerald" title="Messages"><i class="fa fa-check-square-o"></i> Test</a>
 <a href="PPPR.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-light-emerald" title="Messages"><i class="fa fa-file-text-o"></i> Results</a>
 <div class="w3-dropdown-hover w3-hide-small w3-right">
    <button class="w3-button w3-padding-large w3-hover-light-emerald w3-text-white " title="Notifications" > Welcome, User <i class="fa fa-caret-down"></i> </button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block">
      <a href="UI.php" class="w3-bar-item w3-button w3-hover-light-emerald"><i class="fa fa-pencil-square-o"></i> Update Info</a>
      <a href="UPW.php" class="w3-bar-item w3-button w3-hover-light-emerald"><i class="fa fa-unlock-alt"></i> Update Password</a>
      <a href="LO.php" class="w3-bar-item w3-button w3-hover-light-emerald"><i class="fa fa-sign-out"></i> Log Out</a>
    </div>
 
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>



<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
