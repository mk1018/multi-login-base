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
			<form class="text-center border border-light p-5" id="enter_form" action="#!">
				<p class="h4 mb-4">Registration [Step 1]</p>
				<input type="email" id="email" name="email" class="form-control mb-4" placeholder="E-mail">
				<input type="email" id="email-confirm" name="email-confirm" class="form-control mb-4" placeholder="E-mail(Confirm)">
				<input type="hidden" id="qr_token" name="qr_token" value="<?php echo $_GET['qr_token']; ?>">
				<input type="hidden" id="pr_token" name="pr_token" value="<?php echo $_GET['pr_token']; ?>">
				<button type="button" class="btn btn-info btn-block my-4" id="send">Send E-Mail</button>
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
	$('#send').click(function(){
		var param = fromAssociativeArray($("#enter_form").serializeArray());
		if (param["email"] == "" || param["email-confirm"] == "") {
			alert("メールアドレスを入力してください");
		} else {
			if (param['email'] == param['email-confirm']) {
				console.log(param);
				sendMail(param);
			} else {
				alert('入力したメールアドレスに違いがあります。');
			}
		}
	});
});

function sendMail(param_array) {
	$.ajax({
		type: 'post',
		url: '/api/verify_mail_send',
		dataType: 'json',
		async: false,
		data: JSON.stringify(param_array),
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		success: function(res){
			alert("メールを送信しました");
		},
		error: function(res){
			alert("送信に失敗しました");
		}
	});
}
</script>
</body>
</html>

