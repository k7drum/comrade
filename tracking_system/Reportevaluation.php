<?php
session_start();
if (!isset($_SESSION['id'])) 
{
    header("location: login.php");
} elseif ($_SESSION['user_type'] != "student") 
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

error_reporting(E_ALL);
ini_set('display_errors', 1);


?>



<html><head>
<title>Report Evaluation</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="https://cdn.jotfor.ms/static/formCss.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jotfor.ms/css/styles/baby_blue.css?3.3.8238" />
<link type="text/css" media="print" rel="stylesheet" href="https://cdn.jotfor.ms/css/printForm.css?3.3.8238" />

<style type="text/css">
    .form-label-left{
        width:350px;
    }
    .form-line{
        padding-top:12px;
        padding-bottom:12px;
    }
    .form-label-right{
        width:350px;
    }
    body, html{
        margin:0;
        padding:0;
        background:rgb(215, 233, 243);
    }

    .form-all{
        margin:0px auto;
        padding-top:0px;
        width:800px;
        color:#26269E !important;
        font-family:'Comic Sans MS';
        font-size:13px;
    }
    .form-radio-item label, .form-checkbox-item label, .form-grading-label, .form-header{
        color: #26269E;
    }

</style>

<style type="text/css" id="form-designer-style">
    /* Injected CSS Code */
/*PREFERENCES STYLE*/
    .form-all {
      font-family: Comic Sans MS, sans-serif;
    }
    .form-all .qq-upload-button,
    .form-all .form-submit-button,
    .form-all .form-submit-reset,
    .form-all .form-submit-print {
      font-family: Comic Sans MS, sans-serif;
    }
    .form-all .form-pagebreak-back-container,
    .form-all .form-pagebreak-next-container {
      font-family: Comic Sans MS, sans-serif;
    }
    .form-header-group {
      font-family: Comic Sans MS, sans-serif;
    }
    .form-label {
      font-family: Comic Sans MS, sans-serif;
    }
  
    .form-label.form-label-auto {
      
    display: inline-block;
    float: left;
    text-align: left;
  
    }
  
    .form-line {
      margin-top: 12px;
      margin-bottom: 12px;
    }
  
    .form-all {
      width: 800px;
    }
  
    .form-label-left,
    .form-label-right,
    .form-label-left.form-label-auto,
    .form-label-right.form-label-auto {
      width: 350px;
    }
  
    .form-all {
      font-size: 13px
    }
    .form-all .qq-upload-button,
    .form-all .qq-upload-button,
    .form-all .form-submit-button,
    .form-all .form-submit-reset,
    .form-all .form-submit-print {
      font-size: 13px
    }
    .form-all .form-pagebreak-back-container,
    .form-all .form-pagebreak-next-container {
      font-size: 13px
    }
  
    .supernova .form-all, .form-all {
      background-color: rgb(215, 233, 243);
      border: 1px solid transparent;
    }
  
    .form-all {
      color: #26269E;
    }
    .form-header-group .form-header {
      color: #26269E;
    }
    .form-header-group .form-subHeader {
      color: #26269E;
    }
    .form-label-top,
    .form-label-left,
    .form-label-right,
    .form-html,
    .form-checkbox-item label,
    .form-radio-item label {
      color: #26269E;
    }
    .form-sub-label {
      color: #4040b8;
    }
  
    .supernova {
      background-color: undefined;
    }
    .supernova body {
      background: transparent;
    }
  
    .form-textbox,
    .form-textarea,
    .form-radio-other-input,
    .form-checkbox-other-input,
    .form-captcha input,
    .form-spinner input {
      background-color: undefined;
    }
  
    .supernova {
      background-image: none;
    }
    #stage {
      background-image: none;
    }
  
    .form-all {
      background-image: none;
    }
  
  .ie-8 .form-all:before { display: none; }
  .ie-8 {
    margin-top: auto;
    margin-top: initial;
  }
  </style>


