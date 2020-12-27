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
	<link href="css/theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
	<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<link href="css/jHTree.css" rel="stylesheet">
	<script src="js/jQuery.jHTree.js"></script>

	<script type="text/javascript">
		var mlist = {
			getNetwork: function() {
				$.when(
					$.ajax({
					type: 'GET',
					url: '/api/network/json/0?type=introducer&stage=5',
					beforeSend:function(xhr, settings){
						xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
					}
					})
				).done( ( datas ) => {
					$("#tree").jHTree({
						callType: 'obj',
						structureObj: datas,
						nodeDropComplete:function (event, data) {
							// alert("Node ID: " + data.nodeId + " Parent Node ID: " + data.parentNodeId);
						}
					});
				}).fail( ( datas ) => {
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

<div class="container my-4 py-3">
	<div class="container pt-5 my-5 z-depth-1">
		<section class="p-md-3 mx-md-5">
			<div class="row d-flex justify-content-center">
				<div class="col-md-6 text-center teal-text">
					<h2 class="font-weight-bold pb-4">Networks</h2>
					<i class="fas fa-network-wired fa-6x mb-2"></i>
				</div>
			</div>
		</section>
		<div class="col-lg-12 col-md-6 mb-4">
			<div class="media white z-depth-1 rounded">
				<i class="fas fa-users fa-lg blue z-depth-1 p-4 rounded-left text-white mr-3"></i>
        <form class="dan" id="dan">
          <select id="type" name="type">
          <option value="introducer">introducer</option>
          <option value="position">position</option>
          </select>
          <select id="stage" name="stage">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          </select>
          <input type="button" id="button" value="更新">
        </form>
			</div>
		</div>
	  <div id="tree"></div>
	</div>
	<div class="container z-depth-1">
		<section class="p-md-3 mx-md-5">
			<div class="row d-flex justify-content-center">
				<div class="col-md-6 text-center teal-text">
					<h2 class="font-weight-bold pb-4">My Referrals</h2>
					<i class="fas fa-handshake fa-6x mb-2"></i>
				</div>
			</div>
		</section>
		<table class="table">
		  <thead class="grey lighten-2">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Date</th>
			  <th scope="col">UserName</th>
			  <th scope="col">Package</th>
			  <th scope="col">Level</th>
			  <th scope="col">Position</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
				<td colspan="6">Loading...</td>
			</tr>
		  </tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
window.onload=function () {
	$("header").load("/navi",function () {
		$('#nav-item-network').addClass('active');
	});
};

$(function(){
	$('#button').click(function(){
    var param = fromAssociativeArray($("#dan").serializeArray());

    data = 'type='+param['type']+'&stage='+param['stage'];

    $.when(
      $.ajax({
        type: 'GET',
        url: '/api/network/json/0?'+data,
        beforeSend:function(xhr, settings){
          xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
        }
        })
      ).done( ( datas ) => {
        $("#tree").html("");
        $('.zmrcntr').remove()
        $("#tree").jHTree({
          callType: 'obj',
          structureObj: datas,
          nodeDropComplete:function (event, data) {
            // alert("Node ID: " + data.nodeId + " Parent Node ID: " + data.parentNodeId);
          }
        });
    }).fail( ( datas ) => {
      alert("取得失敗");
    });
	});
});
// var myData = [{
// 	"head":"UserName",
// 	"id":"aa",
// 	"contents":"My User",
// 	"children": [
// 		{
// 			"head":"User101",
// 			"id":"a1",
// 			"contents":"Package-A",
// 			"children": [
// 				{"head":"User111","id":"a11","contents":"Package-A" },
// 				{"head":"User112","id":"a12","contents":"Package-A" }
// 			]
// 		},
// 		{
// 			"head":"User201",
// 			"id":"a2",
// 			"contents":"Package-A",
// 			"children": [
// 				{"head":"User211","id":"a11","contents":"Package-A" },
// 				{"head":"User212","id":"a12","contents":"Package-A" }
// 			]
// 		}
// 	]
// }];

</script>

</body>
</html>