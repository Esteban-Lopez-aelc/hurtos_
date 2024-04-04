<?php
 #Archivo de configuracion de la base de datos
 
    define("PG_DB"  , "sigweb");
	define("PG_HOST", "localhost");
	define("PG_USER", "postgres");
	define("PG_PSWD", "123456");
	define("PG_PORT", "5432");
	
	$dbcon = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");


?>
