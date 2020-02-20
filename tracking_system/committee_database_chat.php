<?php
session_start();
if (!isset($_SESSION['id'])) 
{
    header("location: login.php");
} elseif ($_SESSION['user_type'] != "advisor") 
{
    echo "<script>
alert('you are not a student');
window.location.href='login.php';
</script>";
} else 
{
    $user_id = $_SESSION['id'];
}

require_once 'dbconnect.php';
require_once 'functions.php';

if (isset($_POST['send']))
{
            
            //This is the directory where images will be saved
$target = "Database/";
$target = $target . basename( $_FILES['uploaded_file']['name']);

//This gets all the other information from the form
$uploaded_file=basename( $_FILES['uploaded_file']['name']);
$message = $_POST['message']; 

$sql = "SELECT * FROM database_chat";

//Writes the Filename to the server
if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $target)) {
    //Tells you if its all ok
    echo "The file ". basename( $_FILES['uploaded_file']['name']). " has been uploaded, and your information has been added to the directory";

    //Writes the information to the database
    $sql="INSERT INTO database_chat(uploaded_file, message, date_time,advisor_id)
          VALUES ('$uploaded_file', '$message', NOW(), '$user_id')";
    $run = mysqli_query($con, $sql) or die(mysqli_error($con));
} else {
    //Gives and error if its not
    echo "Sorry, there was a problem uploading your file.";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    width: 80%;
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
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
  

  <tr> 
	<td class="contentArea"> 
    <form method="post" name="formUserReg" id="formUserReg" action="committee_database_chat.php" enctype="multipart/form-data" >
    <?php if (isset($errors)) 
        { 
        ?>
	    <p><?php echo $errors; ?></p>
        <?php 
        } 
        ?>

									

					<div class="heading">
		            <h2 style="font-style: 'Hervetica'; ">Report</h2>
                    </div>
                    
                    <textarea rows="5" cols="50" name="message" class="testarea" id="folder">
                    Comment...</textarea>

                    <tr class="entryTable">
					<td width="100" align="right">Upload File </td>
					<td width="10" align="center">:</td>
					<td><label>
					<input type="file" name="uploaded_file" id="uploaded_file" accept="pdf, doc, docx"">
					</label></td>
					</tr>

                    <button type="submit" name="send" id="send" class="add_btn">Upload</button>


									
	</td>
	</tr>
	</table>
	</form>

    <table>
	<thead>
		<tr>
           
			<th>Chat ID</th>
            <th>Student ID</th>
			<th>Advisor ID</th>
            <th>Message</th>
            <th>Date/Time</th>
            <th>Download File</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all chats if page is visited or refreshed
		$message = mysqli_query($con, "SELECT * FROM database_chat WHERE advisor_id=$user_id");

		 while ($row = mysqli_fetch_array($message)) { ?>
			<tr>
				
                <td class="chat_id"> <?php echo $row['chat_id']; ?> </td>
                <td class="student_id"> <?php echo $row['student_id']; ?> </td>
                <td class="adv_id"> <?php echo $row['advisor_id']; ?> </td>
                <td class="message"> <?php echo $row['message']; ?> </td>
				<td class="date_time"> <?php echo $row['date_time']; ?> </td>
                <td><a href="download.php?name=<?php echo $row['uploaded_file'];?>"> download </a></td>
				</td>
			</tr>
		<?php } ?>	
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