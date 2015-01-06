<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>
<?php


include("db.php");
$sql = "SELECT * FROM mno_gerencia ORDER BY profundidad";

$result=mysql_query($sql);



$depende = [];

while($test = mysql_fetch_array($result)){
    $descripcion = $test['descripcion'];
    $nombre_depende = $test['nombre_depende'];

    $depende[$descripcion] = $nombre_depende ;
    // $depende[$descripcion] = $nombre_depende;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>


    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        <?php
$time_pre = microtime(true);
 ?>
        google.load("visualization", "1", {packages:["orgchart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Name');
            data.addColumn('string', 'Manager');
            data.addColumn('string', 'ToolTip');

            data.addRows([
                //[{v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'}, '', 'The President'],
                // [{v:'Jim', f:'Jim<div style="color:red; font-style:italic">Vice President<div>'}, 'Mike', 'VP'],


                <?php
                    foreach ($depende as $key => $value) {
                        echo(" ['".$key."', '". $value."', ''],");
                    }
                ?>

            ]);

            var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
            chart.draw(data, {allowHtml:true,size:'medium'});
        }


        <?php
        $time_post = microtime(true);

        ?>
    </script>
</head>
<body >


      <div id="chart_div" ></div>


</body>
</html>