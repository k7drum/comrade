<!--controling session-->
<?php
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_type']) 
{
    header("location: createTask.php");
} elseif ($_SESSION['user_type'] != 'advisor') 
{

    echo "<script>
alert('you are not a Administrator');
window.location.href='login.php';
</script>";
}

require_once "dbconnect.php";
require_once "functions.php";

if (isset($_POST['attendance']))
		{
            $name= $_POST["name"];
			$user_id = (int)$_SESSION['id'];
            
           
		//SELECTING FROM User TABLE CHECKING IF USERNAME EXIST
        $sql = "SELECT * FROM student
				WHERE user_type = 'student' AND status='approved'";

			$result = mysqli_query($con, $sql);
			$sql = mysqli_fetch_row($result);


			if ( (count($result) > 0 )) 
		{
			$sql = ("UPDATE student SET attendance = attendance + 1 WHERE user_type = 'student' and id = '".$_POST['name']."'");
			echo "<script>alert('user_type');</script>";
		
			if (mysqli_query($con, $sql))
			{
				echo "New Attendance Mark Successfully";
			} else 
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
		
		} 
		else 
		{
			$sql = "INSERT INTO  student ('user_type' ,'attendance')VALUES ('$user_type',  '1');";
			echo "<script>alert('uploaded');</script>";
		
			if (mysqli_query($con, $sql)) 
			{
				echo "Mark successfully";
			} 
			else 
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
		}

    }


?>


<html> 
<head> 

<style type="text/css">
.heading{
	width: 30%;
    margin: 30px auto;
    margin-top:5px;
	text-align: center;
	color: 	#FFFFFF;
	background: #85144b;
	border: 1px solid #121ED4;
    border-radius: 20px;
    
}
form {
	width: 50%; 
    margin: 30px auto; 
	border-radius: 10px; 
	padding: 10px;
	background: #85144b;
    border: 1px solid #121ED4;

}
form p {
	color: red;
	margin: 0px;

}
.task_input {
    width: 90%;
    margin-bottom:30px;
	height: 30px; 
	padding: 5px;
	border: 2px solid #121ED4;
}
.add_btn {
	height: 39px;
	background: #85144b;
	color: 	#FFFFFF;
	border: 2px solid #121ED4;
	border-radius: 5px; 
	padding: 5px;
    font-size:18px;
}

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
	  <li><a href="evaluate.php">Evaluation</a></li>
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
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
  

  <tr> 
	<td class="contentArea"> 
		<form method="post" name="formUserReg" id="formUserReg" action="attend.php">

   </form>

    <table>
	<thead>
		<tr>
			<th>S/No</th>
			<th>ID</th>
            <th>Name</th>
			<th>Surname</th>
			<th>Course</th>
			<th>Attendance</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>


	<?php
        $query= "SELECT * from staff where user_type='advisor' and status='approved'";
		 $results= mysqli_query($con, $query);
         while($name = mysqli_fetch_array($results, MYSQLI_ASSOC))
		{
		 echo '<option value = "'.$name['id'].'">'.$name['name'].'</option>';
		}											
		?>

			
													 
		?>
			<tr>
				<td> <?php echo $i; ?> </td>
                <td class="id"> <?php echo $row['id']; ?> </td>
				<td class="name"> <?php echo $row['name']; ?> </td>
				<td class="surname"> <?php echo $row['surname']; ?> </td>
				<td class="course_code"> <?php echo $row['course_code']; ?> </td>
				<td class="attendance">
				<input type="checkbox" name="attendance[]" id="attendance" value=" "></td>


			</tr>
		<?php $i++;  ?>	
	</tbody>

	<tr>
	 <td>&nbsp;</td>
	<td>&nbsp;</td>
	<p align="right"><td><input name="btnsubmit" type="submit" id="btnsubmit" value=" Submit  "></td>
	</tr>
</table>


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