<?php
include('./includes/header.php');
?>

<!-- Styling to make bar chart responsive -->
<style>
.barchart-container {
  width: 100%;
  height: 400px;
}


@media (max-width: 768px) {
  .barchart-container {
    height: 600px;
  }
}
</style>

<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">


    <!-- Orders view form -->
    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Top 10 Customers</h2>
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
                          $query=$pdo->prepare("SELECT
                          customers.customer_id,
                          customers.name,
                          SUM(orders.quantity) AS total_order_quantity
                      FROM orders 
                      INNER JOIN customers ON customers.customer_id = orders.customer_id
                      WHERE orders.status = 'approved'
                      GROUP BY customers.customer_id
                      ORDER BY total_order_quantity DESC
                      LIMIT 10;
                          ");
                          $query->execute();
                          $data=$query->fetchAll(PDO::FETCH_ASSOC);

                          $rank = 1;

                            foreach($data as $topcustomers){
                          ?>
                  <tr>
                    <td>
                      <?php echo $rank;?>
                    </td>
                    <td>
                      <?php echo $topcustomers['name']?>
                    </td>
                    <td>
                      <?php echo $topcustomers['total_order_quantity']?>
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

    <!-- Bar chart display -->
    <div class="row mt-2">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Bar Chart</h4>
        <div id="barchart_material" class="col-12 barchart-container"></div>
      </div>
    </div>
  </div>
</div>

  </div>
  <!-- content-wrapper ends -->


  <!-- footer.php -->
  <?php
include('./includes/footer.php');
?>



<!-- Top customers bar chart php+javascript code starts here-->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        <?php
        $query = $pdo->prepare("SELECT
                                  customers.customer_id,
                                  customers.name,
                                  SUM(orders.quantity) AS total_order_quantity
                              FROM orders
                              INNER JOIN customers ON customers.customer_id = orders.customer_id
                              WHERE orders.status = 'approved'
                              GROUP BY customers.customer_id
                              ORDER BY total_order_quantity DESC
                              LIMIT 10;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>

        // Create a data array from PHP data
        var data = [['Customers', 'Total Order Quantity']];
        <?php
        foreach ($result as $row) {
          echo "data.push(['" . $row['name'] . "', " . $row['total_order_quantity'] . "]);";
        }
        ?>

        var data = google.visualization.arrayToDataTable(data);

        var options = {
          chart: {
            title: 'Top 10 Customers by Order Quantity',
            subtitle: 'Total Order Quantity for Customers with Approved Orders',
          },
          bars: 'vertical', // Make bars thin by switching to horizontal
          bar: { groupWidth: '25%' }, // Adjust the bar width (e.g., 25%)
          colors: ['#793FDF', '#ff8c33', '#ffbd33', '#ffd633', '#33ff57', '#33ffbd', '#33d6ff', '#336eff', '#8c33ff', '#bd33ff'] // Set custom bar colors
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

    <!-- Top customers bar chart php+javascript code starts here-->