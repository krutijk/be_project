<?php
    $conn = mysqli_connect("localhost", "root", "", "disaster");
    $query = "SELECT * FROM alerts WHERE entryby = 'People'";
    $result = mysqli_query($conn, $query);
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Flood Forecasting System</title>
        <link href="./css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Flood Forecasting System</title>
    </head>
    <body>
    <div class="content pt-5">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Common Alerts</h4>
                  <p class="card-category">Alerts Issued</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover" id="myTable">
                    <thead class="text-primary">
                      <th>Calamity</th>
                      <th>State</th>
                      <th>Description</th>
                      <th>Date</th>
                      <th>Time</th>
                    </thead>
                    <tbody>
                    <?php while($array = mysqli_fetch_assoc($result)): ?>
                      <tr>
                        <td><?php echo $array['calamity']; ?></td>
                        <td><?php echo $array['state']; ?></td>
                        <td><?php echo $array['description']; ?></td>
                        <td><?php echo $array['date']; ?></td>
                        <td><?php echo $array['time']; ?></td>
                      </tr>
                    <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>