<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
} elseif ($_SESSION['user_type'] != "student") {
    echo "<script>
alert('you are not a student');
window.location.href='login.php';
</script>";
} 
     else {
       $id = $_SESSION['id'];
   
          }
         
//     else {
//         $user_id = $_SESSION['id'];
//         if (strcmp($adv_status, "approved"))
//             {
//                 header('location: manageProject.php');
//                 exit(); 
//             }
//       //  }
// }
require_once 'dbconnect.php';
require_once 'functions.php';

?>

<html>
<head>
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
    <li><a href="#.php">Features</a>
    <ul>
        <li><a href="manageProject.php">Manage Project</a></li> 
    </ul></li>
    <li><a href="usermanual.php">HELP</a></li>
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
    <a href="usermanual.php">HELP</a>
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">

    <tr> 
     <td class="contentArea"> 
	 
       <p>&nbsp;</p>
      
        
<tr> 
<td class="contentArea">            
<p align="center" style="color:#990000;font-size:16px;font-weight:bold;" >Project Tracking and Evaluation System</p>

<p align="left" style="line-height:24px; padding:10px;"><b>Project Tracking System</b> is final project. A Project Tracking and Evaluation 
System is one of latest productivity enhancement tools used widely by all organisations wherever there is a need of tracking and Evaluating 
student project via online tracking system.
<br/><br/>
Lack of paper movements provides Project management operations a speed which was never envisaged in manual mode at all. Software allows a 
student to track his project and automatically schedules and prompts supervisor to track student project and evaluate 
his performance. State of the art management information reports on project details and pending project with reasons and remarks provides
management a better insight to problems and traffic situations of telephone lines. A never before “Report Wizard” not only allows you to
define specific reports on demand but also allows you to define your own sorting and analysis parameters which may be more relevant to you 
but not programmed by us till now.</p>


<form action="advisorlist.php">
<p align="right"><input name="btnList" type="submit" id="btnList" value=" Advisor List " style="font-size:14px;color:#0066FF;padding:5px 8px;" /></p>
</form>
</td>
</tr>
    
</body>
</html>