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
	<script type="text/javascript" src="js/util.js"></script>
	<script type="text/javascript" src="js/authorize.js"></script>
	<script type="text/javascript">
    var mlist = {
      setUserInfo: function() {
        $.when(
          $.ajax({
            type: 'GET',
            url: '/api/home',
            dataType: 'json',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            beforeSend:function(xhr, settings){
              xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
            }
          })
        ).done( ( data ) => {
          for (var key in data) {
            $("#summary-"+key).html('<div>'+data[key]+'</div>');
          }
        }).fail( ( data ) => {
          alert("取得失敗");
        });
      },
      setReferalCode: function() {
        $.when(
          $.ajax({
            type: 'GET',
            url: '/api/qr_code/1',
            beforeSend:function(xhr, settings){
              xhr.setRequestHeader( 'Authorization', 'Bearer '+ getStorageToken() );
            }
          })
        ).done( ( data ) => {
          $("#referral_code").html('<a href="'+data+'" target="_blank">'+data+'</a>');
        }).fail( ( data ) => {
          alert("取得失敗");
        });
      },
      visibility: function() {
        $('.container').css('visibility', 'visible');
      }
    };
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
  <section>
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="media white z-depth-1 rounded">
          <i class="fas fa-users fa-lg blue z-depth-1 p-4 rounded-left text-white mr-3"></i>
          <div class="media-body p-1">
            <p class="text-uppercase text-muted mb-1"><small>User</small></p>
            <h5 class="font-weight-bold mb-0" id="summary-user">...</h5>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="media white z-depth-1 rounded">
          <i class="fas fa-handshake fa-lg teal z-depth-1 p-4 rounded-left text-white mr-3"></i>
          <div class="media-body p-1">
            <p class="text-uppercase text-muted mb-1"><small>Referrals</small></p>
            <h5 class="font-weight-bold mb-0" id="summary-referrals">...</h5>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="media white z-depth-1 rounded">
          <i class="fas fa-wallet fa-lg deep-purple z-depth-1 p-4 rounded-left text-white mr-3"></i>
          <div class="media-body p-1">
            <p class="text-uppercase text-muted mb-1"><small>Wallet</small></p>
            <h5 class="font-weight-bold mb-0" id="summary-wallet">...</h5>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="media white z-depth-1 rounded">
          <i class="fas fa-comment-dollar fa-lg pink z-depth-1 p-4 rounded-left text-white mr-3"></i>
          <div class="media-body p-1">
            <p class="text-uppercase text-muted mb-1"><small>Bonus</small></p>
            <h5 class="font-weight-bold mb-0" id="summary-bonus">...</h5>
          </div>
        </div>
      </div>
    </div>
  </section>

<div class="container my-5 py-5 z-depth-1">
    <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">
      <div class="row">
        <div class="col-md-3 mb-4 mb-md-0">
			 <img src="img/qrcode.jpg" style="width:200px">
        </div>
        <div class="col-md-9 mb-4 mb-md-0">
          <h3 class="font-weight-bold">Referral Code</h3>
          <p class="text-muted">
          <div id="referral_code"></div>
		  </p>
		  <button class="btn btn-brown btn-md ml-0" type="button">To clipborad<i class="fas fa-copy ml-2"></i></button>
        </div>
      </div>
    </section>
	<section style="margin-top:20px">
    <div class="card indigo">
      <div class="card-body">
        <p class="h5 white-text pb-4 mb-3"><i class="fas fa-chart-pie px-2"></i>Referrals Chart</p>
        <canvas id="lineChart1" class="mb-4" height="100"></canvas>
      </div>
    </div>
  </section>
  </div>
</div>


<script type="text/javascript">
window.onload=function () {
	$("header").load("/navi",function () {
		$('#nav-item-home').addClass('active');
	});
};

var ctxL = document.getElementById("lineChart1").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
    datasets: [{
      pointBackgroundColor: '#fff',
      backgroundColor: 'transparent',
      borderColor: 'rgba(255, 255, 255)',
      data: [2500, 2550, 5000, 3100, 7000, 5500, 4950, 16000, 10500, 8000],
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
          color: "transparent",
          zeroLineColor: "transparent"
        },
        ticks: {
          fontColor: "#fff",
        },
      }],
      yAxes: [{
        display: true,
        gridLines: {
          display: true,
          drawBorder: false,
          color: "rgba(255,255,255,.25)",
          zeroLineColor: "rgba(255,255,255,.25)"
        },
        ticks: {
          fontColor: "#fff",
          beginAtZero: true,
          stepSize: 5000
        },
      }],
    }
  }
});

// Minimalist charts
$(function () {
  $('.min-chart#chart-pageviews').easyPieChart({
    barColor: "#3059B0",
    onStep: function (from, to, percent) {
      $(this.el).find('.percent').text(Math.round(percent));
    }
  });
  $('.min-chart#chart-downloads').easyPieChart({
    barColor: "#3059B0",
    onStep: function (from, to, percent) {
      $(this.el).find('.percent').text(Math.round(percent));
    }
  });
  $('.min-chart#chart-sales').easyPieChart({
    barColor: "#3059B0",
    onStep: function (from, to, percent) {
      $(this.el).find('.percent').text(Math.round(percent));
    }
  });
});
</script>


</body>
</html>
