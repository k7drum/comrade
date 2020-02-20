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
alert('you are not an Administrator');
window.location.href='login.php';
</script>";
}
else 
{
	$id=$_SESSION['id'];
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
	$sql="SELECT * FROM report_evaluation WHERE student_id=$id";
	$result = mysqli_query($con, $sql);
	
    while($row = mysqli_fetch_array($result))
    {
		extract($row) or die(mysqli_error($con));
    }

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
		<tr> 
		<td class="contentArea"> 
			<form method="post" name="formUserReg" id="formUserReg" action="evaluation_Report.php">
			<p>&nbsp;</p>
            <table>
	
   
	<?php
	//select from user
	$sql = "SELECT *
	FROM report_evaluation";
			
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result)>0){
		
	
    echo '<thead>
        <th colspan="4" align="right">Sum of Student Report Evaluation</th>
        <tr>
        
        <th>Student ID</th>
        <th>Total</th>
        <th>Semester Year</th>
		</tr>
	</thead>';
	while($row = mysqli_fetch_assoc($result)) 
			{
		
				extract($row);
			
	?>
	<tbody>
   <!--extracting student details-->
      
      <td>&nbsp;<?php echo ucwords($student_id); ?></td>
	  <td>&nbsp;<?php echo ucwords($total); ?></td>
      <td>&nbsp;<?php echo ucwords($semester_year); ?></td>
 
	  
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


<?php
	//select from user
	$sql = "SELECT *
	FROM database_evaluation";
			
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result)>0){
		
	
    echo '<thead>
        <th colspan="4" align="right">Sum of Student Database Evaluation</th>
        <tr>
        
        <th>Student ID</th>
        <th>Total</th>
        <th>Semester Year</th>
		</tr>
	</thead>';
	while($row = mysqli_fetch_assoc($result)) 
			{
		
				extract($row);
			
	?>
	<tbody>
   <!--extracting student details-->
      
      <td>&nbsp;<?php echo ucwords($student_id); ?></td>
	  <td>&nbsp;<?php echo ucwords($total); ?></td>
      <td>&nbsp;<?php echo ucwords($semester_year); ?></td>
 
	  
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


<?php
	//select from user
	$sql = "SELECT *
	FROM  uml_evaluation";
			
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result)>0){
		
	
    echo '<thead>
        <th colspan="4" align="right">Sum of Student UML Evaluation</th>
        <tr>
       
        <th>Student ID</th>
        <th>Total</th>
        <th>Semester Year</th>
		</tr>
	</thead>';
	while($row = mysqli_fetch_assoc($result)) 
			{
		
				extract($row);
			
	?>
	<tbody>
   <!--extracting student details-->
      
      <td>&nbsp;<?php echo ucwords($student_id); ?></td>
	  <td>&nbsp;<?php echo ucwords($total); ?></td>
      <td>&nbsp;<?php echo ucwords($semester_year); ?></td>
 
	  
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

