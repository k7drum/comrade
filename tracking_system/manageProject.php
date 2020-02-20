<?php
session_start();
if (!isset($_SESSION['id'])) 
{
    header("location: login.php");
} elseif ($_SESSION['user_type'] != "student") 
{
    echo "<script>
alert('you are not a student');
window.location.href='login.php';
</script>";
} else 
{
    $user_id = $_SESSION['id'];
}

require_once 'dbconnect.php';
require_once 'functions.php';


   
?>

<html>
<head>

<style>
input.Button {
width: 300px;
padding: 20px;
cursor: pointer;
font-weight: bold;
font-size: 150%;
background: #121ED4;
color: #fff;
border: 1px solid #3366cc;
border-radius: 10px;
margin-top:30px;
}
input.Button:hover {
color: #ffff00;
background: #000;
border: 1px solid #fff;
}
</style>
</head>

<title>Student Page</title>
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
    <li><a href="index.php">Home</a></li>
    <li><a href="#">Features</a>
    <ul>
        <li><a href="manageProject.php">Manage Project</a></li> 
    </ul></li>
    <li><a href="usermanual.php">HELP</a></li>
    <li><a href="evaluation_Report.php">Evaluation Report</a></li>
    <li><a href="logout.php">Logout</a></li>     

    <?php if($_SESSION['name'] != null){
	$nm = $_SESSION['name'];
	echo"<li style = 'float:right'><a href='#'>Welcome $nm</a></li>";}?>
    </ul>
    </ul>
  </nav>

  <div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    <a href="index.php">Home</a>
    <a href="#">Features</a>
    <a href="manageProject.php">Manage Account</a>
    <a href="evaluation_Report.php">Evaluation Report</a>
    <a href="usermanual.php">HELP</a>
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
  <tr> 
	<td class="contentArea"> 
		<form method="post" name="formUserReg" id="formUserReg" action="manageProject.php" align="center">

                <input class="Button" type="button" value="Report" onclick="window.location.href='report.php'" /><br/>
                <input class="Button" type="button" value="UML" onclick="window.location.href='UML_chat.php'" /><br/>
                <input class="Button" type="button" value="Database" onclick="window.location.href='database_chat.php'" /><br/>
                <input class="Button" type="button" value="FinalReport" onclick="window.location.href='final_report.php'" /><br/>
</form>


</td>
</tr>
    
</body>
</html>