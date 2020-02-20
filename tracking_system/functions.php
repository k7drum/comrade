<?php
require_once 'dbconnect.php';

function Login()
{
	session_start();
	// if we found an error save the error message in this variable
	$errorMessage = '';

	$userID = $_POST['txtUserID'];
	$password = $_POST['txtPassword'];
	
	
	// To protect MySQL injection for Security purpose
	$userID = stripslashes($userID);
	$password = stripslashes($password);
		
	// first, make sure the userID & password are not empty
	if ($userID == '') 
	{
		$errorMessage = 'You must enter your userID';
	} 
	else if ($password == '') 
	{
		$errorMessage = 'You must enter the password';
	} 

	else 
	{
		
		//check if user is student

		$sql = "SELECT  *
					FROM student
					WHERE id = '$userID' AND password = '$password' ";
		global $con;

		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) == 1) 
		{
			$row = mysqli_fetch_assoc($result);
			$uType = $row["user_type"];
			$status = $row["status"];
			$adv_status = $row["adv_status"];
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['name'].' '.$row['surname'];
		


			if ($status == 'pending') 
			{

				echo "<script type='text/javascript'> alert('Your registration is pending. Please try again later'); window.location.replace('logout.php'); </script>";

			} 
			else if ($status == 'rejected') {
				echo "<script type='text/javascript'> alert('Your registration is Rejected. Please Meet your Advisor'); window.location.replace('logout.php'); </script>";

			} 

			else if ($status == 'approved' && $adv_status == 'pending') 
			{

				echo "<script type='text/javascript'> alert('Your request is pending. Please try again later'); window.location.replace('index.php'); </script>";

			} 
			else if ($status == 'approved' && $adv_status == 'rejected') {
				echo "<script type='text/javascript'> alert('Your request is Rejected. Please choose another Advisor'); window.location.replace('index.php'); </script>";

			}  

			
			else 
			{
					//echo"<script type='text/javascript'> alert('Your registration is Rejected. Please Meet your Advisor'); </script>";			
				session_start();
				$_SESSION['id'] = $row['id'];
				$_SESSION['name'] = $row['name'].' '.$row['surname'];
				$_SESSION['user_type'] = $row['user_type'];
				header('Location: index.php');
			}
			
		} 
		else
		{
			$sql = " SELECT *
					FROM staff
					WHERE id = '$userID' and password = '$password' ";
			global $con;
			$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) == 1) 
			{
				$row = mysqli_fetch_assoc($result);
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['user_type'] = $row['user_type'];
				$uType = $row['user_type'];
				$role = $row["role"];

				if($uType == 'admin')
				{
					header('Location: adminIndex.php');
					//echo "<script type='text/javascript'>  window.location.replace('adminIndex.php'); </script>";
				}

				else if($uType == 'advisor' && $role == 'committee_member')
				{
					header('Location: com_memb_Index.php');
					//echo "<script type='text/javascript'> alert('Admin'); window.location.replace('com_memb_Index.php'); </script>";
				}

				else if($uType == 'advisor')
				{
					echo "<script type='text/javascript'> window.location.replace('advisorIndex.php'); </script>";
				}			
				
				
			}
			else 
			{
				echo "<script type='text/javascript'> alert('Invalid username or passowrd'); </script>";
			}
		}
	}
}
/*
	Register
 */



/*
	Logout a user
 */
function doLogout()
{
	session_unset();
	session_destroy();
	/*
	if (isset($_SESSION['user_id'])) {
		unset($_SESSION['user_id']);
		session_unregister('user_id');
	}
	if (isset($_SESSION['user_name'])) {
		unset($_SESSION['user_name']);
		session_unregister('user_name');
	}
	if (isset($_SESSION['user_type'])) {
		unset($_SESSION['user_type']);
		session_unregister('user_type');
	}*/
		
	header('Location: login.php');
	exit;
}


/*
	Generate combo box options containing the committee we have.
	if $committee_Id is set then that committee is selected
*/

	


function doChangePassword()
{
	// if we found an error save the error message in this variable
	$errorMessage = '';
	
	$userID = $_POST['txtUserID'];
	$email = $_POST['txtEmail'];
	$uType    = $_POST['utype'];
	// first, make sure the usernID & password are not empty
	if ($userID == '') {
		$errorMessage = 'You must enter your userID';
	} else if ($email == '') {
		$errorMessage = 'You must enter the Email';
	} else {
		
		//check if user is student
		if($uType == 'student')
		{
			$sql = " SELECT name, password
					FROM student
					WHERE id = '$userID' and email = '$email' ";
					global $con;
			$result = mysqli_query($con,$sql);
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				$npass = $row['password'];
				$errorMessage = " Your password is $npass . You can < a href = 'login.php' > Login Now < / a > . ";	
			}else {
				$errorMessage = " You are not a Valid Student . ";
			}
					
		}//if
		elseif($uType == 'staff')
		{
			$sql = " SELECT id, name, password
					FROM staff
					WHERE id = '$userID' and email = '$email' ";
					global $con;
			$result = mysqli_query($con,$sql);
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				$npass = $row['password'];
				$errorMessage = " Your password is $npass . You can < a href = 'login.php' > Login Now < / a > . ";
			}else {
				$errorMessage = " You are not a Valid Advisor . ";
			}		
		}
				
			elseif($uType == 'committee_member')
		{
			$sql = " SELECT id, name, password
					FROM staff
					id = '$userID' and email = '$email' ";
					global $con;
			$result = mysqli_query($con,$sql);
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				$npass = $row['password'];
				$errorMessage = " Your password is $npass . You can < a href = 'login.php' > Login Now < / a > . ";
			}else {
				$errorMessage = " You are not a Valid Committee Member . ";
			}		
		}
				
			
	}//else
	return $errorMessage;
}



?>