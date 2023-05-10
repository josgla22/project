<?php
// Establish database connection
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$query = "SELECT browser, COUNT(*) as count FROM access_log GROUP BY browser";
$result = $conn->query($query);

// Store data in an array
$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = array($row['browser'], (int)$row['count']);
}

// Convert the data to a format compatible with Google Charts
$data_json = json_encode($data);

// Close the database connection
$conn->close();
?>

<!-- Display the chart using Google Charts -->
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Browser');
    data.addColumn('number', 'Count');
    data.addRows(<?php echo $data_json ?>);
    var options = {
      title: 'Browser Usage',
      is3D: true
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
  </script>
</head>
<body>
  <div class="tracker">
  <h1>Statistics</h1>
  <p>Our website features a pie chart that shows the different types of web browsers used by our visitors. This chart is based on information that we collect from our database every time someone visits our website. By looking at the chart, you can see which browser is the most popular among our users. This information is useful to us as it helps us to optimize our website for the most commonly used browsers. So, take a look at the chart and see which browser is the most popular among our users!
  </div>
  <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>