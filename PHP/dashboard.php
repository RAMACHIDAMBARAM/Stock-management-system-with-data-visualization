<?php
@require 'connection.php';
@require 'session.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Dashboard - Stock Management</title>
		<link rel="stylesheet" href="../CSS/dashboard.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
		  <link href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.0/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
		  <link href="../jqplot/jquery.jqplot.css" rel="stylesheet" type="text/css" />
		  <script type="text/javascript">
			jQuery.browser = {};
			(function () {
				jQuery.browser.msie = false;
				jQuery.browser.version = 0;
				if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
					jQuery.browser.msie = true;
					jQuery.browser.version = RegExp.$1;
				}
			})();
		  </script>
	</head>
	<body>
		<div class="navbar">
			<ul> 
				<li><a href="dashboard.php">
						<img class = "img" src="../IMAGES/report.png" alt="drop.png" width="18px" height="18px"/> DASH BOARD</a></li>
				<li><a href="ViewSales.php">
						<img class = "img" src="../IMAGES/sales.png" alt="drop.png" width="18px" height="18px"/> SALES</a></li>
				<li><a href="Viewpurchase.php">
						<img class = "img" src="../IMAGES/suppliers.png" alt="drop.png" width="18px" height="18px"/> PURCHASE</a></li>
				<li><a href="ViewStock.php">
						<img class = "img" src="../IMAGES/stock.png" alt="drop.png" width="18px" height="18px"/> STOCK LIST</a></li>
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropbtn" onclick="myFunction()">
						<img class = "img" src="../IMAGES/accounts.png" alt="drop.png" width="18px" height="18px"/> ACCOUNT </a>
					<div class="dropdown-content" id="myDropdown">
					    <a class="dropDown" href="change_password.php">
							<img class = "img" src="../IMAGES/change_password.png" alt="drop.png" width="15px" height="15px"/> CHANGE PASSWORD</a>
						<a class="dropDown" href="logout.php"> 
							<img class = "img" src="../IMAGES/logout.png" alt="drop.png" width="15px" height="15px"/>  LOGOUT</a>
					</div>
				</li>
			</ul>
		</div>
		<div id="chart1"></div>
		<script language = "javascript">
		function myFunction() {
			document.getElementById("myDropdown").classList.toggle("show");
		}
		
		window.onclick = function(e) {
			if (!e.target.matches('.dropbtn')) {
				var dropdowns = document.getElementsByClassName("dropdown-content");
					for (var d = 0; d < dropdowns.length; d++) {
						var openDropdown = dropdowns[d];
							if (openDropdown.classList.contains('show')) {
								openDropdown.classList.remove('show');
							}
					}
			}
		}
		</script>
		<footer style="color:#DAA520">
			&copy; Copyrights Reserved by RM.R and Team
		</footer>
		<script src="../jqplot/jquery.jqplot.min.js" type="text/javascript"></script>
  <script src="../jqplot/plugins/jqplot.pieRenderer.js" type="text/javascript"></script>
  <script src="../jqplot/plugins/jqplot.barRenderer.js" type="text/javascript"></script>
  <script src="../jqplot/plugins/jqplot.categoryAxisRenderer.js" type="text/javascript"></script>
  <script type="text/javascript">
    
  var insider = insider || {};
  insider.Pages = insider.Pages || {};
  insider.Pages.Kernel = function (event) {
    var that = this,
      eventType = event.type,
      pageName = $(this).attr("data-insider-jspage");
    if (insider && insider.Pages && pageName && insider.Pages[pageName] && insider.Pages[pageName][eventType]) {
      insider.Pages[pageName][eventType].call(that);
    }
  };
  insider.Pages.Events = function () {
    $("div[data-insider-jspage]").on(
      'pagebeforecreate pagecreate pagebeforeload pagebeforeshow pageshow pagebeforechange pagechange pagebeforehide pagehide pageinit',
      insider.Pages.Kernel).on(
      "pageinit", insider.hideAddressBar);
  } ();
    $(document).ready(function(){
      $.ajax({
                      type: "POST",
                      url: 'http://localhost/project/PHP/salesgraph_php.php',
                      cache: false,
                      success: function(result){
                      if(result == 'Invalid')
                        {
                          alert("Incorrect Values");
                        }
                        else
                        {
                            var data = JSON.parse(result);
                            var s1 = [];
							var ticks = [];
                            var i = 0;
                            for(i in data)
                            {
								ticks.push(data[i].StockName)
                             s1.push(data[i].Quantity);
                             }
                            $.jqplot.config.enablePlugins = true;
                            plot1 = $.jqplot('chart1', [s1], {
                                animate: !$.jqplot.use_excanvas,
                                seriesDefaults:{
                                    renderer:$.jqplot.BarRenderer,
                                    pointLabels: { show: true }
                                },
                                axes: {
                                    xaxis: {
                                        renderer: $.jqplot.CategoryAxisRenderer,
                                        ticks: ticks
                                    }
                                },
                                highlighter: { show: false }
                            });
                         
                            $('#chart1').bind('jqplotDataClick', 
                                function (ev, seriesIndex, pointIndex, data) {
                                    $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
                                }
                            );
                        }
                                                },
                        error: function(data){
                          
                          alert("Unsufficient details. Not able to connect to server");
                               }
                      });
});
  </script>
	</body>
</html>