<!--controlling session-->
<?php
session_start();
if(!isset($_SESSION['user_id']))
{
      header("location: login.php");
}
elseif($_SESSION['user_type']!="admin")
{
	
	echo "<script>
alert('you are not an administrator');
window.location.href='login.php';
</script>";
}
else 
{
	$user_id=$_SESSION['user_id'];
}
?>



<?php
require_once 'dbconnect.php';
require_once 'functions.php';

$errorMessage = '';
 //Checking if delete button is clicked getting committee_id from delete link
 if(isset($_GET['committee_id']))
 {
	 
	 $committee = $_GET['committee_id'];
	 //deleting from committee
	$sql = "DELETE FROM user
				WHERE committee_id= $committee";	
	$result = mysqli_query($con, $sql) or die("sorry");
	$errorMessage= "your committee has been deleted successfully.";
	
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

  <title>Details</title>
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
	  <li><a href="evaluate.php">Evaluation</a></li>
      <li><a href="#">Attendance</a></li>
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
	<a href="evaluate.php">Evaluation</a>
    <a href="#">Attendance</a>
    <a href="logout.php">Logout</a>
  </div>

  <div id="main">
						<tr> 
							 <td class="contentArea"> 
								<form method="post" name="formUserReg" id="formUserReg" action="committeeDetails.php">
									<p>&nbsp;</p>
									<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="text">
										<table>
								<thead>
									<?php echo $errorMessage; ?>
									<tr>
										<th> ID </th>
										<th> Committee Name </th>
										<th> Details </th>
										
									</tr>
								</thead>
   
									<?php
									//selecting from committee table 
									$sql = "SELECT committee_id, committee_name
											FROM committee";
											
									$result = mysqli_query($con, $sql);
									$i=0;
									while($row = mysqli_fetch_assoc($result))
									 {
									extract($row);
									
									
									
									?>
							<tbody>
								<!--calling committee entities from database to table--> 
								  <td width="150">&nbsp;<?php echo ucwords($committee_id); ?></td>
								  <td width="200">&nbsp;<?php echo ucwords($committee_name); ?></td>
								
								   <td  align="center"><a href="editcommittee.php?committee_id=<?php echo $row['committee_id']?>">Edit</a>/<a href="committeeDetails.php?id=<?php echo $row['committee_id']?>">Delete</a></td> 
								
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
