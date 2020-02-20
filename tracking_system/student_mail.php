<!--controlling session-->
<?php
session_start();
if(!isset($_SESSION['user_id']))
{
      header("location: login.php");
}
elseif($_SESSION['user_type']!="advisor")
{
	
	echo "<script>
alert('you are not an administrator');
window.location.href='login.php';
</script>";
}
else 
{
	$staff_id=$_SESSION['user_id'];
}
?>

<?php
require_once 'dbconnect.php';
require_once 'functions.php';
$errorMessage = '';
 //Checking if Rejected button is clicked getting id from rejected link
 if(isset($_GET['id']))
 {


	$id = $_GET['id'];
	if($_GET['adv_status']=="rejected") 
	{
	   $sql="UPDATE student SET adv_status='rejected' 
	   WHERE id='$id'";

	   mysqli_query($con, $sql);
	   
	   if(mysqli_affected_rows($con)>0)
	   {
		   echo "Registraction Rejected";
	   }
	   else
	   {
		   echo mysqli_error($con);
	   }
	  
	 }

	if($_GET['adv_status']=="approved") 
	{
	   $sql="UPDATE student set adv_status='approved' AND staff_id='$staff_id' 
	   WHERE id='$id'";

	   mysqli_query($con, $sql);
	   //mysql_query($sql);
	   if(mysqli_affected_rows($con)>0)
	   {
		   echo "Registraction Approved";
	   }
	   else
	   {
		   echo mysqli_error($con);
	   }
	 }
}
?>




<html>
<head>

<style type="text/css">
table {
    width: 60%;
    margin: 70px auto;
    border-collapse: collapse;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    

}

tr {
	border-bottom: 3px solid #cbcbcb;
}

th {
	font-size: 16px;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #121ED4;
    color: white;
}

th, td{
    height: 30px;
    border: 1px solid #ddd;
    padding: 8px;
}

tr:hover {
	background: #E9E9E9;
}


tr:nth-child(even){
    background-color: #f2f2f2;
    }


.task {
	text-align: left;
}

.delete{
	text-align: center;
}
.delete a{
	color: white;
	background: #a52a2a;
	padding: 1px 6px;
	border-radius: 3px;
	text-decoration: none;
}

textarea {
    width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #121ED4;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
    margin:20px auto; 
}


</style>


<title>Advisor</title>
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

    <li><a href="com_memb_Index.php">Home</a></li>
	  <li><a href="advisormanual.php">HELP</a></li>
	  <li><a href="student_mail.php">Email</a></li>
	  <li><a href="evaluate.php">Evaluation</a></li>
    <li><a href="evaluationReport.php">Evaluation Report</a></li>
	  <li><a href="logout.php">Logout</a></li>

        <?php if ($_SESSION['name'] != null) {
            $nm = $_SESSION['name'];
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
  <a href="com_memb_Index.php">Home</a>
	<a href="advisormanual.php">HELP</a>
	<a href="student_mail.php">Email</a></li>
	<a href="evaluate.php">Evaluation</a>
  <a href="evaluationReport.php">Evaluation Report</a>
  <a href="logout.php">Logout</a>
  </div>
  <div id="main">

					                    
	</ul>
	</div>
	</tr>
			<tr> 
				<td class="contentArea"> 
					<form method="post" name="formUserReg" id="formUserReg" action="student_mail.php">
					<p>&nbsp;</p>
						<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="text">
							<table id="container">
								<thead>

									<?php echo $errorMessage; ?>
									<tr>
										<th> ID </th>
										<th> Name </th>
										<th> Surname </th>
                                        <th> Email </th>
                                        <th> User Type </th>
										<th> Status </th>
										<th> Request </th>
										
									</tr>
								</thead>
   
									<?php
									//selecting from user table 
									$sql = "SELECT id, name, surname, email, user_type, adv_status
                                            FROM student 
											WHERE user_type = 'student' AND status='approved' AND staff_id='$staff_id'";
											
									$result = mysqli_query($con, $sql);
									$i=0;
									while($row = mysqli_fetch_assoc($result)) {
									extract($row);
									$id = $row['id'];
									
									
									?>
							<tbody>
								<!--calling user entities from database to table--> 
								  <td width="150">&nbsp;<?php echo ucwords($id); ?></td>
								  <td width="150">&nbsp;<?php echo ucwords($name); ?></td>
								  <td width="150">&nbsp;<?php echo ucwords($surname); ?></td>
                                  <td width="150">&nbsp;<?php echo ucwords($email); ?></td>
                                  <td width="150">&nbsp;<?php echo ucwords($user_type); ?></td>
                                  <td width="150">&nbsp;<?php echo ucwords($adv_status); ?></td>
								  <td  align="center"><a href="student_mail.php?id=<?php echo $id?>&adv_status=approved">Approved</a>/<a href="student_mail.php?id=<?php echo $id?>&adv_status=rejected">Rejected</a></td> 
								
							</tbody>
	
	<?php
	   } // end while
	?>
    
</table><!--close container-->
</table>
</table>
<p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</td>
</tr>
</table></td></tr></table>
</body>
</html>
