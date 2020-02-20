<!--controling session-->
<?php
require_once 'dbconnect.php';
//require_once 'functions.php';

$errorMessage = '&nbsp;';

if (isset($_POST['txtUserID'])) {
    $result = Login();

    if ($result != '') {
        $errorMessage = $result;
    }
}
$errorMessage = '';
$success = ' ';
?>


<html> 
<head> 
<style>
p {
  margin-left: 200px;
  margin-right: 150px;
}
h3 {
  margin-left: 200px;
  
}
</style>



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
      <li><a href="login.php">Login</a></li>

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
    
  </div>


  <div id="main">

    <center><h1>Welcome to Project Management Tracking</h1><br>
    <h2><font color="red">Announcement</font></h2></center>
<hr>
<B><h3><font color="blue">ITEC403</font></h3></B>
<p>This course is the first stage of the two-semester long graduation project (capstone project) of the IT program.</p>
<p>The students are required to form teams, find a project supervisor from the department and propose a real life</p>
<p>project to the graduation project committee. Each team should explore the needs and requirements of their project,</p> 
<p>carry out systems design and develop a prototype, if possible, of their project under the guidance of their 
    project supervisors.</p>
    <hr>

<B><h3><font color="green">ITEC404</font></h3></B>

<p>This course is the final phase of the two semester long graduation project of the IT program. The students are </p>
<p>required to implement their projects and present to a jury which is formed by the graduation project committee.</p> 
<p>The final submission includes functional software / hardware package, user and system reference manuals and a final</p> 
<p>report which includes all the details of the procedures, performance checks, and testing results.</p>
<hr>

<p><a href="#">*** 2018-2019 FALL SEMESTER PRESENTATION SCHEDULE ***</a></p>
<p>--> CHECK ANNOUNCEMENTS PAGE FOR FURTHER DETAILS!!</p>








<body>


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