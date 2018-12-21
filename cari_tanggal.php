select * from tbl_log 
where tanggal between '2018-11-08 20:47:21' and '2018-11-09 09:39:13' 
order by tanggal desc;

<?php

include ("koneksi.php");
$sql = "select * from tbl_log 
where tanggal between '2018-11-08 20:47:21' and '2018-11-09 09:39:13' 
order by tanggal desc";
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