<?php include("session_start.php"); ?>

<?php
if($_SESSION['student_id'] != 0)
{
	header('Location: student_main.php');    
	exit();
}
 
//echo '<br />START';
//exit;

//ob_start();
//echo 'isset = ' . isset($_POST['login']);
if(isset($_POST['login']) && isset($_POST['password']))
{
	//echo '<br />login = ' . $_POST['login'];
	//echo '<br />password = ' . $_POST['password'];

	include('db_connection.php');
  
	//$result = mysql_query("SELECT * FROM student HERE login =", $con);

	$sql = "SELECT * FROM student WHERE login='" . $_POST['login'] . "' AND password='" . $_POST['password'] . "';";
	//echo '<br />sql = ' . $sql;
	//exit;
	$result = mysql_query($sql);

	//if(!$result)
	//{
		//die('<br />Could not query DB: ' . mysql_error());
	//}

	$num_rows = mysql_num_rows($result);

	if($num_rows)
	{
		//echo '<br />login ok';
		//exit;

		$row = mysql_fetch_array($result);

		$_SESSION['student_id'] = $row['student_id'];
		$_SESSION['msg'] = 'You are login successfully.';

		//echo '<br />student_login = ' . $_SESSION['student_login'];
		//exit;

		header('Location: student_main.php');
		exit;
	} 
	else
	{
		//echo '<br />login not';
		//exit;

		$_SESSION['student_id'] = 0;
		$_SESSION['msg'] = 'Invalid Login/Password';
	} 
} 
?>

<?php include('top.php'); ?>

<?php include('student_submenu.php'); ?>

<div id="contenttext">

<div style="padding:10px">
<span class="titletext">Student Login</span> </div>

<div class="bodytext" style="padding:12px;" align="justify">
<strong>Student login here.</strong>
<form action="student_login.php" method="post">
	<div>Login: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="login" /></div>
	<div>Password: <input type="password" name="password" /></div>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	<input type="submit" value="Login" /><input type="reset" /></p>
</form>
</div>
</div>

<?php include('bottom.php'); ?>
