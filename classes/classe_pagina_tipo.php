<?php

class Pagina_tipo extends Executa
{
	private $id;
	private $tipo; 

	private $limite;
	private $ordenador;
	private $termo_busca;

	private $busca;
	private $q;
	private $prefixo;

	function __construct()
	{
		parent::__construct();
		$this->prefixo = $this->prefixo();
	}
	
	public function selecionar()
	{
		$q = "

		SELECT
		".$this->prefixo."_tbl_pagina_tipo.id 
		,".$this->prefixo."_tbl_pagina_tipo.tipo
		";

		$q .= "FROM ".$this->prefixo."_tbl_pagina_tipo 
		WHERE 
		1=1  
		";

		$q .= !empty($this->termo_busca) ? "AND (nome LIKE '%".$this->termo_busca."%' OR corpo LIKE '%".$this->termo_busca."%') " : " ";
		$q .= !empty($this->tipo) ? "AND tipo = '".$this->tipo."' " : " ";
		
		$q .= !empty($this->limite) ? " LIMIT 0, ".$this->limite." " : " ";

		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}
	
	

	public function inserir()
	{
		$q = "
		
		INSERT INTO ".$this->prefixo."_tbl_pagina_tipo
		(
		
		nome,
		corpo,
		data,
		formatacao,
		ordem,
		olho,
		estado,
		idioma
		
		)
		VALUES 
		(
		
		'".$this->nome."',
		'".$this->corpo."',
		'".$this->data."',
		'".$this->formatacao."',
		'".$this->ordem."',
		'".$this->olho."',
		'".$this->estado."',
		'".$this->idioma."'
		)";

		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	
	}
	
	public function editar()
	{
		$q = "
		
		UPDATE ".$this->prefixo."_tbl_pagina_tipo SET 
		
		tipo = '".$this->tipo."'

		WHERE id='".$this->id."'
		
		";
		//die($q);
		$this->sql = $q;
		$stmt = $this->executar();

		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	
	}

	
	public function excluir()
	{
		$q = "				

		DELETE FROM ".$this->prefixo."_tbl_pagina_tipo WHERE id='".$this->id."'";
		
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	
	}
	
	public function ultimo_id()
	{
		$q = "
		
		SELECT LAST_INSERT_ID(id) AS id  FROM ".$this->prefixo."_tbl_pagina_tipo ORDER BY id DESC LIMIT 1
		
		";

		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}
	
	
	function set($prop, $value)
	{
      $this->$prop = $value;
	}
}

?>