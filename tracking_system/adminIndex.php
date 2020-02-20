<!--controling session-->
<?php
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_type']) {
    header("location: login.php");
} elseif ($_SESSION['user_type'] != 'admin') {

    echo "<script>
alert('you are not a Administrator');
window.location.href='login.php';
</script>";
}

require_once "dbconnect.php";
require_once "functions.php";


if(mysqli_affected_rows($con)==1)
{
    echo "Login Successful.";
}
else
{
    echo mysqli_error($con);
}
?>


<html> 
<head> 

<style type="text/css">
#container {
	font-family: Arial, Helvetica, sans-serif;
	background-color: #A2D9CE;
	border: 1px solid #871c83;
	margin-top: 1em;
}
#container ul {
	margin: 0px;
	padding: 0px;
}
#container ul li {
	display: inline;
	line-height: 25px;
}
#container ul li a {
	padding: 5px 1em 5px 1em;
	text-transform: uppercase;
	text-decoration: none;
	font-size: 0.8em;
	color: #641E16;
}
#container ul li a:hover {
	color: #333333;
	background-color: #138D75;
}
</style>
  <title>Admin Page</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="logo.png" />
  <link rel="stylesheet" href="style1.css">
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

    <li><a href="adminIndex.php">Home</a></li>
	  <li><a href="adminmanual.php">HELP</a></li>
	  <li><a href="mail.php">Email</a></li>
	  <li><a href="evaluation_Report_Admin.php">Evaluation Report <Em></Em></a></li>
	  <li><a href="logout.php">Logout</a></li>

  <?php if($_SESSION['name'] != null){
	$nm = $_SESSION['name'];
	echo"<li style = 'float:right'><a href='#'>Welcome $nm</a></li>";}?>
    </ul>

<form class="search-form">
     <input type="text" placeholder="Search">
     <button>Search</button> 
</form>

  </nav>

  <div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    <a href="adminIndex.php">Home</a>
	<a href="adminmanual.php">HELP</a>
	<a href="mail.php">Email</a></li>
	<a href="evaluation_Report_Admin.php">Evaluation Report</a>
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
  

  <tr> 
	<td class="contentArea"> 
		<form method="post" name="formUserReg" id="formUserReg" action="adminIndex.php">
		<p>&nbsp;</p>
		<table width="600" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#600d40" class="entryTable">
			<tr id="entryTableHeader"> 
		    </tr>
			<tr> 
			<td class="contentArea">
											 
											 <H1><CENTER>ADMIN VIEW</CENTER></H1>
											 <div id="container">
													<ul >
													<li><a href="addstaff.php" class="text-warning">Add Staff</a></li>
													<li><a href="#" class="text-warning">Add Course</a></li>
													</ul>	
													</div>	

													<div id="container">
													<ul >
													<li><a href="createTask.php" class="text-warning">New Task</a></li>
													<li><a href="addmilestone.php" class="text-warning">Add Milestone</a></li>
													</ul>	
													</div>				
											
											 <div id="container">
												<ul >
												<li><a href="studentDetails.php" class="text-warning">View Student</a></li>
												<li><a href="studentDetails.php" class="text-warning">Update Student</a></li>
												</ul>
											</div>

												<!--div for container table-->
											<div id="container">
												<ul>
												
											   <li><a href="advisorDetails.php" class="text-warning">View Advisor</a></li>
											  <li><a href="advisorDetails.php" class="text-warning">Update Advisor</a></li>
											  </ul>
											</div>
												<!--div for container table-->
											  <div id="container">
												<ul>
													
													 <li><a href="com_memb_Details.php" class="text-warning">View Committee Member</a></li>
												  <li><a href="com_memb_Details.php" class="text-warning">Update Committee Member</a></li>
												</ul>
											  </div>
													<!--div for container table-->
											  <div id="container">
												<ul>
													
													 <li><a href="#" class="text-warning">Manage Committee</a></li>
													<li><a href="#" class="text-warning">Manage course</a></li>
												</ul>
											  </div>
		  
													<!--div for container table-->
											 <div id="container">
												<ul>
												  <li><a href="#" class="text-warning">View Project</a></li>
												   <li><a href="#" class="text-warning">Close Project</a></li>
												</ul>
											</div>
												
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
				</table>
			</td>
		</tr>
   

  <script>
    function openSlideMenu(){
      document.getElementById('side-menu').style.width = '250px';
      document.getElementById('main').style.marginLeft = '250px';
    }

    function closeSlideMenu(){
      document.getElementById('side-menu').style.width = '0';
      document.getElementById('main').style.marginLeft = '0';
    }
  </script>
</body>
</html>