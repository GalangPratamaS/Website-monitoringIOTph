<?php

include ("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$suhu = $_GET['suhu'];
$humidity = $_GET['humidity'];
$ph_tanah = $_GET['ph_tanah'];

if ($ph_tanah < 0 or $suhu < 0 or $humidity < 0){
	echo "Sensor error, cek sensor!";
} else {

	$sql = "SELECT * FROM `tbl_log` ORDER BY `tanggal` DESC LIMIT 1";
	$response = mysqli_query($conn, $sql);
	if($response->num_rows > 0){
		while($row = $response->fetch_assoc()){
			$last_temp=$row['suhu'];
			$last_rh=$row['humidity'];
			$last_ph=$row['ph_tanah'];
		}
	}
	if (strcmp($last_temp, $suhu)!=0 or strcmp($last_rh, $humidity)!=0 or strcmp($last_ph, $ph_tanah)!=0) {
		$query = "INSERT INTO tbl_log (suhu,humidity,ph_tanah) VALUES ('$suhu','$humidity','$ph_tanah')";
		$exeQuery = mysqli_query($conn,$query);
		echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'berhasil menambahkan data')) : json_encode(array('kode' => 2, 'pesan' => 'data gagal ditambahkan'));
	} 
}
?>