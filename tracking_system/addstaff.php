<?php
//DATABASE STARTS HERE
session_start();

// Check if the user is already logged in, if yes then redirect him to Advisor Page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: advisorIndex.php");
    exit;
}


require_once 'dbconnect.php';

	// if we found an error save the error message in this variable
	$errorMessage = '';
	$success=' ';

	//FETCHING DATA FROM ENTRY
	if (isset($_POST['btnRegister']))
		{
            $name = $_POST['name'];
            $surname = $_POST['surname'];
			$id = $_POST['id'];
			$password = $_POST['password'];
            $password2 = $_POST['password2'];
            $gender= $_POST['gender'];
            $semester= $_POST['semester'];
            $role= $_POST['role'];
			$user_type= $_POST['user_type'];
			$email = $_POST['email'];

	        // first, make sure the username & password are not empty
	if ($name == '') {
        $errorMessage = 'You must enter your first name';
    } else if ($surname == '') {
		$errorMessage = 'You must enter the student surname';
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
        $sql = "SELECT * FROM staff
							WHERE id = '$id' ";

        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 1) {
            $errorMessage = 'Username already taken. Choose another one';
        } else {	
									//INSERTING INTO DATABASE User
            $sql = "INSERT INTO staff(name, surname, id, password, gender, semester, role, user_type, email, date_time)
						      VALUES ('$name','$surname', '$id', '$password', '$gender', '$semester', '$role', '$user_type', '$email', NOW())";
            $run = mysqli_query($con, $sql) or die(mysqli_error($con));

            if (mysqli_affected_rows($con) == 1) {
                $errorMessage = "A new staff has been created.";

            } else {

                $errorMessage = 'sorry';
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

    <li><a href="adminIndex.php">Home</a></li>
	  <li><a href="adminmanual.php">HELP</a></li>
	  <li><a href="mail.php">Email</a></li>
	  <li><a href="#">Evaluation Report</a></li>
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
    <a href="adminIndex.php">Home</a>
	<a href="adminmanual.php">HELP</a>
	<a href="mail.php">Email</a></li>
	<a href="#">Evaluation Report</a>
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
						<tr> 
							<td class="contentArea"> 
								<form method="post" name="formUserReg" id="formUserReg" action="addstaff.php">
								<p>&nbsp;</p>
									<table width="600" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#121ED4" class="entryTable">
										<tr id="entryTableHeader"> 
										</tr>
										<tr> 
											 <td class="contentArea"> 
											 <div class="errorMessage" align="center"><?php echo $errorMessage; ?></DIV>
											 <div class="errorMessage" align="center"><?php echo $success; ?></DIV>
		 

											  <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
											  <h2>Registration</h2>
											  
																					
												   <tr class="entryTable">
													 <td class="label">&nbsp;Name</td>
													 <td class="content"><input name="name" type="text" class="box" id="name" size="30" maxlength="20"></td>
												   </tr>
                                                   <tr class="entryTable">
													 <td class="label">&nbsp;Surname</td>
													 <td class="content"><input name="surname" type="text" class="box" id="surname" size="30" maxlength="20"></td>
												   </tr>
												   <tr class="entryTable">
													 <td class="label">&nbsp;Student ID</td>
													 <td class="content"><input name="id" type="text" class="box" id="id" size="30" maxlength="20"></td>
												   </tr>
												   <tr class="entryTable">
													 <td class="label">&nbsp;Password</td>
													 <td class="content"><input name="password" type="password" class="box" id="password" value="" size="30" maxlength="20" /></td>
												   </tr>
												   <tr class="entryTable">
													 <td class="label">&nbsp;Retype_Password</td>
													 <td class="content"><input name="password2" type="password" class="box" id="password2" value="" size="30" maxlength="20" /></td>
												   </tr>

												   <tr class="entryTable">
												    <td class="label">&nbsp;User Type</td>
												    <td class="content">
													<select name="user_type">
                                                    <option value=""> </option>
													<option value="advisor">Advisor</option>
													</select>
												    </td>
											       </tr>

                                                   <tr class="entryTable">
												    <td class="label">&nbsp;Role</td>
												    <td class="content">
													<select name="role">
                                                    <option value="None">None </option>
													<option value="committee_member">committee_member</option>
													</select>
												    </td>
											       </tr>

                                                    <tr class="entryTable">
												    <td class="label">&nbsp;Gender</td>
												    <td class="content">
													<select name="gender">
                                                    <option value=""> </option>
													<option value="male">Male</option>
													<option value="female">Female</option>
                                                    <option value="other">Other</option>
													</select>
												    </td>
											       </tr>


                                                   <tr class="entryTable">
												    <td class="label">&nbsp;Semester</td>
												    <td class="content">
													<select name="semester">
                                                    <option value=""> </option>
													<option value="spring">2018/19 Spring</option>
													<option value="fall">2018/19 Fall</option>
                                                    
													</select>
												    </td>
											       </tr>

													   <tr class="entryTable">
														 <td class="label"> &nbsp;E-mail</td>
														<td class="content"><input name="email" type="text" class="box" id="email" value="" size="30" maxlength="60"></td>
													   </tr>

													   <tr>
														 <td width="200">&nbsp;</td>
														 <td width="372">&nbsp;</td>
													   </tr>
													   <tr> 
														<td>&nbsp;</td>
														<td><input name="btnRegister" type="submit" id="btnRegister" value=" Add Staff " ></td>
													   </tr>
												</table>
											</td>
										</tr>
									</table>
									<p>&nbsp;</p>
								</form>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<p>&nbsp;</p>
</body>
</html>
