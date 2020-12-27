<!DOCTYPE html>
<html>
<head>
	<title>MLM Project</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mdb.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/authorize.js"></script>
</head>
<body>

<header>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark black scrolling-navbar">
		<a class="navbar-brand" href="/home"><strong>MLM Project</strong></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				accesskey=""aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		</div>
	</nav>
</header>

<div class="container">
	<div class="row justify-content-md-center" style="margin-top:100px">
		<div class="col-sm-7">
			<form class="border border-light p-5" id="register_form" action="#!">
				<p class="h4 mb-4">Registration [Step 2]</p>
				<p class="h5 text-center mb-4">Personal Profile</p>
				<label for="name">Name First</label>
				<input type="text" id="name_first" name="name_first" class="form-control mb-4" placeholder="name_first">
				<label for="name">Name Last</label>
				<input type="text" id="name_last" name="name_last" class="form-control mb-4" placeholder="name_last">
				<label for="email">E-mail Address</label>
				<input type="email" id="email" name="email" class="form-control mb-4" placeholder="E-mail" value="" readonly="">
				<label for="country">Country</label>
				<select class="browser-default custom-select mb-5" id="country" name="country_code">
					<!-- <option value="" disabled="" selected="">Choose your country</option>
					<option value="JPN">Japan</option>
					<option value="USA">United States</option>
					<option value="CHN">China</option> -->
				</select>
				<p class="h5 text-center mb-4">Account Detail</p>
				<label for="username">User Name</label>
				<input type="text" id="account_name" name="account_name" class="form-control mb-4" placeholder="User Name">
				<label for="referrer_id">Referrer Code</label>
				<input type="text" id="verify_token" name="verify_token" class="form-control mb-4" placeholder="Referrer Code" value="<?php echo $_GET['verify_token']; ?>" readonly="">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" class="form-control" placeholder="Password">
				<input type="password" id="password_confirm" class="form-control mb-4" placeholder="(Confirm)">

				<button type="button" class="btn btn-info btn-block my-4" id="registration">Registration</a>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>

<script  type="text/javascript">
window.onload=function () {
	getMail();
};

$(function(){
	$('#registration').click(function(){
		var param = fromAssociativeArray($("#register_form").serializeArray());
		sendRegister(param);
	});
});

function sendRegister(param_array){
	$.ajax({
		type: 'post',
		url: '/api/register',
		dataType: 'json',
		async: false,
		data: JSON.stringify(param_array),
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		success: function(res){
			alert("登録しました");
			window.location.href = '/login';
		},
		error: function(res){
			console.log(res);
			alert("登録に失敗しました。"+res['responseText']);
		}
	});
}

function getMail() {
	$.ajax({
		type: 'GET',
		url: '/api/register_email'+window.location.search,
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		success: function(res){
			$('#email').val(res.email);
			tag  = '<select class="browser-default custom-select mb-5" id="country" name="country_code">';
			tag += '<option value="" disabled="" selected="">Choose your country</option>';
			for (var key in res.countries) {
				tag += '<option value="'+res.countries[key]['code']+'">'+res.countries[key]['en']+'</option>';
			}
			$('#country').html(tag);
		},
		error: function(res){
			alert("メールアドレスの取得に失敗しました。再度メールアドレスの登録からやり直してください。");
			window.location.href = '/login';
		}
	});
}

</script>
</body>
</html>
