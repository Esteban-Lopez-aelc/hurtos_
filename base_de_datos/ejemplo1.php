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
		
		case 'coordenadas':
		{
			$lat = $parametros['lat'];
			$lng = $parametros['lng'];
			$rad = $parametros['rad'];
			$sql = "select buffer($lat,$lng,$rad);";

   
			$query = pg_query($dbcon,$sql);
			$row = pg_fetch_row($query);
			echo $row[0];
			break;
		}
		
		
		case 'dibujar_buffer':
		{
			$sql="SELECT row_to_json(fc)
			 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
			 FROM (SELECT 'Feature' As type
				, ST_AsGeoJSON(lg.geom)::json As geometry
				, row_to_json((SELECT l FROM (SELECT id) As l
				  )) As properties
			   FROM buff_geom As lg   ) As f )  As fc;";
   
			$query = pg_query($dbcon,$sql);
			$row = pg_fetch_row($query);
			echo $row[0];
			break;
		}
		
		case 'c_hurtos':
		{

			$sql = "select contador from hurtos_buffer;";

   
			$query = pg_query($dbcon,$sql);
			$row = pg_fetch_row($query);
			echo $row[0];
			break;
		}
		
		case 'dibujar_hurto':
		{
			$sql="SELECT row_to_json(fc)
			 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
			 FROM (SELECT 'Feature' As type
				, ST_AsGeoJSON(lg.geom)::json As geometry
				, row_to_json((SELECT l FROM (SELECT id) As l
				  )) As properties
			   FROM hurtos_buffer As lg ) As f )  As fc;";
   
			$query = pg_query($dbcon,$sql);
			$row = pg_fetch_row($query);
			echo $row[0];
			break;
		}
   }
    

?>