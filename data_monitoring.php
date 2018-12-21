<!DOCTYPE html>
<html>
<head>
	<title>Monitoring Suhu Data Tabel</title>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="assets/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="assets/js/buttons.print.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="assets/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.css">
</head>
<body>
	<center>
		<h1>Statistik Data Harian</h1>
	</center>
	<br/>
	<br/>
	<div class="container">
		<table class="table table-striped table-bordered data" id="tabel">
			<thead>
				<tr>	
					<th>Waktu</th>		
					<th>Suhu&deg</th>
					<th>Soil Moisture</th>
					<th>pH tanah</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include ("koneksi.php");
				$sql = "SELECT * FROM `tbl_log` ORDER BY `tanggal` DESC";

				$response = mysqli_query($conn, $sql);
				if($response->num_rows > 0){
					while($row = $response->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['tanggal'];?></td>
							<td><?php echo $row['suhu'];?></td>
							<td><?php echo $row['humidity'];?></td>
							<td><?php echo $row['ph_tanah'];?></td>
						</tr>
					<?php } 
				}?>

			</tbody>
		</table>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabel').DataTable( {
				dom: 'Bfrtip',
				buttons: [
				'print'
				]
			} );
		} );
	</script>
</body>



</html>