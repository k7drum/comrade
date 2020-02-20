<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
} elseif ($_SESSION['user_type'] != "advisor") {
    echo "<script>
alert('you are not a advisor');
window.location.href='login.php';
</script>";
} else {
    $user_id = $_SESSION['id'];
}
require_once 'dbconnect.php';
require_once 'functions.php';

if(isset($_POST['marks']))
	{
		extract($_POST);

		foreach ($attendance as $student_id)
		{
			$attendance_sql = "update attendance set marks =marks+1 where student_id = '".$student_id."' and staff_id = '".$staff_id."'";
			$result = mysqli_query($con, $attendance_sql);
		}

		if (mysql_affected_rows($con) > 0)
		{

			echo "<script type = 'text/javascript'> ('Attendance Taken.');window.location.replace('attendance.php'); </script>";
		}

		else
		{
			echo "<script type = 'text/javascript'> ('Something went wrong.');window.location.replace('attendance.php'); </script>";
		}
	}
	?>



<html> 
<head> 
  <title>Attendance</title>
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

      <li><a href="advisorIndex.php">Home</a></li>
	  <li><a href="advisormanual.php">HELP</a></li>
	  <li><a href="mail.php">Email</a></li>
	  <li><a href="evaluate.php">Evaluation</a></li>
      <li><a href="attendance.php">Attendance</a></li>
	  <li><a href="logout.php">Logout</a></li>

        <?php if ($_SESSION['user_name'] != null) {
            $nm = $_SESSION['user_name'];
            echo"<li style = 'float:right'><a href='#'>Welcome $nm</a></li>";
          }
          ?>

    </ul>

<form class="search-form">
     <input type="text" placeholder="Search">
     <button>Search</button> 
</form>

  </nav>

  <div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    <a href="adminIndex.php">Home</a>
	<a href="advisormanual.php">HELP</a>
	<a href="mail.php">Email</a></li>
	<a href="evaluate.php">Evaluation</a>
    <a href="attendance.php">Attendance</a>
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
							<tr> 
								<td class="contentArea"> 
									<form method="post" name="formUserReg" id="formUserReg" action="attendance.php">
									<p>&nbsp;</p>
										<table width="600" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
											
											<tr> 
												<td class="contentArea">
													<div class="container">

													<p style="margin-top: 80px">
														<h1> ATTENDANCE </h1></p>
															
															<?php

															$sql = "select s.id, s.name, s.surname, s.course_code, a.marks".
															"from student s, attendance a".
															"where s.id=a.student_id and a.staff_id = '".$_SESSION['user_id']."'";

															$result= mysqli_query($con, $sql);

															if(mysqli_num_rows($result)>0)
															{
																echo '<div style="margin-left: 205px; margin-top: 30px background-color: #88bdbc;">';
																echo '<form method = "POST" action="attendance.php">';
																echo '<table class= "mail">';
																echo '<tr>';

																echo '<th> S/NO</th>';
																echo '<th> ID</th>';
																echo '<th> Name</th>';
																echo '<th> Surname</th>';
																echo '<th> Course</th>';
																echo '<th> Date/Time</th>';
																echo '<th> Marks</th>';

																$sn =1;

																while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
																{
																	echo '<tr>';
																	echo '<td>'.$sn.'</td>';
																	echo '<td>'.$row['id'].'</td>';
																	$id = $row['id'];
																	echo '<td>'.$row['name'].'</td>';
																	echo '<td>'.$row['surname'].'</td>';
																	echo '<td>'.$row['course_code'].'</td>';
																	
																	echo '<td><input type="checkbox" name="attendance[]" value="' . $row['id']. '"</td>';
																	
																	echo '';

																	$sn++;
																
																}
																echo '</table>';
																echo '<p style="background-color:#311fa9;">'.'<input type="submit" name="marks" class="btn" style="color:red">';
																
																echo '</form>';
																echo '</div>';
															}
															else
															{
																echo '<center><p><h3>No Student Assigned.</h3></p></center>';
															}
															?>



														</div><!--DIV CONTAINER-->
													</td><!--CONTENET AREA-->
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











