<!DOCTYPE html>
<html>
<head>
	<title>MLM Project</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mdb.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<div class="row justify-content-md-center" style="margin-top:100px">
		<div class="col-sm-7">
			<form class="text-center border border-light p-5" id="login_form" action="#!">
				<p class="h4 mb-4">Sign in</p>
				<input type="email" id="defaultLoginFormEmail" name="email" class="form-control mb-4" placeholder="E-mail">
				<input type="password" id="defaultLoginFormPassword" name="password" class="form-control mb-4" placeholder="Password">
				<div class="d-flex justify-content-around">
					<div>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
							<label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
						</div>
					</div>
					<div>
						<a href="">Forgot password?</a>
					</div>
				</div>
				<a class="btn btn-info btn-block my-4" id="login">Sign in</a>
				<!--<p>Not a member?
					<a href="">Register</a>
				</p>-->
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript" src="js/authorize.js"></script>

<script  type="text/javascript">
$(function(){
	$('#login').click(function(){
		var param = $("#login_form").serializeArray();
		login(fromAssociativeArray(param));
	});
});
</script>

</body>
</html>

