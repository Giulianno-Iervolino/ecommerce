<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	/*echo "Carregado com suceso";*/
	$sql = new Hcode\DB\Sql();
	$results = $sql->select("SELECT * FROM TB_USERS");
	echo json_encode($results);


});

$app->run();

 ?>