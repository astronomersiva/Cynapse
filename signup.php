<?php
session_destroy();
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
				Welcome 
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
						<form class="form-signin" method="post" id='signin' name="signin" action="register.php">
							<div class="form-group">
								<input type="text" id='name' name='name' class="form-control" placeholder="Enter your Name"/>
								<span class="help-block"><?php if (isset($_SESSION['errors'])): ?> 
        						<?php foreach($_SESSION['errors'] as $error): ?> 
            						<p><?php echo $error ?></p> 
        						<?php endforeach; ?> 
        						<?php session_destroy();?>
								<?php endif; ?></span>
							</div>
							<div class="form-group">
								<input type="password" id='password' name='password' class="form-control" placeholder="Enter your password"/>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<input type="password" id='confirmpassword' name='confirmpassword' class="form-control" placeholder="Enter the password again."/>
								<span class="help-block"></span>
							</div>
							<br>
							<button class="btn btn-success btn-block" type="submit">
								Sign Up
							</button>
                        </form>
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
								url : "check_reg.php",
								type : "post",
								data : {
									username : function() {
										return $("#name").val();
									}
								}
							}
						},
						password:{
							required: true,
							minlength : 8
						},
						confirmpassword:{
							required: true,
							minlength : 8,
							equalTo : "#password"
						}
					},
					messages : {
						name : {
							required : "Please enter your name",
							remote : "Invalid username/Username already exists"
						},
						password:{
							required : "Please enter a password",
						},
						confirmpassword : {
							equalTo : "Please enter the same password as above.",
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