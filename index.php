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

	</head>
	<body>
		<header>
			<p class="text-center">
				Welcome <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
			</p>
		</header>
		<div class="container">
			<div class="row">
				<div class="col-xs-14 col-sm-7 col-lg-7">
					<div class='image'>
						<img src="img/latest.png" class="img-resp"/>
					</div>
				</div>
				<div class="col-xs-10 col-sm-5 col-lg-5">
					<div class="intro">
						<?php if(empty($_SESSION['name'])){?>
						<form class="form-signin" method="post" id='signin' name="signin" action="question.php">
							<div class="form-group">
								<input type="text" id='name' name='name' class="form-control" placeholder="Enter your Name"/>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<input type="password" id='password' name='password' class="form-control" placeholder="Enter your password"/>
								<span class="help-block"><?php if (isset($_SESSION['errors'])): ?> 
        						<?php foreach($_SESSION['errors'] as $error): ?> 
            						<p><?php echo $error ?></p> 
        						<?php endforeach; ?> 
								<?php endif; ?></span>
							</div>
							<div class="form-group">
							    <select class="form-control" name="category" id="category">
							      <option value="">Choose your test</option>
							      <?php
							      $quiz = "SHOW TABLES WHERE Tables_in_quiz != 'users' and Tables_in_quiz != 'authusers'";
									$i=0;
									$quizList = mysql_query($quiz) or die(mysql_error());
									while($row = mysql_fetch_array($quizList)){
									echo "<option value='$row[Tables_in_quiz]'>$row[Tables_in_quiz]</option>";
									$i++;
									}
									?>                              
                                </select>
                                <span class="help-block"></span>
							</div>

							<br>
							<button class="btn btn-success btn-block" type="submit">
								Login
							</button>

						</form>
								<br>
							 <button class="btn btn-success btn-block" type="submit" onclick="window.location.href='signup.php'">
                               Signup 
                            </button>
						<?php }else{?>
						    <form class="form-signin" method="post" id='signin' name="signin" action="question.php">
                            <div class="form-group">
                                <select class="form-control" name="category" id="category">
                                  <option value="">Choose your test</option>
                                  <?php
							      $quiz = "SHOW TABLES WHERE Tables_in_quiz != 'users' and Tables_in_quiz !='authusers' ";
									$i=0;
									$quizList = mysql_query($quiz) or die(mysql_error());
									while($row = mysql_fetch_array($quizList)){
									echo "<option value='$row[Tables_in_quiz]'>$row[Tables_in_quiz]</option>";
									$i++;
									}
									?>                               
                                </select>
                                <span class="help-block"></span>
                            </div>
	
                            <br>
                            <button class="btn btn-success btn-block" type="submit">
                                Login
                            </button>
                            <br>
							 <button class="btn btn-success btn-block" type="submit"  onclick="window.location.href='signup.php'">>
                               Signup 
                            </button>
                            
                           
                       
                        </form>
						<?php }?>
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
		<script src="js/jquery.validate.min.js"></script>

		<script>
			$(document).ready(function() {
				$("#signin").validate({
					submitHandler : function() {
					    console.log(form.valid());
						if (form.valid()) {
						    alert("sf");
							return true;
						} else {
							return false;
						}

					},
					rules : {
						name : {
							required : true,
							minlength : 4,
							remote : {
								url : "check_name.php",
								type : "post",
								data : {
									username : function() {
										return $("#name").val();
									}
								}
							}
						},
						category:{
						    required : true
						},
						password:{
							required: true
						}
					},
					messages : {
						name : {
							required : "Please enter your name",
							remote : "Invalid user name"
						},
						category:{
                            required : "Please choose the required test."
                        }
					},
					errorPlacement : function(error, element) {
						$(element).closest('.form-group').find('.help-block').html(error.html());
					},
					highlight : function(element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					success : function(element, lab) {
						var messages = ""
						$(lab).closest('.form-group').find('.help-block').text(messages);
						$(lab).addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
					}
				});
			});
		</script>

	</body>
</html>