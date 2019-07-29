<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() //seleciona a rota
{
    
	$page = new Page();
	$page->setTpl('index');//carrega conteudo


});
//--administracao
$app->config('debug', true);

$app->get('/admin', function() //seleciona a rota
{
    
	$page = new PageAdmin();
	$page->setTpl('index');//carrega conteudo


});


$app->run();//roda tudo 

 ?>