</head>
<body>
<link href="admin.css" rel="stylesheet" type="text/css">
<link href="nav.css" rel="stylesheet" type="text/css">
</head>
	<body>

		<br/><br/>
			<table width="900" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
				<tr> 
					<td><img src="images/header.png" width="900" height="120"></td>
				</tr>
				<tr> 
					<td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="20" align="center">
							<tr>
								<div>
									 <ul id="menu">
										<li><a href="adminIndex.php">Home</a></li>
										<li><a href="adminmanual.php">HELP</a></li>
										<li><a href="mail.php">Email</a></li>
										<li><a href="evaluate.php">Evaluation</a></li>
                    <li><a href="attendance.php">Attendance</a></li>
										<li><a href="logout.php">Logout</a></li>

										<?php if($_SESSION['name'] != null){
                $nm = $_SESSION['name'];
                echo"<li style = 'float:right'><a href='#'> $nm</a></li>";}?>
                  </ul>
									</ul>
								</div>
							</tr>
						<tr> 
							<td class="contentArea"> 
								<form method="post" name="formUserReg" id="formUserReg" action="Reportevaluation.php">
								   <p>&nbsp;</p>
								   <table width="600" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
										<tr id="entryTableHeader"> 
										</tr>


  <input type="hidden" name="formID" value="83042702563956" />
  <div class="form-all">
    <ul class="form-section page-section">
      <li id="5" class="form-input-wide" data-type="control_head">
        <div class="form-header-group ">
          <div class="header-text httal htvam">
            <h2 id="5" class="form-header" data-component="header">

		       EVALUATION fORM
            </h2>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_fullname" id="4">
        <label class="form-label form-label-left form-label-auto" id="4" for="4"> Full Name </label>
        <div id="4" class="form-input">
          <div data-wrapper-react="true">
            <span class="form-sub-label-container" style="vertical-align:top">
              <input type="text" id="first_4" name="q4_fullName4[first]" class="form-textbox" size="10" value="" data-component="first" />
              <label class="form-sub-label" for="4" id="sublabel_first" style="min-height:13px"> First Name </label>
            </span>
            <span class="form-sub-label-container" style="vertical-align:top">
              <input type="text" id="4" name="q4_fullName4[last]" class="form-textbox" size="15" value="" data-component="last" />
              <label class="form-sub-label" for="4" id="sublabel_last" style="min-height:13px"> Last Name </label>
            </span>
          </div>
        </div>
      </li>
    </div>
    </ul>

      <li class="form-line" data-type="control_scale" id="13">
        <label class="form-label form-label-left form-label-auto" id="13" for="13">Cover Page. </label>
        <div id="13" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="13"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="page" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="page" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="page" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="page" value="4" title="4" id="4" />
                </td>
                <td>
                  <label for="13"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="28">
        <label class="form-label form-label-left form-label-auto" id="28" for="28"> Table of Contents. </label>
        <div id="28" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                <th>

                </th>
              </tr>
              <tr>
                <td>
                  <label for="28"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="table" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="table" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="table" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="table" value="4" title="4" id="4" />
                </td>
               
                <td>
                  <label for="28"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="18">
        <label class="form-label form-label-left form-label-auto" id="18" for="18"> Font Type. </label>
        <div id="18" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
               
              </tr>
              <tr>
                <td>
                  <label for="18"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="font" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="font" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="font" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="font" value="4" title="4" id="4" />
                </td>
               
                <td>
                  <label for="18"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="16">
        <label class="form-label form-label-left form-label-auto" id="16" for="16"> Font Size. </label>
        <div id="16" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="16"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="size" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="size" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="size" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="size" value="4" title="4" id="4" />
                </td>
                
                <td>
                  <label for="16"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="15">
        <label class="form-label form-label-left form-label-auto" id="15" for="15"> Page Numbers. </label>
        <div id="15" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
              
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="15"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="pageNO" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="pageNO" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="pageNO" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="pageNO" value="4" title="4" id="4" />
                </td>
                
                <td>
                  <label for="15"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="14">
        <label class="form-label form-label-left form-label-auto" id="14" for="14"> Figure Numbers. </label>
        <div id="14" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="14"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="figureNo" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="figureNo" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="figureNo" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="figureNo" value="4" title="4" id="4" />
                </td>
                
                <td>
                  <label for="14"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="19">
        <label class="form-label form-label-left form-label-auto" id="19" for="19"> Overall Consistency/Aesthetics. </label>
        <div id="19" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="19"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Aesthetics" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Aesthetics" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Aesthetics" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Aesthetics" value="4" title="4" id="4" />
                </td>
               
                <td>
                  <label for="19"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="29">
        <label class="form-label form-label-left form-label-auto" id="29" for="29"> Writting and English Quality. </label>
        <div id="29" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="29"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Quality" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Quality" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Quality" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Quality" value="4" title="4" id="4" />
                </td>
                
                <td>
                  <label for="29"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="23">
        <label class="form-label form-label-left form-label-auto" id="23" for="23"> Content and Details (Contain accurate information). </label>
        <div id="23" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="23"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Content" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Content" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Content" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Content" value="4" title="4" id="4" />
                </td>
                
                <td>
                  <label for="23"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="22">
        <label class="form-label form-label-left form-label-auto" id="22" for="22"> Organization(written in logical sequence). </label>
        <div id="22" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                
                <th 
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="22"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Organization" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Organization" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Organization" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Organization" value="4" title="4" id="4" />
                </td>
                <td>
                  <label for="22"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="21">
        <label class="form-label form-label-left form-label-auto" id="21" for="21"> References. </label>
        <div id="21" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="21"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="References" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="References" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="References" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="References" value="4" title="4" id="4" />
                </td>
                
                <td>
                  <label for="21"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="26">
        <label class="form-label form-label-left form-label-auto" id="26" for="26"> Project Management Plan. </label>
        <div id="26" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="26"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Project" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Project" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Project" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Project" value="4" title="4" id="4" />
                </td>
                
                <td>
                  <label for="26"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="25">
        <label class="form-label form-label-left form-label-auto" id="25" for="25"> Gant Chart. </label>
        <div id="25" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="25"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="GantChart" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="GantChart" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="GantChart" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="GantChart" value="4" title="4" id="4" />
                </td>
                
                <td>
                  <label for="25"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
      <li class="form-line" data-type="control_scale" id="27">
        <label class="form-label form-label-left form-label-auto" id="27" for="27"> User Interface Sketches. </label>
        <div id="27" class="form-input">
          <table summary="" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
            <tbody>
              <tr>
                <th>
                   
                </th>
                <th style="text-align:center">
                  <label for="1"> 1 </label>
                </th>
                <th style="text-align:center">
                  <label for="2"> 2 </label>
                </th>
                <th style="text-align:center">
                  <label for="3"> 3 </label>
                </th>
                <th style="text-align:center">
                  <label for="4"> 4 </label>
                </th>
                <th>
                   
                </th>
              </tr>
              <tr>
                <td>
                  <label for="27"> Bad </label>
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Interface" value="1" title="1" id="1" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Interface" value="2" title="2" id="2" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Interface" value="3" title="3" id="3" />
                </td>
                <td style="text-align:center">
                  <input type="radio" class="form-radio" name="Interface" value="4" title="4" id="4" />
                </td>
                <td>
                  <label for="27"> Good </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </li>
     
    
	<li class="form-line" data-type="control_button" id="2">
        <div id="2" class="form-input-wide">
          <div style="text-align:center" class="form-buttons-wrapper">
            <button id="2" type="submit" class="form-submit-button" data-component="button">
              SUBMIT
            </button>
          </div>
        </div>
      </li>


  </div>
  </div>
</form></body>
</html>