<?php
session_start();

if(!isset($_SESSION['user_id']))
{
      header("location: login.php");
}
elseif($_SESSION['user_type']!="student")
{
	echo "<script>
alert('you are not a Student');
window.location.href='login.php';
</script>";
}

require_once 'dbconnect.php';
require_once 'functions.php';
//if valid or invalid 
    $errorMessage = '';
	$success=' ';
//when you clicked on submit	
if(isset($_POST['btnLogin']))
{
$user_id = (int)$_SESSION['id'];
$std_name = $_SESSION['name'];
//$tcode=$_POST["type"];
$upload_type=$_POST["type"];
$name=$_FILES["upload"]["name"];
$date_time=date("Y/m/d");

$sql= "SELECT * from student WHERE id='$upload_type'";
$result=mysqli_query($con, $sql) or die('sorry');
    if(mysqli_num_rows($result)>0)
    {
		while($i=mysqli_fetch_array($result))
		{
			$upload_name=$i['name'];
		}
    

        // $sql= "SELECT * from task WHERE task_id='$tcode'";
        // $result=mysqli_query($con, $sql) or die('sorry');
		// if(mysqli_num_rows($result)>0)
		// {
		// 	while($i=mysqli_fetch_array($result))
		// 		{	
		// 			$code=$i['task'];
        //         }//while
                
        $sql = "INSERT INTO project_upload(id, std_name, name, type, date_time)
                VALUES ('$user_id', '$std_name', '$name', '$upload_type', NOW())";
                
		        $result = mysqli_query($con,$sql);
                if(mysqli_affected_rows($con)==1)
                {




 if ($_POST['type'] == 'none' || empty($_POST['type']))
    {
    $type = './'; // default folder
    }
    else
    {
    $name = $_POST['type'] ;
    }


    $PATH = $name;
    $uploadpath = "PATH/ ";      
    $max_size = 2000;          
    $alwidth = 900;            
    $alheight = 800;           
    $allowtype = array('pdf', 'docx', 'jpg', 'jpe', 'png');        
    
    if(isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1)
    {
      $uploadpath = $uploadpath . basename( $_FILES['upload']['name']);       
      $sepext = explode('.', strtolower($_FILES['upload']['name']));
      $type = end($sepext);       
      list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);     
      $err = '';        
    
      
      if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['upload']['name']. '</b> not has the allowed extension type.';
      if($_FILES['upload']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
      if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;
    
      
      if($err == '')
       {
        if(move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) 
        { 
          echo 'File: <b>'. basename( $_FILES['upload']['name']). '</b> uploaded successfully:';
          echo '<br/>File type: <b>'. $_FILES['upload']['type'] .'</b>';
          echo '<br />Size: <b>'. number_format($_FILES['upload']['size']/1024, 3, '.', '') .'</b> KB';
          if(isset($width) && isset($height)) echo '<br/>file Width x Height: '. $width. ' x '. $height;
          echo '<br/><br/>File address: <b>http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$uploadpath.'</b>';
        }
        else echo '<b>Unable to upload the file.</b>';
      }
      else echo $err;
    }
                }
    }
    
}
?>

<html>
<head>
<title>File Upload</title>
<link rel="stylesheet" type="text/css" href="style_login.css">
<link rel="stylesheet" href="style1.css">
<link rel="icon" type="image/png" href="transparentBg.png" />   
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
    <li><a href="index.php">Home</a></li>
    <li><a href="#">Features</a>
    <ul>
        <li><a href="viewStd.php">Manage Account</a></li>
        <li><a href="manageproject.php">Manage Project</a></li> 
    </ul></li>
    <li><a href="usermanual.php">HELP</a></li>
    <li><a href="logout.php">Logout</a></li>     

    <?php if($_SESSION['name'] != null){
	$nm = $_SESSION['name'];
	echo"<li style = 'float:right'><a href='#'>Welcome $nm</a></li>";}?>
    </ul>
    </ul>
  </nav>

  <div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    <a href="index.php">Home</a>
    <a href="#">Features</a>
    <a href="viewStd.php">Manage Account</a>
    <a href="manageproject.php">Manage Project</a> 
    <a href="usermanual.php">HELP</a>
    <a href="logout.php">Logout</a>
  </div>


  <div id="main">
					<tr> 
						<td class="contentArea"> 
							<form method="post" name="formUserReg" id="formUserReg" action="upload.php" enctype="multipart/form-data">
								<p>&nbsp;</p>
								<table width="700" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
									<tr id="entryTableHeader"> 
										<td><p align="center">Project Selection Form</p> </td>
										<tr> 
											 <td class="contentArea"> 
											 
											  <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
											   <tr align="center"> 
												<td colspan="2"><div align="right">             
												
												</div></td>
												</tr>

												
                                                	<tr class="entryTable">
													   
													   <td width="100" align="right">Upload Type</td>
														<td width="10" align="right">:</td>
														 <td><label>
														
                                                         <select name="type" class="box" onchange="getId(this.value);">
														  
                                                          <option value="" selected="selected">  </option>
                                                              <?php
                                                              
                                                              $query= "SELECT * FROM task where course_code='itec403'";
                                                              $results= mysqli_query($con, $query);
                                                       
                                                              while($task=mysqli_fetch_assoc($results))
                                                                  {
                                                              ?>
                                                              <option value="<?php echo $task['task']; ?>"><?php echo $task['task']; ?></option>
																<?php 
																	}//while
																?>
                                                       
                                                          
                                                  <tr class="entryTable">
                                                      <td width="100" align="right">Project File </td>
                                                      <td width="10" align="center">:</td>
                                                      <td><label>
                                                        <input type="file" name="upload" accept="application/pdf">
                                                        </label></td>
                                                 </tr>

                                                 <?php
                                                    $dirs = glob("*", GLOB_ONLYDIR);
                                                    foreach($dirs as $val){
                                                    echo '<option value="'.$val.'">'.$val."</option>\n";
                                                    }
                                                    ?>
                                                 <tr>
                                                     <td>&nbsp;</td>
                                                     <td>&nbsp;</td>
                                                     
                                                     <p align="right"><td><input name="btnLogin" type="submit" id="btnLogin" value=" Submit  "></td>
                                                      <td><input type="reset" value="Cancel"> </td></p>
                                                   </tr>
                                              </table>
                                          </td>
                                      </tr>
                                  </tr>
                              </table>
                          </form>
                          </td></tr>
                          </td></tr>
                      </table>
                  </table>
              </body>
</html>