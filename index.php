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

$sql2 = "SELECT * FROM `tbl_log`";

$response2 = mysqli_query($conn, $sql2);
$num_results = $response2->num_rows;

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
  <link rel="stylesheet" href="assets/css/flipclock.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/js/flipclock.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
         <li class="active"><a href="#">Dashboard</a></li>
         <li><a href="statistik.php">Tabel</a></li>
         <li><a href="graph.php">Graph</a></li>
       </ul>
     </div>
   </div>
 </nav>

 <div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav hidden-xs">
      <img src="assets/image/plants.png" width="60px" height="60px">
      <center><h3 style="text-align:center;">Monitoring Suhu Tanaman</h3></center>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="statistik.php">Tabel</a></li>
        <li><a href="graph.php">Graph</a></li>
      </ul><br>
    </div>
    <br>

    <div class="col-sm-9">

      <div class="well">

        <center><div class="clock"></div></center>


      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="well"> 
            <center><h4>Suhu (&degC)</h4></center>
            <!-- gauge meter suhu-->
            <div id="jg1" class="gauge size-2"></div>
            <div class="h-split"></div>
            <!-- end gauge meter suhu-->

          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <center><h4>Kelembaban Tanah</h4></center>
            <!-- gauge meter humid-->
            <div id="jg2" class="gauge size-2"></div>
            <div class="h-split"></div>
            <!-- end gauge meter humid-->

          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <center><h4>pH Tanah</h4></center>
            <div id="jg3" class="gauge size-2"></div>
            <div class="h-split"></div> 

          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="well">
            <!-- masukin chart ke html -->
            <p style="color: black; font-weight: bold;" align="center">Keterangan Data :</p>
            <br>
            <table class="table table-striped table-hover">
              <tr>
               <td>Banyaknya Data</td>
               <td>:</td>
               <td><?php echo $num_results; ?> </td>
             </tr>
             <tr>
               <td>Terakhir Diupdate</td>
               <td>:</td>
               <td><?php echo $last_update; ?> </td>
             </tr>

           </table>
           <!-- end chart html -->
         </div>
       </div>

     </div>

   </div>
 </div>
</div>

<script src="assets/js/raphael-2.1.4.min.js"></script>
<script src="assets/js/justgage.js"></script>

<!-- jam digital -->
<script type="text/javascript">
  var clock;

  $(document).ready(function() {
    clock = jQuery('.clock').FlipClock({
      clockFace: 'TwentyFourHourClock'
    });
  });
</script>
<!-- end jam digital -->

<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    var jg1, jg2, jg3

    var defs1 = {
      label: "Celcius °",
      value: <?php echo $last_temp; ?>,
      min: 0,
      max: 100,
      decimals: 0,
      gaugeWidthScale: 0.6,
      pointer: true,
      pointerOptions: {
        toplength: 10,
        bottomlength: 10,
        bottomwidth: 2
      },
      counter: true,
      relativeGaugeSize: true
    }

    var defs2 = {
      label: "Kelembaban Tanah",
      value: <?php echo $last_humid; ?>,
      min: 0,
      max: 5000,
      decimals: 0,
      gaugeWidthScale: 0.6,
      pointer: true,
      pointerOptions: {
        toplength: 10,
        bottomlength: 10,
        bottomwidth: 2
      },
      counter: true,
      relativeGaugeSize: true
    }

    var defs3 = {
      label: "pH tanah",
      value: <?php echo $last_ph; ?>,
      min: 0,
      max: 14,
      decimals: 0,
      gaugeWidthScale: 0.6,
      pointer: true,
      pointerOptions: {
        toplength: 10,
        bottomlength: 10,
        bottomwidth: 2
      },
      counter: true,
      relativeGaugeSize: true
    }

    jg1 = new JustGage({
      id: "jg1",
      defaults: defs1
    });

    jg2 = new JustGage({
      id: "jg2",
      defaults: defs2
    });

    jg3 = new JustGage({
      id: "jg3",
      defaults: defs3
    });


  });
</script>
<!-- manggil chart -->

<!-- end manggil chart -->
</body>
<!-- end of Badan -->


</html>
