<!DOCTYPE html>
<html>
<head>
	<title>MLM Project</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mdb.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/mdb.min.js"></script>
	<script type="text/javascript" src="js/authorize.js"></script>
	<script type="text/javascript">
		var mlist = {
			getProfile: function() {
				$.when(
					$.ajax({
					type: 'GET',
					url: '/api/user/0',
					beforeSend:function(xhr, settings){
						xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
					}
					})
				).done( ( data ) => {
					for (var key in data) {
						$("#"+key).val(data[key]);
					}
				}).fail( ( data ) => {
					alert("取得失敗");
				});
			},
			visibility: function() {
				$('.container').css('visibility', 'visible');
			}
		}
		tokenRefreshOnMethod(mlist);
	</script>
	<style type="text/css">
		.container{
			visibility:hidden;
		}
	</style>
</head>
<body>

<header>
</header>

<div class="container my-5 py-5">
	<div class="container pt-5 my-5 z-depth-1">
<form class="profile p-md-3">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6 text-center text-info">
        <h2 class="font-weight-bold pb-4">My Profile</h2>
        <i class="fas fa-user fa-6x mb-2"></i>
		<p class="grey-text pt-4"> </p>
      </div>
    </div>

	<label for="name">Name</label>
    <input type="text" id="name_first" name="name_first" class="form-control" placeholder="First name">
    <input type="text" id="name_last"  name="name_last"  class="form-control mb-4" placeholder="Last name">

	<label for="accountName">Account Name</label>
    <input type="text" id="account_name" name="account_name" class="form-control mb-4" placeholder="Account name">

	<label for="address">Address</label>
    <input type="text" id="address_1" name="address_1" class="form-control" placeholder="">
    <input type="text" id="address_2" name="address_2" class="form-control" placeholder="">
    <input type="text" id="address_3" name="address_3" class="form-control mb-4" placeholder="">

	<label for="email">Email</label>
    <input type="email" id="email" name="email" class="form-control mb-4" placeholder="" readonly>

	<label for="phone">Mobile Number</label>
    <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="" aria-describedby="defaultRegisterFormPhoneHelpBlock">
    <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">Optional - for two step authentication</small>

	<!-- <label for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" autocomplete="off">
    <input type="password" id="password_confirm" name="" class="form-control" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" autocomplete="off">
    <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">Minimal 8 characters lenght</small> -->

    <!-- <button class="btn btn-info my-4 btn-block" type="submit">Save Profile</button> -->
	<div id="alert"></div>
	<a class="btn btn-info btn-block my-4" id="submit">Save Profile</a>

</form>

</div>
</div>

<script type="text/javascript">
window.onload=function () {
	$("header").load("/navi",function () {
		$('#nav-item-profile').addClass('active');
	});
};

$(function(){
	$('#submit').click(function(){
		var param = $(".profile").serializeArray();
		param = fromAssociativeArray(param);
		submit(param);
	});
});

function submit(param){
	$.ajax({
		type: 'PATCH',
		url: '/api/user/0',
		dataType: 'json',
		async: false,
		data: JSON.stringify(param),
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		beforeSend:function(xhr, settings){
			xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
		},
		success: function(res){
			alert("更新しました");
			$('#alert').html('');
		},
		error: function(jqXHR, textStatus,) {
			switch (jqXHR.status) {
				case 422:
					errorMSG = '更新失敗';
					html = '';
					for (var key in jqXHR.responseJSON.errors) {
						for (var i in jqXHR.responseJSON.errors[key]) {
							errorMSG = errorMSG + '\n' + key + ' : ' + jqXHR.responseJSON.errors[key][i];
							html = html + '<p class="text-danger">' + key + ' : ' + jqXHR.responseJSON.errors[key][i] + '</p>';
						}
					}
					alert(errorMSG);
					$('#alert').html(html);
					break;
				default:
					alert("更新失敗");
			}
		},
	});
}
</script>

</body>
</html>