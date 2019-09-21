<?php
try{
	$dbhandler = new PDO('mysql:host=localhost;dbname=election','root','');
	#echo "Connection is established...<br/>";
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	
}
catch(PDOException $e){
	echo $e->getMessage();
	die();
}

?>
