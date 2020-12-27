<!DOCTYPE html>
<html>
<head>
	<title>MLM Project</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mdb.min.css" rel="stylesheet">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous"> -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/mdb.min.js"></script>
	<script type="text/javascript" src="js/authorize.js"></script>
  <script type="text/javascript">
    var mlist = {
      setWallet: function () {
        $.when(
          $.ajax({
            type: 'GET',
            url: '/api/wallet/0',
            beforeSend:function(xhr, settings){
              xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
            }
          })
        ).done( ( data ) => {
          $('#wallet').html('$ ' + (parseInt(data['tradable']) + parseInt(data['deposit'])));
          $('#tradable').html('$ ' + parseInt(data['tradable']));
          $('#deposit').html('$ ' + parseInt(data['deposit']));
          $('#depositable_amount').val(parseInt(data['tradable']));
          $('#Withdrawal_limit').val(parseInt(data['tradable']));
        }).fail( ( data ) => {
          alert("取得失敗");
        });
      },
      setHistory: function() {
        $.when(
          $.ajax({
            type: 'GET',
            url: '/api/asset_history_user',
            beforeSend:function(xhr, settings){
              xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
            }
          })
        ).done( ( data ) => {
          // console.log(data);
        }).fail( ( data ) => {
          alert("取得失敗");
        });
      },
      setList: function() {
        $.when(
          $.ajax({
            type: 'GET',
            url: '/api/asset_history_user',
            beforeSend:function(xhr, settings){
              xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
            }
          })
        ).done( ( data ) => {
          createList(data);
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
  <section class="p-md-3 mx-md-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6 text-center deep-purple-text">
        <h2 class="font-weight-bold pb-4">My Wallet</h2>
        <i class="fas fa-wallet fa-6x mb-2"></i>
        <h3 class="grey-text pt-4"><a id="wallet">$ 0</a></h3>
		<div class="row">
			<div class="col">
				<button type="button" class="btn btn-block" data-toggle="modal" data-target="#withdrawaModal">Withdraw</button>
			</div>
			<div class="col">
				<button type="button" class="btn btn-block" data-toggle="modal" data-target="#depositModal">Deposit</button>
			</div>
		</div>
      </div>
    </div>
    <hr class="mx-5">
    <div class="row text-center">
      <div class="col-md-6 mb-5">
        <div class="mt-3">
          <h4 class="font-weight-bold mb-3">Tradable wallet</h4>
          <h5 class="ont-weight-bold grey-text mb-0">
          <a id="tradable">$ 0</a>
          </h5>
        </div>
      </div>
      <div class="col-md-6 mb-5">
        <div class="mt-3">
          <h4 class="font-weight-bold mb-3">Deposit Wallet</h4>
          <h5 class="ont-weight-bold grey-text mb-0">
          <a id="deposit">$ 0</a>
          </h5>
        </div>
      </div>
    </div>
  </section>

  <table class="table">
    <thead class="grey lighten-2">
      <tr>
        <th scope="col">Type</th>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Tradable</th>
        <th scope="col"></th>
        <th scope="col">Deposit</th>
        <th scope="col">Details</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody id="list">
      <!-- <tr>
        <td><span class="badge badge-primary">Deposit</span></td>
        <th scope="row">000001</th>
        <td>2020-12-25</td>
        <td>$5,000.00</td>
        <td>---</td>
        <td>Done</td>
      </tr>
      <tr>
        <td><span class="badge badge-secondary">Bonus</span></td>
        <th scope="row">000002</th>
        <td>2020-12-25</td>
        <td>$20.00</td>
        <td><i class="fas fa-user mr-1"></i>user123</td>
        <td>Done</td>
      </tr>
      <tr>
        <td><span class="badge badge-success">Withdraw</span></td>
        <th scope="row">000003</th>
        <td>2020-12-25</td>
        <td>$500.00</td>
        <td>---</td>
        <td>Done</td>
      </tr> -->
    </tbody>
  </table>
</div>

<!-- Depositのポップアップ -->
<div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>DEPOSIT</h4></h4>
            </div>
            <div class="modal-body">
              <form class="profile p-md-3 form-deposit">
                <label for="name">Deposit limit</label>
                <input type="number" id="depositable_amount" class="form-control mb-4" placeholder="" readonly>

                <label for="name">Deposit amount</label>
                <input type="number" id="amount" name="amount" class="form-control" placeholder="amount" value=0>
              </form>
              <div id="alert-deposit"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="send-deposit">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Withdrawaのポップアップ -->
<div class="modal fade" id="withdrawaModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>WITHDRAW</h4></h4>
            </div>
            <div class="modal-body">
              <form class="profile p-md-3 form-withdraw">
                <label for="name">Withdrawal limit</label>
                <input type="number" id="Withdrawal_limit" class="form-control mb-4" placeholder="" readonly>

                <label for="name">Withdrawal amount</label>
                <input type="number" id="amount" name="amount" class="form-control" placeholder="amount" value=0>
              </form>
              <div id="alert-withdraw"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="send-withdraw">Submit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
window.onload=function () {
	$("header").load("/navi",function () {
		$('#nav-item-wallet').addClass('active');
  });
};

function createList(data) {
  var tag = '';
  for (var key in data) {
    tag += '<tr>';
    if (data[key]['category_code'] == 'deposit') {
      tag += '<td><span class="badge badge-primary">Deposit</span></td>';
    } else if (data[key]['category_code'] == 'bonus') {
      tag += '<td><span class="badge badge-secondary">Bonus</span></td>';
    } else if (data[key]['category_code'] == 'payment') {
      tag += '<td><span class="badge badge-danger">Payment</span></td>';
    } else if (data[key]['category_code'] == 'withdraw') {
      tag += '<td><span class="badge badge-success">Withdraw</span></td>';
    }
    tag += '<th scope="row">'+data[key]['id']+'</th>';
    tag += '<td>'+data[key]['created_at']+'</td>';
    tag += '<td>$ '+data[key]['amount']+'</td>';
    if (data[key]['category_code'] == 'deposit') {
      tag += '<td>=></td>';
      tag += '<td>$ '+ (parseInt(data[key]['amount']) * -1) +'</td>';
    } else {
      tag += '<td></td>';
      tag += '<td></td>';
    }
    tag += '<td>---</td>';
    tag += '<td>Done</td>';
    tag += '</tr>';
  }
  $("#list").html(tag);
}

$(function(){
	$('#send-deposit').click(function(){
		var param = $(".form-deposit").serializeArray();
		param = fromAssociativeArray(param);

    if (confirm("入金します。よろしいですか？")){
      submitDeposit(param);
    }
	});

  $('#send-withdraw').click(function(){
		var param = $(".form-withdraw").serializeArray();
		param = fromAssociativeArray(param);

    if (confirm("出金します。よろしいですか？")){
      submitWithdrawal(param);
    }
	});
});

function submitDeposit(param){
	$.ajax({
		type: 'POST',
		url: '/api/deposit',
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
      location.reload()
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
					$('#alert-deposit').html(html);
					break;
				default:
					alert("更新失敗");
			}
		},
	});
}

function submitWithdrawal(param){
	$.ajax({
		type: 'POST',
		url: '/api/withdrawal',
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
      location.reload()
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
					$('#alert-withdraw').html(html);
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