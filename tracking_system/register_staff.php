<!--controling session-->
<?php
//DATABASE STARTS HERE
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}


require_once 'dbconnect.php';
$errorMessage = '';
	$success=' ';

    if(isset($_POST['btnRegister'])){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $surname=$_POST['surname'];
        $gender=$_POST['gender'];
        $email=$_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];


               // first, make sure the username & password are not empty
	if ($name == '') {
        $errorMessage = 'You must enter your name';
    } else if ($surname == '') {
		$errorMessage = 'You must enter your surname';
    } else if ($id == '') {
		$errorMessage = 'You must enter the student ID';     
	} else if ($password == '') {
		$errorMessage = 'You must enter the password';
	}else if ($email == '') {
		$errorMessage = 'You must enter the E-mail.';
	}
	else if ($password != $password2) {
        $errorMessage = "The two Passwords do not match";
    }
	else if (strlen($_POST["password"]) <= '4') {
        $errorMessage = "Your Password Must Contain At Least 4 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $errorMessage = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $errorMessage = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $errorMessage = "Your Password Must Contain At Least 1 Lowercase Letter!";
    } else{
					//SELECTING FROM User TABLE CHECKING IF USERNAME EXIST
					$sql = "SELECT name, surname
							FROM student
							WHERE name = '$name' and surname = '$surname'";
					
					$result = mysqli_query($con,$sql);
						if (mysqli_num_rows($result) == 1) 
							{
								$errorMessage = 'Username already taken. Choose another one';	
							} 
						else
							{

                     $sql = "INSERT INTO student(id, name, surname, gender, email, password, date_time) 
                           VALUES ( '$id', '$name', '$surname', '$gender','$email', '$password', NOW())";

         $run= mysqli_query($con,$sql) or die(mysqli_error($con));
				
         if(mysqli_affected_rows($con)==1)
             {
                 $errorMessage = "A new User has been created.";
             }
         else
             {
                 $errorMessage='sorry';
             }
     }//END ELSE 
}//else

}//END IF



?>

<html> 
<head> 
  <title>RegistrationForm</title>
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
      <li><a href="frontpage.php">Home</a></li>
      <li><a href="register.php">Register</a></li>
      <li><a href="#">Setting</a></li>

    </ul>
<form class="search-form">
     <input type="text" placeholder="Search">
     <button>Search</button> 
</form>

  </nav>

  <div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    <a href="frontpage.php">Home</a>
    <a href="register.php">Register</a>
    <a href="#">Setting</a>
  </div>


  <div id="main">

    <center><h1>Staff Registration Form</h1></center>

<body>
<form action="register.staff.php" method="post">
<table align="center">

<tr>
<td>Name:</td>
<td><input type="text" name="name" placeholder="enter your first name" id="name" size="20" maxlength="50"></td>
</tr>
<tr>
<td></td>
<td><input type="text" name="surname" placeholder="enter your surname" id="surname" size="20" maxlength="50"></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td>Student ID</td>
<td><input type="text" name="id" placeholder="enter your id" id="id" size="20" maxlength="50"></td>
</tr>
<tr>
<td>Gender</td>
 
 
<td><input type="radio" name="gender" value="Male" id="gender" >Male</td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="gender" value="female" id="gender">Female</td>
</tr>
<tr>
<td></td>
<td><input type="radio" name="gender" value="others" id="gender">others</td>
</tr>
<tr>
<td>course_code:</td>
<td><select name="course_code"><option value="itec403" size="20">  itec403  </option></select>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
 
<tr>
<td>email:</td>
<td><input type="email" name="email" placeholder="example@example.com" id="email" size="20" maxlength="50"></td>
 
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
 
<tr>
<td>password:</td>
<td><input type="password" name="password" value="admin" id="password" size="20" maxlength="50"></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
 
<tr>
<td>Retype password:</td>
<td><input type="password" name="password2" value="admin" id="password2" size="20" maxlength="50"></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
 
<tr>
<td></td>
<td><input type="submit" name="btnRegister" id="btnRegister" value="SignUp"></td>
</tr>
</table>
</form>

  </div>

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