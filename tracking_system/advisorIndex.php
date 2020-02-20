<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
} elseif ($_SESSION['user_type'] != "advisor") {
    echo "<script>
alert('you are not a advisor');
window.location.href='login.php';
</script>";
} else {
    $user_id = $_SESSION['id'];
}
require_once 'dbconnect.php';
require_once 'functions.php';
?>


<html> 
<head> 

<style>
input.Button {
width: 300px;
padding: 20px;
cursor: pointer;
font-weight: bold;
font-size: 150%;
background: #121ED4;
color: #fff;
border: 1px solid #3366cc;
border-radius: 10px;
margin-top:30px;
}
input.Button:hover {
color: #ffff00;
background: #000;
border: 1px solid #fff;
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

    <li><a href="advisorindex.php">Home</a></li>
	  <li><a href="advisormanual.php">HELP</a></li>
	  <li><a href="student_mail.php">Email</a></li>
    
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
    <a href="advisorindex.php">Home</a>
	<a href="advisormanual.php">HELP</a>
	<a href="student_mail.php">Email</a></li>
    
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
 <tr> 
	<td class="contentArea"> 
		<form method="post" name="formUserReg" id="formUserReg" action="advisorindex.php" align="center">
		<h1 align='center'> ADVISORPAGE </h1>
                <input class="Button" type="button" value="Report Chat" onclick="window.location.href='advisor_report_chat.php'" /><br/>
                <input class="Button" type="button" value="UML Chat" onclick="window.location.href='advisor_UML_chat.php'" /><br/>
                <input class="Button" type="button" value="Database Chat" onclick="window.location.href='advisor_database_chat.php'" /><br/>
                
</form>

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