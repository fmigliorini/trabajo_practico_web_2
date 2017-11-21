

<?php

$listMantenimiento = Vehiculo_model::getReporteKilometrosService();
?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Kilometros faltantes para el mantenimiento </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Mantenimiento</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <a href="libs/reportes-kilometrosService_pdf.php" class="btn btn-primary">Exportar PDF</a>
        <table id="tablaMantenimiento">
          <thead>
                <tr>
                  <th>Id Vehiculo</th>
                  <th>Patente</th>
                  <th>Marca</th>
                  <th>Fecha de fabricacion</th>
                  <th>Km. realizados</th>
                  <th>Km. para service</th>
                </tr>
            </thead>

            <tbody>
            <?php
                if ( !empty($listMantenimiento) ){
                    foreach($listMantenimiento as $mantenimiento) {  ?>
                    <tr>
                      <td><?php echo $mantenimiento->id?></td>
                      <td><?php echo $mantenimiento->marca?></td>
                      <td><?php echo $mantenimiento->patente?></td>
                        <td><?php echo $mantenimiento->fecha_fabricacion?></td>
                      <td><?php echo $mantenimiento->KilometrosRecorridos?></td>
                      <td><?php echo $mantenimiento->KilometrosService?></td>
                    </tr>
            <?php
                    }
                }
            ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>

<div class="">

    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>

</div>


  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ['Mushrooms', 3],
        ['Onions', 1],
        ['Olives', 1],
        ['Zucchini', 1],
        ['Pepperoni', 2]
      ]);

      // Set chart options
      var options = {'title':'How Much Pizza I Ate Last Night',
                     'width':400,
                     'height':300};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
