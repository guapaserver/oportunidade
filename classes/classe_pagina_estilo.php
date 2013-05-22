<?php

class Pagina_estilo extends Executa
{
	private $id;
	private $nome;
	private $imagem; 

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
		".$this->prefixo."_tbl_pagina_estilo.id 
		,".$this->prefixo."_tbl_pagina_estilo.nome
		,".$this->prefixo."_tbl_pagina_estilo.imagem
		";

		$q .= "FROM ".$this->prefixo."_tbl_pagina_estilo 
		WHERE 
		1=1  
		";

		$q .= !empty($this->termo_busca) ? "AND (nome LIKE '%".$this->termo_busca."%' OR corpo LIKE '%".$this->termo_busca."%') " : " ";
		$q .= !empty($this->nome) ? "AND nome = '".$this->nome."' " : " ";
		
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
		
		INSERT INTO ".$this->prefixo."_tbl_pagina_estilo
		(
		
		nome,
		imagem
		
		)
		VALUES 
		(
		
		'".$this->nome."',
		'".$this->imagem."'
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
		
		UPDATE ".$this->prefixo."_tbl_pagina_estilo SET 
		
		nome = '".$this->nome."',
		imagem = '".$this->imagem."'

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

		DELETE FROM ".$this->prefixo."_tbl_pagina_estilo WHERE id='".$this->id."'";
		
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
		
		SELECT LAST_INSERT_ID(id) AS id  FROM ".$this->prefixo."_tbl_pagina_estilo ORDER BY id DESC LIMIT 1
		
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