<?php

include ("koneksi.php");
$sql = "SELECT * FROM `tbl_log` ORDER BY `tanggal` DESC LIMIT 1";

$response = mysqli_query($conn, $sql);
if($response->num_rows > 0){
  while($row = $response->fetch_assoc()){
  	$no = $row['id_log'];
    $last_temp=$row['suhu'];
    $last_humid=$row['humidity'];
    $last_ph=$row['ph_tanah'];
    $last_update=$row['tanggal'];
  }
}

$sql2 = "SELECT * FROM `tbl_log`";

$response2 = mysqli_query($conn, $sql2);
$num_results = $response2->num_rows;

?>

<html>
<head><title>Monitoring</title></head>
<body>
	<table border="1" align="center">
		<tr>
			<th>No</th>
			<th>suhu</th>
			<th>ph tanah</th>
			<th>Kelembaban tanah</th>
		</tr>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $last_temp;?></td>
			<td><?php echo $last_ph;?></td>
			<td><?php echo $last_humid;?></td>
		</tr>
	</table>
	<?php echo "<p align='center'?> Diupdate terakhir ".$last_update;"</p>"
	?>
	<br>
	<?php echo "Jumlah data".$num_results; ?>
</body>
</html>