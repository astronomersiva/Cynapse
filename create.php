<?php
session_start();
?>
<?php 
require 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cynapse'14</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/style.css" rel="stylesheet" media="screen">
		<style>
			.container {
				margin-top: 65px;
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
				Welcome <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
			</p>
		</header>
		<div class="container question">
				<form class="form-signin" id="signin" method="post" action="insertion.php">
								<?php if (isset($_SESSION['errors'])): ?> 
    							<div> 
        						<?php foreach($_SESSION['errors'] as $error): ?> 
            						<p><?php echo $error ?></p> 
        						<?php endforeach; ?> 
    							</div> 
								<?php endif; ?>
								<?php
								if(empty($_SESSION['name'])){
								echo "<input type='text' name='username' class='form-control' placeholder='Enter your username'/><span class='help-block'></span><input type='password' name='pass' class='form-control' placeholder='Enter your password'/><span class='help-block'></span><input type='text' name='test' class='form-control' placeholder='Test name'/><span class='help-block'></span>";
								}	
								?>
								
								<input type="text" name='question_name' class="form-control" placeholder="Question"/><span class='help-block'></span>
								<input type="text" name='answer1' class="form-control" placeholder="Option A"/><span class='help-block'></span>
								<input type="text" name='answer2' class="form-control" placeholder="Option B"/><span class='help-block'></span>
								<input type="text" name='answer3' class="form-control" placeholder="Option C"/><span class='help-block'></span>
								<input type="text" name='answer4' class="form-control" placeholder="Option D"/><span class='help-block'></span>
								<input type="text" name='answer' class="form-control" placeholder="Correct answer. Enter in numbers(eg. 1 if option A)"/><span class='help-block'></span>
								<button class="btn btn-success btn-block" type="submit">
								Submit
								</button><br>
								<?php
								if(!empty($_SESSION['name'])){ echo "<a href='stafflogout.php' class='btn btn-success btn-block'>Logout</a>";
								}
								?>
						</form>
			
		</div>
		
       <footer>
            <p class="text-center" id="foot">
                Designed by<a href="http://www.github.com/astronomersiva"> Siva</a>
            </p>
        </footer>
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
						question_name : {
							required : true,
						},
						test : {
							required : true,
						},
						answer : {
							required : true,
						},
						answer1 : {
							required : true,
						},
						answer2 : {
							required : true,
						},
						answer3 : {
							required : true,
						},
						answer4 : {
							required : true,
						},
						username : {
							required : true,
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
                            required : "Please choose the required quiz."
                        },
                        question_name : {
							required : "This field is required",
						},
						test : {
							required : "This field is required",
						},
						answer : {
							required : "This field is required",
						},
						answer1 : {
							required : "This field is required",
						},
						answer2 : {
							required : "This field is required",
						},
						answer3 : {
							required : "This field is required",
						},
						answer4 : {
							required : "This field is required",
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
