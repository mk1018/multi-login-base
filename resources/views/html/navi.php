<nav class="navbar fixed-top navbar-expand-lg navbar-dark black scrolling-navbar">
	<a class="navbar-brand" href="/home"><strong>MLM Project</strong></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			accesskey=""aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item" id="nav-item-home">
				<a class="nav-link" id="nav-link-home" href="/home">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item" id="nav-item-profile">
				<a class="nav-link" id="nav-link-profile" href="/profile">Profile</a>
			</li>
			<li class="nav-item" id="nav-item-wallet">
				<a class="nav-link" id="nav-link-wallet" href="/wallet">Wallet</a>
			</li>
			<li class="nav-item" id="nav-item-network">
				<a class="nav-link" id="nav-link-network" href="/network">Network</a>
			</li>
		</ul>
		<ul class="navbar-nav nav-flex-icons">
			<li class="nav-item">
				<a class="nav-link" href="/profile" id="user_name-link"><i class="fas fa-user"></i><span id="user_name"></span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="signout-link"><i class="fas fa-sign-out-alt"></i>Sign Out</a>
			</li>
		</ul>
	</div>
</nav>

<script type="text/javascript" src="js/authorize.js"></script>
<script  type="text/javascript">
$(function(){
	$('#signout-link').click(function(){
		logOut();
	});
});
</script>