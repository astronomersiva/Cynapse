<?php
session_start();
?>
<?php 
require 'config.php';
$category='';
 if(!empty($_POST['name'])){
     $name=$_POST['name'];
     $category=$_POST['category'];
     $_SESSION['category'] = $category;
     $password = md5($_POST['password']);
     $sql1 = "SELECT * FROM users WHERE user_name = '$name' and password = '$password' ";
      $result = mysql_query($sql1) or die(mysql_error());
      $numrows = mysql_num_rows($result);
      if($numrows > 0)
      {
     mysql_query("INSERT INTO users (id, user_name,score,category_id)VALUES ('NULL','$name',0,'$category')") or die(mysql_error());
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysql_insert_id();
     }
    else{
        $_SESSION['errors'] = array("<font color='red'> Your password was incorrect.</font>"); 
        header("Location:index.php");
    }
  }
$category=$_POST['category'];
if(!empty($_SESSION['name'])){
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
    <script src="js/countdown.js"></script>
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
                Welcome : <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
            </p>
        </header>
        <div id='timer'>
            <script type="application/javascript">
            var myCountdownTest = new Countdown({
                                    time: 1200, 
                                    width:200, 
                                    height:80, 
                                    rangeHi:"minute"
                                    });
           </script>
            
        </div>
        
    <div class="container question">
      <div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
        <p>
          <?php 
          echo "$category";
          ?>
        </p>
        <hr>
        <form class="form-horizontal" role="form" id='login' method="post" action="result.php">
          <?php 
          $res = mysql_query("select * from `$category` ORDER BY RAND() LIMIT 20") or die(mysql_error());
                    $rows = mysql_num_rows($res);
          $i=1;
                while($result=mysql_fetch_array($res)){?>
                    
                    
                    <?php if($i==1){?>         
                    <div id='question<?php echo $i;?>' class='cont'>
                    <p class='questions' id="qname<?php echo $i;?>"> <?php echo $i?>.<?php echo $result['question_name'];?></p>
                    <input type="radio" value="1" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer1'];?>
                   <br/>
                    <input type="radio" value="2" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer2'];?>
                    <br/>
                    <input type="radio" value="3" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer3'];?>
                    <br/>
                    <input type="radio" value="4" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer4'];?>
                    <br/>
                    <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/>                                                                      
                    <br/>
                    <button id='<?php echo $i;?>' class='next btn btn-success' type='button'>Next</button>
                    </div>     
                      
                     <?php }elseif($i<1 || $i<$rows){?>
                     
                       <div id='question<?php echo $i;?>' class='cont'>
                    <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $result['question_name'];?></p>
                    <input type="radio" value="1" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer1'];?>
                    <br/>
                    <input type="radio" value="2" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer2'];?>
                    <br/>
                    <input type="radio" value="3" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer3'];?>
                    <br/>
                    <input type="radio" value="4" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer4'];?>
                    <br/>
                    <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/>                                                                      
                    <br/>
                    <button id='<?php echo $i;?>' class='previous btn btn-success' type='button'>Previous</button>                    
                    <button id='<?php echo $i;?>' class='next btn btn-success' type='button' >Next</button>
                    </div>
                       
                       
                       
                        
                        
                   <?php }elseif($i==$rows){?>
                    <div id='question<?php echo $i;?>' class='cont'>
                    <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $result['question_name'];?></p>
                    <input type="radio" value="1" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer1'];?>
                    <br/>
                    <input type="radio" value="2" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer2'];?>
                    <br/>
                    <input type="radio" value="3" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer3'];?>
                    <br/>
                    <input type="radio" value="4" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['answer4'];?>
                    <br/>
                    <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/>                                                                      
                    <br/>
                    
                    <button id='<?php echo $i;?>' class='previous btn btn-success' type='button'>Previous</button>                    
                    <button id='<?php echo $i;?>' class='next btn btn-success' type='submit'>Finish</button>
                    </div>
          <?php } $i++;} ?>
          
        </form>
      </div>
    </div>
       <footer>
            <p class="text-center" id="foot">
              Designed by<a href="http://www.github.com/astronomersiva"> Siva</a>
            </p>
        </footer>

    
    <script>
    $('.cont').addClass('hide');
    count=$('.questions').length;
     $('#question'+1).removeClass('hide');
     
     $(document).on('click','.next',function(){
         last=parseInt($(this).attr('id'));     
         nex=last+1;
         $('#question'+last).addClass('hide');
         
         $('#question'+nex).removeClass('hide');
     });
     
     $(document).on('click','.previous',function(){
             last=parseInt($(this).attr('id'));     
             pre=last-1;
             $('#question'+last).addClass('hide');
             
             $('#question'+pre).removeClass('hide');
         });
            
         setTimeout(function() {
             $("form").submit();
          }, 1200000);
    </script>
  </body>
</html>
<?php }else{
    
 header( 'Location: http://localhost/index.php' ) ;
      
}
?>