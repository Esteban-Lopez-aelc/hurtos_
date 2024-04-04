<?php
 #Archivo de configuracion de la base de datos
 
    define("PG_DB"  , "sigweb");
	define("PG_HOST", "bd1.cduyoesuqa1z.us-east-1.rds.amazonaws.com");
	define("PG_USER", "postgres");
	define("PG_PSWD", "postgres");
	define("PG_PORT", "postgres");
	
	$dbcon = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");


?>
