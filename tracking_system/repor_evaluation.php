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
        $I = intval($_POST['I']);
        $J = intval($_POST['J']);
        $K = intval($_POST['I']);
        $L = intval($_POST['L']);
        $M = intval($_POST['M']);
        $N = intval($_POST['N']);

        $student_id = $_POST['student_id'];
        $semester_year = $_POST['semester_year'];

        $total = $A + $B + $C + $D + $E + $F + $G + $H + $I + $J + $K + $L + $M + $N ;

        $sql= "SELECT * from student";

        $result = mysqli_query($con, $sql);
        $sql = mysqli_fetch_row($result);

        


   $sql = "INSERT INTO report_evaluation (A, B, C, D, E, F, G, H, I, J, K, L, M, N, total, semester_year, student_id )
             VALUES('$A', '$B', '$C', '$D', '$E', '$F', '$G', '$H', '$I', '$J', '$K', '$L', '$M', '$N', '$total', '$semester_year', '$student_id')";
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
					<form method="post" name="formUserReg" id="formUserReg" action="UML_evaluation.php" enctype="multipart/form-data">
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
			






            <th colspan="4" align="right">Report Format</th>
            <tr><td colspan="4">Cover Page.</td></tr>
            <tr>
            <td> <input type="radio" name ="A" value = "4"     /></td>
            <td> <input type="radio" name ="A" value = "3"     /></td>
            <td> <input type="radio" name ="A" value = "2"     /></td>
            <td> <input type="radio" name ="A" value = "1"     /></td>    
            </tr>

        
            <tr><td colspan="4">Table of Contents.</td></tr>
            <tr>
            <td>  <input type="radio" name ="B" value = "4"     /></td>
            <td>  <input type="radio" name ="B" value = "3"     /></td>
            <td>  <input type="radio" name ="B" value = "2"     /></td>
            <td>  <input type="radio" name ="B" value = "1"     /></td>    
            </tr>       

            <tr> <td colspan="4">Font Type.</td></tr>
            <tr>
            <td> <input type="radio" name ="C" value = "4"     /></td>
            <td> <input type="radio" name ="C" value = "3"     /></td>
            <td> <input type="radio" name ="C" value = "2"     /></td>
            <td> <input type="radio" name ="C" value = "1"     /></td>    
            </tr>

            <tr><td colspan="4">Font Size.</td></tr>
            <tr>
            <td><input type="radio" name ="D" value = "4"     /></td>
            <td><input type="radio" name ="D" value = "3"     /></td>
            <td><input type="radio" name ="D" value = "2"     /></td>
            <td><input type="radio" name ="D" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Page Numbers.</td></tr>
            <tr>
            <td> <input type="radio" name ="E" value = "4"     /></td>
            <td> <input type="radio" name ="E" value = "3"     /></td>
            <td> <input type="radio" name ="E" value = "2"     /></td>
            <td> <input type="radio" name ="E" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Figure Numbers.</td></tr>
            <tr>
            <td> <input type="radio" name ="F" value = "4"     /></td>
            <td> <input type="radio" name ="F" value = "3"     /></td>
            <td> <input type="radio" name ="F" value = "2"     /></td>
            <td> <input type="radio" name ="F" value = "1"     /></td>    
            </tr>

            
            <tr> <td colspan="4">Overall Consistency/Aesthetics.</td></tr>
            <tr>
            <td> <input type="radio" name ="G" value = "4"     /></td>
            <td> <input type="radio" name ="G" value = "3"     /></td>
            <td> <input type="radio" name ="G" value = "2"     /></td>
            <td> <input type="radio" name ="G" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Writting and English Quality.</td></tr>
            <tr>
            <td> <input type="radio" name ="H" value = "4"     /></td>
            <td> <input type="radio" name ="H" value = "3"     /></td>
            <td> <input type="radio" name ="H" value = "2"     /></td>
            <td> <input type="radio" name ="H" value = "1"     /></td>    
            </tr>
            
            <th colspan="4" align="right">Report Content</th>
            <tr> <td colspan="4">Content and Details (Contain accurate information).</td></tr>
            <tr>
            <td> <input type="radio" name ="I" value = "4"     /></td>
            <td> <input type="radio" name ="I" value = "3"     /></td>
            <td> <input type="radio" name ="I" value = "2"     /></td>
            <td> <input type="radio" name ="I" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Organization(written in logical sequence).</td></tr>
            <tr>
            <td> <input type="radio" name ="J" value = "4"     /></td>
            <td> <input type="radio" name ="J" value = "3"     /></td>
            <td> <input type="radio" name ="J" value = "2"     /></td>
            <td> <input type="radio" name ="J" value = "1"     /></td>    
            </tr>

            
            <tr> <td colspan="4">References.</td></tr>
            <tr>
            <td> <input type="radio" name ="K" value = "4"     /></td>
            <td> <input type="radio" name ="K" value = "3"     /></td>
            <td> <input type="radio" name ="K" value = "2"     /></td>
            <td> <input type="radio" name ="K" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Project Management Plan.</td></tr>
            <tr>
            <td> <input type="radio" name ="L" value = "4"     /></td>
            <td> <input type="radio" name ="L" value = "3"     /></td>
            <td> <input type="radio" name ="L" value = "2"     /></td>
            <td> <input type="radio" name ="L" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">Gant Chart.</td></tr>
            <tr>
            <td> <input type="radio" name ="M" value = "4"     /></td>
            <td> <input type="radio" name ="M" value = "3"     /></td>
            <td> <input type="radio" name ="M" value = "2"     /></td>
            <td> <input type="radio" name ="M" value = "1"     /></td>    
            </tr>

            <tr> <td colspan="4">User Interface Sketches.</td></tr>
            <tr>
            <td> <input type="radio" name ="N" value = "4"     /></td>
            <td> <input type="radio" name ="N" value = "3"     /></td>
            <td> <input type="radio" name ="N" value = "2"     /></td>
            <td> <input type="radio" name ="N" value = "1"     /></td>    
            </tr>

            
            <tr>
            <td colspan="4">
                <input type="submit" name="Btnsubmit" id="Btnsubmit" value="Btnsubmit" style="width: 70px">
                               
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