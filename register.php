<?php
session_start();
?>
<?php 
require 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cynapse</title>		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/style.css" rel="stylesheet" media="screen">
		<style>
			.container {
				margin-top: 110px;
			}
			.error {
				color: #B94A48;
			}
			.form-horizontal {
				margin-bottom: 0px;
			}
			.hide{display: none;}
		</style>

	</head>
	<body>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db('quiz');

$username = $_POST['name'];
$password = md5($_POST['password']);

$sql1 = "INSERT into users(user_name,password) VALUES ('$username','$password')";
$result = mysql_query($sql1) or die(mysql_error());
if($result)
   {
   	$_SESSION['errors'] = array("<font color='green'>Registration successful. Click <a href='index.php'><font color='green'>here</font></a> to take a test</font>"); 
	$_SESSION['name'] = $username;
	$_SESSION['password'] = $password;
	header("Location:signup.php");
   }
mysql_close($conn);
?>

		 <footer>
            <p class="text-center" id="foot">
            	 Designed by<a href="http://www.github.com/astronomersiva"> Siva</a>
            </p>
        </footer>
	</body>
</html>
