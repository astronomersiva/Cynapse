<?php
session_start();
?>

<?php 
require 'config.php';
if(!empty($_SESSION['name'])){

    $right_answer=0;
    $wrong_answer=0;
    $unanswered=0; 

   $keys=array_keys($_POST);
   $order=join(",",$keys);
   $category=$_SESSION['category'];
   $response=mysql_query("select id,answer from `$category` where id IN($order) ORDER BY FIELD(id,$order)")   or die(mysql_error());

   while($result=mysql_fetch_array($response)){
       if($result['answer']==$_POST[$result['id']]){
               $right_answer++;
           }else if($_POST[$result['id']]==5){
               $unanswered++;
           }
           else{
               $wrong_answer++;
           }
   }
   $name=$_SESSION['name'];  
   mysql_query("update users set score='$right_answer' where user_name='$name' and category_id='$category'");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cynapse</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <header>
            <p class="text-center">
                Welcome <?php 
                if(!empty($_SESSION['name'])){
                    echo $_SESSION['name'];
                }?>

            </p>
        </header>
        <div class="container result">
            <div class="row">      
           </div>  
             
           <div class="row"> 
                  <div class="col-xs-18 col-sm-9 col-lg-9"> 
                    <div class='result-logo1'>
                            <img src="img/thankyou.jpg" class="img-responsive"/>
                    </div>
                  </div>

                  <div class="col-xs-6 col-sm-3 col-lg-3"> 
                     <a href="<?php echo BASE_PATH;?>" class='btn btn-success'>Start new test!</a>                   
                     <a href="<?php echo BASE_PATH.'logout.php';?>" class='btn btn-success'>Logout</a>

                       <div style="margin-top: 30%">
                        <p>Score : <span class="answer"><?php echo $right_answer;?></span></p>                
                       </div> 

                   </div>

            </div>    
        </div>
        <footer>
            <p class="text-center" id="foot">
                Designed by<a href="http://www.github.com/astronomersiva"> Siva</a>
            </p>
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php }else{

 header( 'Location: http://localhost/index.php' ) ;

}?>