<?php
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:S") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('GMT');
include 'index.php';

	$year = date("Y");
	$antyear = $year-1;
	
function mesletra($mes){	
	switch($mes){
		case 1:echo "ENERO";break;
		case 2:echo "FEBRERO";break;
		case 3:echo "MARZO";break;
		case 4:echo "ABRIL";break;
		case 5:echo "MAYO";break;
		case 6:echo "JUNIO";break;
		case 7:echo "JULIO";break;
		case 8:echo "AGOSTO";break;
		case 9:echo "SEPTIEMBRE";break;
		case 10:echo "OCTUBRE";break;
		case 11:echo "NOVIEMBRE";break;
		case 12:echo "DICIEMBRE";break;
	}
}



  
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Graficas</title>
<link href="..\sites\all\themes\storefront\css\santana_blocks.css" rel="stylesheet" type="text/css" />
    <link href="styles.css" rel="stylesheet" />
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/knockout-2.2.1.js"></script>
		<script src="js/globalize.min.js"></script>
		<script src="js/dx.chartjs.js"></script>
<style type="text/css">
body,td,th {
	font-family: "Segoe UI", Helvetica, "Droid Sans", Tahoma, Geneva, sans-serif;
}
body {
	background-color: #FFF;
}
</style>
</head>

<body>
		<script type="text/javascript">
			$(function ()  
				{
   var dataSource = [
    <?php 
	$result = odbc_exec($conexión,"SELECT [Cantidad] as INSCRITOS,[FechaStr] AS DIA FROM [UniAlumnos].[dbo].[ConteoDiarioAlum] "); 
	/*$result = odbc_fetch_row($sql);*/
	  
   while($row = @odbc_fetch_array($result)){ ?>
        {dia: "<?php echo $row['DIA']; ?>", inscritos: <?php echo $row['INSCRITOS']; ?>},
    <?php 
         
            }?>  
];

$("#chartContainer").dxChart({
    dataSource: dataSource,
    commonSeriesSettings: {
        argumentField: "dia"
    },
    series: [
        { valueField: "inscritos", name: "Inscritos" },
        /*{ valueField: "americas", name: "Americas" },*/
       /* { valueField: "africa", name: "Africa" }*/
    ],
    argumentAxis:{
        grid:{
            visible: true
        }
    },
    tooltip:{
        enabled: true
    },
    title: "Alumnos inscritos totales",
    legend: {
        verticalAlignment: "bottom",
        horizontalAlignment: "center"
    },
    commonPaneSettings: {
        border:{
            visible: true,
            right: false
        }       
    }
});
}

			);
		</script>
        
        
    <div>
      <div class="nombre_user">

  </div>
    <div class="size12 gris1">Ordenes Aprobadas/Meta </div>  

				<div id="chartContainer" style="width: 100%; height: 440px;"></div>
				<br>
			
	<?php 
		$result = odbc_exec($conexión,"SELECT [Cantidad] as INSCRITOS,[FechaStr] AS DIA FROM [UniAlumnos].[dbo].[ConteoDiarioAlum] "); 
	/*$result = odbc_fetch_row($sql);*/
	  
   		while($row = @odbc_fetch_array($result)){ 
   	?>
   	<table width="200" border="1">

   	<tr>
        <td><a href="lyrics.php?FechaStr=<?php echo $row['DIA']; ?>"><?php echo $row['DIA']; ?></a>  </td>
        <td><?php echo $row['INSCRITOS']; ?></td>
    </tr>
    </table>
    <?php 
         
            }?>

      <div class="morado">datos</div>  
    </div>
</body>
</html>
