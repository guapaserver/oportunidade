<?php
class Apoiadores extends Executa
{
	private $id;
	private $titu;
	private $logo;
	private $data_modificacao;
	
	private $limite;
	private $ordenador;
	private $termo_busca;
	private $criterio_sql;
	
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
		id 
		,titulo 
		,data_modificacao
		,logo
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_apoiadores 
		WHERE 
		1=1  
		";
		
		$q .= !empty($this->termo_busca) ? "AND nome LIKE '%".$this->termo_busca."%' " : " ";
		$q .= !empty($this->titulo) ? "AND titulo = '".$this->titulo."' " : " ";
		$q .= !empty($this->logo) ? "AND logo = '".$this->logo."' " : " ";
		$q .= !empty($this->data_modificacao) ? "AND data_modificacao = '".$this->data_modificacao."' " : " ";
		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY id DESC";
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
		
		INSERT INTO ".$this->prefixo."_tbl_apoiadores
		(
		
		titulo,
		data_modificacao,
		logo
		
		)
		VALUES 
		(
		
		'".$this->titulo."',
		'".$this->data_modificacao."',
		'".$this->logo."'		
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
		
		UPDATE ".$this->prefixo."_tbl_apoiadores SET 
		
		titulo = '".$this->titulo."', 
		data_modificacao = '".$this->data_modificacao."',
		logo = '".$this->logo."'
		
		WHERE id='".$this->id."'
		
		";

		$this->sql = $q;
		$stmt = $this->executar();
		//die($q);
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

		DELETE FROM ".$this->prefixo."_tbl_apoiadores WHERE id='".$this->id."'";
		
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
		
		SELECT LAST_INSERT_ID(id) AS id  FROM ".$this->prefixo."_tbl_apoiadores ORDER BY id DESC LIMIT 1
		
		";
		
		//Envia a string de consulta
		parent::set("sql",$q);
		
		//verifica se houve um retorno maior que 0
		if(parent::query()->rowCount() > 0)
		{
			return parent::query();
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