<?php
include('./includes/header.php');
?>

<!-- Styling to make chart responsive -->
<style>
.chart-container {
  width: 100%;
  height: 400px; 
}


@media (max-width: 768px) {
  .chart-container {
    height: 300px;
  }
}
</style>



<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- Orders view form -->
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Top 10 best Selling</h2>
            <div class="table-responsive">
              <table class="table table-bordered bg-dark">
                <thead class="bg-light">
                  <tr>
                    <th>Rank</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                 <!-- Top 10 best selling items query  -->
                 <?php
                 $query = $pdo->prepare("SELECT product_name, SUM(quantity) AS total_quantity
                     FROM orders
                     WHERE status = 'approved'
                     GROUP BY product_name
                     ORDER BY total_quantity DESC
                     LIMIT 10;");
                 $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_ASSOC);

                 $rank = 1;

                 foreach ($data as $bestselling) {
                 ?>
                  <tr>
                    <td>
                      <?php echo $rank; ?>
                    </td>
                    <td>
                      <?php echo $bestselling['product_name']; ?>
                    </td>
                    <td>
                      <?php echo $bestselling['total_quantity']; ?>
                    </td>
                  </tr>
                 <?php
                 $rank++;
                 }
                 ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Pie chart display -->
    <div class="row mt-5">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pie Chart</h4>
        <div id="piechart_3d" class="col-12 chart-container"></div>
      </div>
    </div>
  </div>
</div>


  <!-- content-wrapper ends -->


</div>

  <!-- footer.php -->
  <?php
  include('./includes/footer.php');
  ?>



<!-- Top selling products pie chart php+javascript code starts here-->

<?php
    $query=$pdo->prepare("SELECT product_name, SUM(quantity) AS total_quantity
    FROM orders
    WHERE status = 'approved'
    GROUP BY product_name
    ORDER BY total_quantity DESC
    LIMIT 10;
    ");

    $query->execute();

    $arr=$query->fetchAll(PDO::FETCH_ASSOC);
    ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
  google.charts.load("current", { packages: ["corechart"] });
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['product_name', 'quantity'],
      <?php
      foreach ($arr as $value) {
        echo "['" . $value['product_name'] . "', " . $value['total_quantity'] . "],";
      }
      ?>
    ]);

    var options = {
      title: 'Top Selling Products',
      is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
  }
</script>

<!-- Top selling products pie chart php+javascript code ends here-->