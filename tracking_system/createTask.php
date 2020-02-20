<!--controling session-->
<?php
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_type']) {
    header("location: createTask.php");
} elseif ($_SESSION['user_type'] != 'admin') {

    echo "<script>
alert('you are not a Administrator');
window.location.href='login.php';
</script>";
}

require_once "dbconnect.php";
require_once "functions.php";

if (isset($_POST['btnRegister']))
		{
            $task = $_POST['task']; // This must match the "name" of your input
            $title = $_POST['title'];
            
           
		//SELECTING FROM User TABLE CHECKING IF USERNAME EXIST
        $sql = "SELECT * FROM task
				WHERE task = '$task' ";

        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 1) 
        {
            $errorMessage = 'Task already taken. Choose another one';
        } else 


        {	
			//INSERTING INTO DATABASE User
            $sql = "INSERT INTO task(task, title, date_created)
                    VALUES ('$task', '$title', NOW() )";
           


            $run = mysqli_query($con, $sql) or die(mysqli_error($con));

            if (mysqli_affected_rows($con) == 1) {

                $path = 'PATH' . '/' . $task;
                is_dir($path) or mkdir($path, 0777, true);
            

                    echo "<script>
                    alert('A new Milestone has been created');
                    window.location.href='createTask.php';
                    </script>";
                    }//if
                    else{
                        
                    echo "<script>
                    alert('error occured');
                    window.location.href='createTask.php';
                    </script>";
                     }//else
        }//END ELSE 
    }



if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($con, "DELETE FROM task WHERE task_id=".$id);
	header('location: createTask.php');
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
		<form method="post" name="formUserReg" id="formUserReg" action="createTask.php">

        <?php if (isset($errors)) 
        { 
        ?>
	    <p><?php echo $errors; ?></p>
        <?php 
        } 
        ?>

									

					<div class="heading">
		            <h2 style="font-style: 'Hervetica'; ">Create New Task</h2>
                    </div>
                    
                    Title: <input type="text" name="title" class="task_input">
                    <textarea rows="5" cols="50" name="task" class="testarea">
                    Enter task here...</textarea>
                    <button type="submit" name="btnRegister" id="btnRegister" class="add_btn">Add Task</button>

									
	</td>
	</tr>
	</table>
	</form>

    <table>
	<thead>
		<tr>
			<th>S/No</th>
			<th>Title</th>
            <th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all task if page is visited or refreshed
		$task = mysqli_query($con, "SELECT * FROM task");

		$i = 1; while ($row = mysqli_fetch_array($task)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
                <td class="title"> <?php echo $row['title']; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete"> 
					<a href="createTask.php?del_task=<?php echo $row['task_id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
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