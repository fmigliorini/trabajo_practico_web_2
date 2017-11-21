<?php
$listConsumo = Vehiculo_model::getConsumo();
?><!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChartConsumo);
    google.charts.setOnLoadCallback(drawChartGrafico);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChartConsumo() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tipo de Vehiculo');
        data.addColumn('number', 'consumo de conmbustible x Km.');
        data.addRows([
          <?php $i = 0; ?>
          <?php foreach ($listConsumo as $consumoVehiculo ): ?>
            [<?php echo "'".$consumoVehiculo->vehiculo."'";?>, <?php echo $consumoVehiculo->consumo; ?>]
            <?php if ($i !== sizeof($listConsumo) -1){
              echo ",";
            }
            $i++; ?>
          <?php endforeach; ?>

        ]);

        // Set chart options
        var options = {'title':'Combustible utilizado por tipo de vehiculo',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }

      function drawChartGrafico() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tipo de Vehiculo');
        data.addColumn('number', 'consumo de conmbustible x Km.');
        data.addRows([
          <?php $i = 0; ?>
          <?php foreach ($listConsumo as $consumoVehiculo ): ?>
            [<?php echo "'".$consumoVehiculo->vehiculo."'";?>, <?php echo $consumoVehiculo->consumo; ?>]
            <?php if ($i !== sizeof($listConsumo) -1){
              echo ",";
            }
            $i++; ?>
          <?php endforeach; ?>

        ]);

        // Set chart options
        var options = {'title':'Combustible utilizado por tipo de vehiculo',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }

    </script>
<div class="content-wrapper">
  <section class="content-header">
      <h1> Bienvenido a Graficos </h1>

  </section>

<br>
         <div class="container">
             <div class="col-sm-10 no-gutter">
               <div class="panel panel-default">
               <div class="panel-heading">
                 <h3 class="panel-title">Combustible utilizado por tipo de vehiculo</h3>
               </div>
               <div class="panel-body">
                 <p> En este grafico podremos visualizar el consumo de combustible por kilometro y tipo de vehiculo</p>
             <div id="chart_div1"></div>
               </div>
             </div>
           </div>
        </div>

        <div class="container">
            <div class="col-sm-10 no-gutter">
              <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Combustible utilizado por tipo de vehiculo</h3>
              </div>
              <div class="panel-body">
                <p> En este grafico podremos visualizar el consumo de combustible por kilometro y tipo de vehiculo</p>
            <div id="chart_div2"></div>
              </div>
            </div>
          </div>
       </div>




      <div id="chart_div2"></div>

      </section>
  </div>
