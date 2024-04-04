<?php 

  //configuracion de la conexion a la base de datos

   include('configuracion.php');
   
   session_start();
   
   if(!isset($_POST['peticion']))
   {
	$_POST['peticion'] = "peticion";
   }

   if(!isset($_POST['parametros']))
   {
	$_POST['parametros'] = "parametros";
   }
   
   $peticion = $_POST['peticion'];
   $parametros = $_POST['parametros'];
   
   switch($peticion)
   {
		

		case 'destino':
		{
			$sql="SELECT row_to_json(fc)
			 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
			 FROM (SELECT 'Feature' As type
				, ST_AsGeoJSON(lg.geom2)::json As geometry
				, row_to_json((SELECT l FROM (SELECT id,y1,x1,y2,x2) As l
				  )) As properties
			   FROM destino As lg ) As f )  As fc;";
   
			$query = pg_query($dbcon,$sql);
			$row = pg_fetch_row($query);
			echo $row[0];
			break;
		}
   }
    

?>