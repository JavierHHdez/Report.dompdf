<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<style type="text/css">
		
		.loginForm { width: 400px; border: 1px solid #666; padding: 20px; margin: auto; margin-top: 10%; }
		
		.loginForm .loginFooter { margin-top: 20px; }

		.error {background-color: #d85d5d; color: #FFF; height: 30px; padding: 5px; border-radius: 5px;}

	</style>
</head>
<body>

	<div class="container" style="margin-top: 30px;">
		<div class="error">
			<span>Datos de Ingreso no válidos, inténtalo de nuevo por favor...</span>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="loginForm">
					<form action="" id="FormLogin">
						<h3 style="text-align: center;margin-bottom: 10%;">Login</h3>
						<input type="hidden" id="key" name="key" value="Login">
						<input type="text" id="username" name="username" class="form-control" placeholder="Username"><br>
						<input type="password" id="password" name="password" class="form-control" placeholder="Password">

					<div class="loginFooter">
						<input type="submit" id="btnLogin" style="width: 100%" class="btn btn-primary" value="Iniciar Sesion">
					</div>

					</form>
				</div>
			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){

		$('.error').hide();

		$('#FormLogin').on('submit', function(event){
			event.preventDefault();

			$.ajax({
				url : '../model/operations.php',
				method : 'POST',
				dataType : 'json',
				data : $(this).serialize(),
				beforeSend : function(){
					$('#btnLogin').val('Validando...');
				}
			}).done(function(response){
				
				if(response.error == false){
					location.href = "index.php";
				}else {
					$('.error').slideDown('slow');
					setTimeout(function(){
						$('.error').slideUp('slow');
						$('#btnLogin').val('Iniciar Sesion');
					}, 3000);
				}

			}).fail(function(response){
				console.log(response.responseText);
			}).always(function(){
				console.log('complete...');
			});
		});
	});

</script>
</body>
</html>