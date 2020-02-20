<?php
require_once 'dbconnect.php';
require_once 'functions.php';

$errorMessage = '&nbsp;';

if (isset($_POST['btnLogin'])) {
	$result = Login();
	
	if ($result != '') {
		$errorMessage = $result;
	}
}
   
      	$errorMessage = '';
	$success=' ';  
?>



<html>
<head>
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="style_login.css">
<link rel="stylesheet" href="style1.css">
<link rel="icon" type="image/png" href="transparentBg.png" />   
</head>
<body>

    <nav class="nav_bar">
    <span class="open-slide">
      <a href="#" onclick="openSlideMenu()">
        <svg width="35" height="35">
            <path d="M0,5 30,5" stroke="#f01a0c" stroke-width="5"/>
            <path d="M0,14 30,14" stroke="#082599" stroke-width="5"/>
            <path d="M0,23 30,23" stroke="#08990f" stroke-width="5"/>
        </svg>
      </a>
    </span>

    <ul class="navbar1">
      <li><a href="frontpage.php">Home</a></li>
      <li><a href="register.php">Register</a></li>
      <li><a href="login.php">Login</a></li>
      
     
    </ul>
  </nav>

  <div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    <a href="frontpage.php">Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
   
  </div>


  <div id="main">

    <div class="login-box">
    <img src="image/icon.png" class="icon">
        <h1>Login Here</h1>
            <form method = "POST" action="login.php">
            <p>User ID</p>
            <input type="text" name="txtUserID"  id="txtUserID"  size="30" maxlength="50" required/">
            
            <p>Password</p>
            <input type="password" name="txtPassword" id="txtPassword" size="30" maxlength="50" required/">
            
            <input type="submit" name="btnLogin" value="Login" id="btnLogin">
            
            <a href="forget_password.php">Forget Password</a>
            <br>
            <a href="register.php">Create Account</a>   
            </form>
        </div>
    
    </body>
</html>