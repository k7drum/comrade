<!--controlling session -->
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
		$id=$_SESSION['user_id'];
	}
?>

	
    <?php
	//connecting database connection
	require_once "functions.php";
	require_once "dbconnect.php";
	//getting committee_member from deleting link
	if(isset($_GET['user_type']))
	{
	$user_type = $_GET['user_type'];
	//select from committee_member table 
	$sql="SELECT * FROM staff WHERE role=$committee_member";

	$result = mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($result)){
		extract($row) or die(mysqli_error($con));
	
		 $id= $row['id'];
         $name= $row['name'];
         $surname= $row['surname'];
		 $user_type= $row['user_type'];
		}//while 
	//inserting into trash after deleting so as to save user 
	$query= "INSERT INTO trash (id, name, surname, user_type) VALUES('$id', '$name', '$surname', '$user_type')";
	$query2=mysqli_query($con,$query) or die(mysqli_error($con));
		
	if($query2)
	{
		//delete from committee_member after saving to trash
	$sql = "DELETE FROM staff 
				WHERE role = $committee_member";	
	$result = mysqli_query($con, $sql) or die("Error when tryin to delete note.");
	
		echo "<script>
		alert('success');
		window.location.href='com_memb_Details.php';
		</script>";
	}//end if
}//end if
	
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
	  <li><a href="#">Evaluation Report</a></li>
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
	<a href="#">Evaluation Report</a>
    <a href="logout.php">Logout</a>
  </div>

  <div id="main">
						<tr> 
							 <td class="contentArea"> 
								<form method="post" name="formUserReg" id="formUserReg" action="com_memb_Details.php">
									<p>&nbsp;</p>
									<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="text">
										<table>
	
   
    <?php
	//selecting from committee_member
			$sql = "SELECT *
			FROM staff 
			WHERE role = 'committee_member' ";
			
				$result = mysqli_query($con, $sql);
				$i=0;
					if(mysqli_num_rows($result)>0)
					{
			
							
						echo '<thead>
							<tr>
								<th> ID </th>
                                <th> Name </th>
                                <th> Surname </th>
								<th> Password </th>
                                <th> Email </th>
                                <th> Gender </th>
                                <th> Date Created </th>
                                <th> Semester </th>
								<th> Details </th>
							</tr>
						</thead>';
						while($row = mysqli_fetch_assoc($result)) 
							{
		
								extract($row);
		?>
								<tbody>
								<!--calling entity of committee_member to table -->
								  <td width="150">&nbsp;<?php echo ucwords($id); ?></td>
								  <td width="200">&nbsp;<?php echo ucwords($name); ?></td>
                                  <td width="200">&nbsp;<?php echo ucwords($surname); ?></td>
								  <td width="200" align="center"><?php echo ucwords($password); ?></td>
								  <td width ="200" align="center"><?php echo ucwords($email); ?></td>
                                  <td width="200">&nbsp;<?php echo ucwords($gender); ?></td>
								   <td width="200" align="center"><?php echo ucwords($date_time); ?></td>
                                   <td width="200">&nbsp;<?php echo ucwords($semester); ?></td>

								   <td  align="center"><a href="edit_com_memb.php?id=<?php echo $row['id']?>">Edit</a> /<a href="com_memb_Details.php?id='<?php echo $id?>'"onclick="return confirm('Are you sure?')">Delete</a> 
								</td>
								</tbody>
							
											<?php
											}//end while
										}//end if
											else{
												echo "  Sorry no records found ";
												}//END ELSE
											?>
								</table>
						</table>
					</form>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
</body>
</html>
