<?php 
//arquivo de rotas
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() //seleciona a rota
{
	$page = new Page();

	$page->setTpl("index");//carrega conteudo
});
//--administracao
$app->get('/admin', function() //seleciona a rota
 { 
    User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("index");//carrega conteudo
});

$app->get('/admin/login', function()
{	
	$page = new PageAdmin(["header"=>false,"footer"=>false]);//desabilitar o cabeçaclho e o rodapé
	$page->setTpl("login");//carrega o conteudo
});

//rota post pra receber os dados do formulário do login
$app->post('/admin/login', function(){
		User::login($_POST["login"],$_POST["password"]);
		header("Location: /admin");//redirecionar
		exit;
	}
);

//chamar o logout:
$app->get('/admin/logout',function()
{
	User::logout();
	header("Location: /admin/login");//redireciona para o login
	exit; //não faz mais nada
}
);

$app->run();//roda tudo 

 ?>