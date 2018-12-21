<?php

include ("koneksi.php");
$sql = "SELECT * FROM `tbl_log` ORDER BY `tanggal` DESC LIMIT 1";
$result = array();
$response = mysqli_query($conn, $sql);
if($response->num_rows > 0){
  while($row = $response->fetch_assoc()){
    $last_temp=$row['suhu'];
    $last_humid=$row['humidity'];
    $last_ph=$row['ph_tanah'];
    $last_update=$row['tanggal'];
    array_push($result, array('last_temp' => $row['suhu'], 'last_humid' => $row['humidity'], 'last_ph' => $row['ph_tanah'],'last_update' => $row['tanggal']));
  }
  echo json_encode(array("result" => $result));
}

?>