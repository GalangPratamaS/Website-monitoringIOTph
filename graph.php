<?php


include ("koneksi.php");
$sql = "SELECT * FROM `tbl_log` ORDER BY `tanggal` DESC LIMIT 1";

$response = mysqli_query($conn, $sql);
if($response->num_rows > 0){
	while($row = $response->fetch_assoc()){
		$last_temp=$row['suhu'];
		$last_humid=$row['humidity'];
		$last_ph=$row['ph_tanah'];
		$last_update=$row['tanggal'];
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- kepala -->
<head>
	<title>Monitoring Tanaman</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/image/plants.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- skrip chart -->
	
	<!-- end skrip chart -->
	<style>
	/* Set height of the grid so .sidenav can be 100% (adjust as needed) */
	.row.content {height: 550px}

	/* Set gray background color and 100% height */
	.sidenav {
		background-color: #f1f1f1;
		height: 100%;
	}

	/* On small screens, set height to 'auto' for the grid */
	@media screen and (max-width: 767px) {
		.row.content {height: auto;} 
	}
</style>
<style type="text/css">
   body { background: #dadfe1 !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>
</head>
<!-- end of kepala -->

<!-- Badan -->
<body>

	<nav class="navbar navbar-inverse visible-xs">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="#">Monitoring Suhu</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Dashboard</a></li>
					<li><a href="statistik.php">Tabel</a></li>
					<li class="active"><a href="#">Graph</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-2 sidenav hidden-xs">
				<img src="assets/image/plants.png" width="60px" height="60px">
				<center><h3>Monitoring Suhu Tanaman</h3></center>
				<ul class="nav nav-pills nav-stacked">
					<li><a href="index.php">Dashboard</a></li>
					<li><a href="statistik.php">Tabel</a></li>
					<li class="active"><a href="#">Graph</a></li>
				</ul><br>
			</div>
			<br>

			<div class="col-sm-9">

				<div class="well">
					<h3 align="center"> Graph Data Harian </h3>

				</div>
			</div>


			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-6">
						<div class="well">
							<div id="container2">
								<br>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="well">
							<div id="container3">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="well">
							<!-- masukin chart ke html -->
							<div id="container1">
								<br>
							</div>
							
							
							<?php 
							$sql = "SELECT * FROM `tbl_log` ORDER BY `tanggal` DESC";

							$response = mysqli_query($conn, $sql);
							if($response->num_rows > 0){
								while($row = $response->fetch_assoc()){
									$value = $row['suhu'];
									$value2= $row['humidity'];
									$value3= $row['ph_tanah'];
									$timestamp = strtotime($row['tanggal'])*1000;
									$data1[] = "[$timestamp, $value]";
									$data2[] = "[$timestamp, $value2]";
									$data3[] = "[$timestamp, $value3]";
								}
								mysqli_close($conn);
							}
							?>
							<!-- end chart html -->
						</div>
					</div>

				</div>
				
			</div>
		</div>
	</div>


	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script type="text/javascript" src="assets/js/modules/data.js"></script>
	<script type="text/javascript" src="assets/js/modules/exporting.js"></script>
	<script type="text/javascript" src="assets/js/highcharts.js"></script>
	<script type="text/javascript" src="assets/js/themes/sand-signika.js"></script>
	<!-- end manggil chart -->

	<script>
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container1'
			},
			title: {
				text: 'Grafik Data Suhu Harian'
			},

			xAxis: {
				title: {
					enabled: true,
					text: 'Hours of the Day'
				},
				type: 'datetime',

				dateTimeLabelFormats : {
					hour: '%I %p',
					minute: '%I:%M %p'
				}
			},
			series: [{
				data: [<?php echo join($data1, ',') ?>]
			}]
		});
	</script>
	<script>
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container2'
			},
			title: {
				text: 'Grafik Data Kelembaban Harian'
			},

			xAxis: {
				title: {
					enabled: true,
					text: 'Hours of the Day'
				},
				type: 'datetime',

				dateTimeLabelFormats : {
					hour: '%I %p',
					minute: '%I:%M %p'
				}
			},
			series: [{
				data: [<?php echo join($data2, ',') ?>]
			}]
		});
	</script>

	<script>
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container3'
			},
			title: {
				text: 'Grafik Data pH Harian'
			},

			xAxis: {
				title: {
					enabled: true,
					text: 'Hours of the Day'
				},
				type: 'datetime',

				dateTimeLabelFormats : {
					hour: '%I %p',
					minute: '%I:%M %p'
				}
			},
			series: [{
				data: [<?php echo join($data3, ',') ?>]
			}]
		});
	</script>
</body>
<!-- end of Badan -->


</html>
