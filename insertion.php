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
if(empty($_SESSION['name'])){
	$username = $_POST['username'];
	$password = md5($_POST['pass']);
	}
else{
	$username = $_SESSION['name'];
	$password = $_SESSION['password'];
	}

$sql1 = "SELECT * FROM authusers WHERE user_name = '$username' and password = '$password' ";
$result = mysql_query($sql1) or die(mysql_error());
$numrows = mysql_num_rows($result);
if($numrows > 0)
   {
    $question_name=addslashes($_POST['question_name']);
	$answer1=addslashes($_POST['answer1']);
	$answer2=addslashes($_POST['answer2']);
	$answer3=addslashes($_POST['answer3']);
	$answer4=addslashes($_POST['answer4']);
	$answer=addslashes($_POST['answer']);
	if (isset($_SESSION['table'])){
		$tableName = $_SESSION['table'];
	}
	else{
		$tableName=addslashes($_POST['test']);
		$_SESSION['table'] = $tableName;
	}
	$tsql= "CREATE TABLE IF NOT EXISTS `$tableName` (`id` int(11) NOT NULL AUTO_INCREMENT,`question_name` text NOT NULL,
 				 `answer1` varchar(250) NOT NULL,
 				 `answer2` varchar(250) NOT NULL,
 				 `answer3` varchar(250) NOT NULL,
 				 `answer4` varchar(250) NOT NULL,
 				 `answer` varchar(250) NOT NULL,
 				 PRIMARY KEY (`id`)
				)";
	mysql_query($tsql);
	$sql = "INSERT INTO `$tableName` (`question_name`, `answer1`, `answer2`, `answer3`, `answer4`, `answer`) VALUES ('$question_name','$answer1','$answer2','$answer3','$answer4','$answer')";
	$retval = mysql_query($sql,$conn);
	if(! $retval )
		{
  		die('Could not enter data: ' . mysql_error());
	}
	$_SESSION['errors'] = array("<font color='green'> Question inserted.</font>"); 
	$_SESSION['name'] = $username;
	$_SESSION['password'] = $password;
	header("Location:create.php");
   }
else
   {
 	$_SESSION['errors'] = array("<font color='red'> Your username or password was incorrect.</font>"); 
	header("Location:create.php");
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
