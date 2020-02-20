<?php
session_start();

if(!isset($_SESSION['id']))
{
      header("location: login.php");
}
elseif($_SESSION['user_type']!="student")
{
	
	echo "<script>
alert('you are not a Student');
window.location.href='login.php';
</script>";
}


require_once 'dbconnect.php';
require_once 'functions.php';
//if valid or invalid 
    $errorMessage = '';
	$success=' ';
//when you clicked on submit	
if(isset($_POST['btnSubmit']))
{
	
$name= $_POST["name"];
$user_id = (int)$_SESSION['id'];


$sql= "SELECT * from staff WHERE user_type='advisor'";

$result = mysqli_query($con, $sql);
$sql = mysqli_fetch_row($result);



		if ( (count($result) > 0 )) 
		{
			$sql = ("UPDATE student SET adv_status = pending WHERE id = '$user_id'");
			echo "<script>alert('Request Sent, waiting for approval');window.location.replace('advisorlist.php'); </script>";
		
			if (mysqli_query($con, $sql))
			{
				echo "New Advisor selected successfully";
			} else 
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
		
		} 
		else 
		{
				echo "New record created successfully";
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

<title>Advisor List</title>
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
    <a href="manageProject.php">Manage Project</a> 
    <a href="usermanual.php">HELP</a>
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
					<tr> 
						<td class="contentArea"> 
							<form method="post" name="formUserReg" id="formUserReg" action="advisorlist.php" enctype="multipart/form-data">
								<p>&nbsp;</p>
								<table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#121ED4" class="entryTable">
									<tr id="entryTableHeader"> 
										<td><p align="center">Project Advisor Selection Form</p> </td>
										<tr> 
											 <td class="contentArea"> 
											 
											  <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
											   
												
                                                	<tr class="entryTable">
													   
													   <td width="100" align="right">Advisor</td>
														
														 <td><label>
														
														  <select name="name" class="box" onchange="getId(this.value);">
														  
														  <option value="" selected="selected">....</option>
														 <?php
														 //selecting from user table
														 $query= "SELECT * from staff where user_type='advisor' and adv_count<4";
														 $results= mysqli_query($con, $query);

														 while($name = mysqli_fetch_array($results, MYSQLI_ASSOC))
														 {
															 echo '<option value = "'.$name['id'].'">'.$name['name'].'</option>';
														 }											 
														 ?>
														 
														  </select>
														  </label></td>
														</tr>
													
													<tr>
													   
													   
													   
													   <p align="right"><td><input name="btnSubmit" type="submit" id="btnLogin" value=" Submit  ">
														<td><input type="reset" value="Cancel"> </td></p>
			                                        </tr>
			  </table>
			 </td>
			</tr>
		  </tr>
		 </table>
		</form>
	  </td></tr>
	 </td></tr>
	</table>
  </table>
 </body>
</html>