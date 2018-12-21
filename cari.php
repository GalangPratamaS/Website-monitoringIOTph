<!DOCTYPE html>
<html lang="en">
<!-- kepala -->
<head>
  <title>Statistik Data Harian Monitoring Tanaman</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/image/plants.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="assets/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="assets/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="assets/js/buttons.print.min.js"></script>

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
          <li class="active"><a href="statistik.php">Tabel</a></li>
          <li><a href="graph.php">Graph</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-2 sidenav hidden-xs">
        <img src="assets/image/plants.png" width="60px" height="60px">
        <h3>Monitoring Suhu Tanaman</h3>
        <ul class="nav nav-pills nav-stacked">
          <li ><a href="index.php">Dashboard</a></li>
          <li class="active"><a href="statistik.php">Tabel</a></li>
          <li><a href="graph.php">Graph</a></li>
        </ul><br>
      </div>
      <br>

      <div class="col-sm-9">

        <div class="well">
          <h3 align="center"> Statistik Data Harian </h3>

        </div>

        <div class="row">
          <div class="col-sm-12">


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
                $start_date = $_POST['tgl_awal'];
                $end_date = $_POST['tgl_akhir'];

                $sql = "SELECT * from tbl_log 
                WHERE tanggal BETWEEN '$start_date' AND '$end_date' 
                ORDER BY tanggal DESC";

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

        </div>
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
    <!-- end of Badan -->


    </html>
