<?php
namespace Hcode;

class Model
{
	private $values = [];

	public function __call($name,$args)//erro de digitação causou transtorno :: call escrito com somente um underline
	{
		$method = substr($name,0,3);
		$fieldName = substr($name, 3,strlen($name));

		//var_dump($method, $fieldName);
		//exit;

		switch($method)
		{
			case "get":
				return $this->values[$fieldName];
			break;
			case "set":
				$this->values[$fieldName] = $args[0];// 0 é o primeiro item
			break;
		}

	}//fim call

	public function setData($data = array())
	{
		foreach ($data as $key => $value) 
		{
			$this->{"set".$key}($value);//chamar metodos automaticamente
		}
	}

	public function getValues()
	{
		return $this->values;
	}
}
?>