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

$errorMessage = '';
$success=' ';

if (isset($_POST['Btnsubmit']))
    {
        $A = $_POST['A'];
        $B = intval($_POST['B']);
        $C = intval($_POST['C']);
        $D = intval($_POST['D']);
        $E = intval($_POST['E']);
        $F = intval($_POST['F']);
        $G = intval($_POST['G']);
        $H = intval($_POST['H']);
       
        $student_id = $_POST['id'];
        $semester_year = $_POST['semester_year'];

        $total = $A + $B + $C + $D + $E + $F + $G + $H ;

        $sql= "SELECT * from student";

        $result = mysqli_query($con, $sql);
        $sql = mysqli_fetch_row($result);

        


   $sql = "INSERT INTO database_evaluation (A, B, C, D, E, F, G, H, total, semester_year, student_id )
             VALUES('$A', '$B', '$C', '$D', '$E', '$F', '$G', '$H', '$total', '$semester_year', '$student_id')";
    $run = mysqli_query($con, $sql) or die(mysqli_error($con));
 

 if (mysqli_affected_rows($con) == 1) 
    {
    $errorMessage = "A new staff has been created.";
    } 
    else
    {
    $errorMessage = 'sorry';
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
					<tr> 
					<td class="contentArea"> 
					<form method="post" name="formUserReg" id="formUserReg" action="Database_evaluation.php" enctype="multipart/form-data">
					    <p>&nbsp;</p>
							<tr> 
							<td class="contentArea"> 
                            <table width="100%" border="0" cellpadding="2" cellspacing="3" class="text">
							</div></td>

                 

        <tr><th colspan="4">School Evaluation</th></tr>
        
               
        <label class="form" id="13" for="13">Semester : </label>
        <select id="data_1" name="semester_year" style="width : 450px;" class="form-control" ><option>... </option>
        <option>Fall 2019</option>
        <option>Spring 2018</option>
        </select><br/><br/>


			<label  width="100" align="right">Student Id : </label>
		    
			<select name="id" class="box" style="width : 450px;" class="form-control" onchange="getId(this.value);">
														  
			<option value="" selected="selected">... </option>
		    <?php
			//selecting from user table
			$query= "SELECT * from student where user_type='student' AND adv_status='approved' AND status='approved'";
			$results= mysqli_query($con, $query);
                while($name = mysqli_fetch_array($results, MYSQLI_ASSOC))
					{
						echo '<option value = "'.$name['id'].'">'.$name['name'].'</option>';
					}											 
			?>
            </select>
            

            <th colspan="4">Numbered/Identified Requirement</th>
            <tr><td colspan="4">Completeness </td></tr>
            <tr>
            <td> <input type="radio" name ="A" value = "4"     /></td>
            <td> <input type="radio" name ="A" value = "3"     /></td>
            <td> <input type="radio" name ="A" value = "2"     /></td>
            <td> <input type="radio" name ="A" value = "1"     /></td>    
            </tr>

        
            <tr><td colspan="4">Correctness(+redundancy+consistency)</td></tr>
            <tr>
            <td>  <input type="radio" name ="B" value = "4"     /></td>
            <td>  <input type="radio" name ="B" value = "3"     /></td>
            <td>  <input type="radio" name ="B" value = "2"     /></td>
            <td>  <input type="radio" name ="B" value = "1"     /></td>    
            </tr>      
            
            
            <th colspan="4">ERD</th>
            <tr> <td colspan="4">Notation/Style</td></tr>
            <tr>
            <td> <input type="radio" name ="C" value = "4"     /></td>
            <td> <input type="radio" name ="C" value = "3"     /></td>
            <td> <input type="radio" name ="C" value = "2"     /></td>
            <td> <input type="radio" name ="C" value = "1"     /></td>    
            </tr>

            <tr><td colspan="4">Correctness Against Requirements</td></tr>
            <tr>
            <td><input type="radio" name ="rv4" value = "4"     /></td>
            <td><input type="radio" name ="rv4" value = "3"     /></td>
            <td><input type="radio" name ="rv4" value = "2"     /></td>
            <td><input type="radio" name ="rv4" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Extensibility/Flexibility</td></tr>
            <tr>
            <td> <input type="radio" name ="D" value = "4"     /></td>
            <td> <input type="radio" name ="D" value = "3"     /></td>
            <td> <input type="radio" name ="D" value = "2"     /></td>
            <td> <input type="radio" name ="D" value = "1"     /></td>    
            </tr>

            <th colspan="4">Relational Schema</th>
            <tr> <td colspan="4">Relations</td></tr>
            <tr>
            <td> <input type="radio" name ="E" value = "4"     /></td>
            <td> <input type="radio" name ="E" value = "3"     /></td>
            <td> <input type="radio" name ="E" value = "2"     /></td>
            <td> <input type="radio" name ="E" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Constraints</td></tr>
            <tr>
            <td> <input type="radio" name ="F" value = "4"     /></td>
            <td> <input type="radio" name ="F" value = "3"     /></td>
            <td> <input type="radio" name ="F" value = "2"     /></td>
            <td> <input type="radio" name ="F" value = "1"     /></td>    
            </tr>

            <th colspan="4">Security</th>
            <tr> <td colspan="4">Users/Roles</td></tr>
            <tr>
            <td> <input type="radio" name ="G" value = "4"     /></td>
            <td> <input type="radio" name ="G" value = "3"     /></td>
            <td> <input type="radio" name ="G" value = "2"     /></td>
            <td> <input type="radio" name ="G" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Priviledge of Users/Roles</td></tr>
            <tr>
            <td> <input type="radio" name ="H" value = "4"     /></td>
            <td> <input type="radio" name ="H" value = "3"     /></td>
            <td> <input type="radio" name ="H" value = "2"     /></td>
            <td> <input type="radio" name ="H" value = "1"     /></td>    
            </tr>

            
            <tr>
            <td colspan="4">
                <input type="submit" name="Btnsubmit" id="Btnsubmit" value="Submit" style="width: 70px">
                               
            </td>
        </tr>
    </table>

</form>
</td></tr>
	 

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