<?php
namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model
{
	const SESSION = "User";

	public static function login($login,$password)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM TB_USERS WHERE DESLOGIN = :LOGIN", array(":LOGIN"=>$login));
		if (count($results) === 0)
		{
			throw new \Exception("Usuário inexistente.");
			// barra invertida usada para invocar o exception da classe principal
		}
		//$data receberá o retorno da consulta
		$data = $results[0];

		if(password_verify($password, $data["despassword"]) === true ) 
		{
			$user = new User();
			
			//$user->setiduser($data["iduser"]);
			
			$user->setData($data);

			//var_dump($user);
			//exit;

			$_SESSION[User::SESSION] = $user->getValues();//:: são constantes

			return $user;

		
		}
		else
		{
			throw new \Exception("Senha inválida.");
		}
	}

	public static function verifyLogin($inadmin = true)
	{
		if(
			!isset($_SESSION[User::SESSION]) //verifica se a sessão estã definida/ existe
			|| 
			!$_SESSION[User::SESSION] //verifica se a sessão está valida
			|| 
			!(int)$_SESSION[User::SESSION]["iduser"] > 0 //verifica se o ID do usuário é válido, é um usuário
			|| 
			(bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin//verifica se o usuário fez login na parde de administração
			)
			{
				header("Location: /admin/login");
				exit;
			}
	}

	//destruir a sessão : deslogar
	public static function logout()
	{
		$_SESSION[User::SESSION] = NULL;
	}


}
?>