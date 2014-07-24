<?php
session_start();
?>
<?php

 require_once 'config.php';

 if(!empty($_POST['name'])){
     $name=$_POST['name'];
     $password=md5($_POST['password']);
     $_SESSION['name'] = $username;
	 $_SESSION['password'] = $password;
	 $_SESSION['category'] = $_POST['category'];
     $res=mysql_query("select count(user_name) as count from users where user_name = '$name' and password = '$password' ") or die(mysql_error()); 
     $count=mysql_fetch_array($res);
     if($count[0]==0){
         header("Location:index.php");
     }else{
         header("Location:question.php");
     }
 }
?>