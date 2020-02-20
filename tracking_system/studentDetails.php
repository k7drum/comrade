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
alert('you are not an Administrator');
window.location.href='login.php';
</script>";
}
else 
{
	$id=$_SESSION['user_id'];
}

?>
   <?php
	require_once "functions.php";
	require_once "dbconnect.php";

	//getting from session
	if(isset($_GET['user_type']))
	{
	$user_type = $_GET['user_type'];

	//select from user database using id
	$sql="SELECT * FROM student WHERE user_type=$student";
	$result = mysqli_query($con, $sql);
	
	while($row = mysqli_fetch_array($result)){
		extract($row) or die(mysqli_error($con));
	//extracting from student table
	$id= $row['id'];
	 $name= $row['name'];
	 $user_type= $row['user_type'];
	}
	//inserting into trash after selecting before deleting to save user 
	$query= "INSERT INTO trash (id, name, surname, user_type) VALUES('$id', '$name', '$surname', '$user_type')";
			  
	$query2=mysqli_query($con,$query) or die(mysqli_error($con));
		
		if($query2)
		{
		//deleting from student using id
			$sql = "DELETE FROM student 
						WHERE user_type = $student And id = $id";	
			$result = mysqli_query($con, $sql) or die(mysqli_error($con));
	
		if(mysqli_affected_rows($con)>0)
			{
		
					echo "<script>
		alert('success');
		window.location.href='studentDetails.php';
		</script>";
		 
			}//end if
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
			<form method="post" name="formUserReg" id="formUserReg" action="editstudent.php">
			<p>&nbsp;</p>
            <table>
	
   
	<?php
	//select from user
	$sql = "SELECT *
	FROM student 
	WHERE user_type = 'student' AND status = 'approved'";
			
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result)>0){
		
	
	echo '<thead>
		<tr>
            <th> Student Name  </th>
            <th> Student Surname  </th>
            <th> Student ID  </th>
            <th> Gender  </th>
			<th> Email  </th>
			<th> Details  </th>
		</tr>
	</thead>';
	while($row = mysqli_fetch_assoc($result)) 
			{
		
				extract($row);
			
	?>
	<tbody>
   <!--extracting student details-->
      <td>&nbsp;<?php echo ucwords($name); ?></td>
      <td>&nbsp;<?php echo ucwords($surname); ?></td>
	  <td>&nbsp;<?php echo ucwords($id); ?></td>
      <td>&nbsp;<?php echo ucwords($gender); ?></td>
      <td align="center"><?php echo ucwords($email); ?></td>
      
      <td  align="center"><a href="editstudent.php?id='<?php echo $email?>'">Edit</a> / <a href="studentDetails.php?id='<?php echo $id?>'"onclick="return confirm('Are you sure?')">Delete</a> 
	  
    </td>
	</tbody>
    <?php
			}//end while 
			}//end if
	else
	{
		echo "  Sorry no records found ";
		}		// end else
	?>
    
  </table>
  </form></td>
  </tr>
  </table></td></tr>
  </table>
  </body>
  </html>

