<?php
session_start();
?>
<?php 
require 'config.php';

if(!empty($_POST['name'])){
     $name=$_POST['name'];
     $password = md5($_POST['password']);
     $sql1 = "SELECT * FROM authusers WHERE user_name = '$name' and password = '$password' ";
      $result = mysql_query($sql1) or die(mysql_error());
      $numrows = mysql_num_rows($result);
      if($numrows > 0)
      {
	   $_SESSION['name']= $name;
       $_SESSION['id'] = mysql_insert_id();
     }
    else{
        $_SESSION['errors'] = array("<font color='red'> Your username or password was incorrect.</font>"); 
        header("Location:report.php");
    }
  }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cynapse</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/style.css" rel="stylesheet" media="screen">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   		<script src="js/jquery-1.10.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    	<script src="js/bootstrap.min.js"></script>
    	<script src="js/jquery.validate.min.js"></script>
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
	    <header>
            <p class="text-center">
                Welcome
            </p>
        </header>

		<div class="container question">
			
				<p>
					Top scorers
				</p>
				<hr>
				
					<?php 
					$test = $_POST['category'];
					$res = mysql_query("select user_name, score from users where category_id='$test' order by score DESC") or die(mysql_error());
					$i=1;
                while($result=mysql_fetch_array($res)){?>
                    
                    
                    <?php {?>         
                    <div id='question<?php echo $i;?>' class='cont'>
                    <p class='questions' id="qname<?php echo $i;?>"> <?php echo $i?>.<?php echo $result['user_name'];?>&nbsp&nbsp<?php echo $result['score'];?></p>
                
                    </div>     
                      
                     <?php } $i++;} ?>
					<a href="<?php echo BASE_PATH.'markslogout.php';?>" class='btn btn-success'>Logout</a>
				
		</div>
       <footer>
            <p class="text-center" id="foot">
                Designed by<a href="http://www.github.com/astronomersiva"> Siva</a>
            </p>
        </footer>
	</body>
</html>
