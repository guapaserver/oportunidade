<?php
class Pergunta_questao extends Executa
{
	private $id;
	private $corpo; 
	private $id_pergunta;
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
		,corpo
		,id_pergunta
		,data_modificacao
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_pergunta_questao 
		WHERE 
		1=1  
		";
		
		$q .= !empty($this->termo_busca) ? "AND nome LIKE '%".$this->termo_busca."%' " : " ";
		$q .= !empty($this->corpo) ? "AND corpo = '".$this->corpo."' " : " ";
		$q .= !empty($this->id_pergunta) ? "AND id_pergunta = '".$this->id_pergunta."' " : " ";
		$q .= !empty($this->data_modificacao) ? "AND data_modificacao = '".$this->data_modificacao."' " : " ";
		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY id DESC";
		$q .= !empty($this->limite) ? " LIMIT 0, ".$this->limite." " : " ";
//	echo $q;
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
	
	public function selecionar_pergunta_enquete()
	{
		$q = "				

		SELECT
		".$this->prefixo."_tbl_pergunta_questao.id 
		,".$this->prefixo."_tbl_pergunta_questao.corpo
		,".$this->prefixo."_tbl_pergunta_questao.id_pergunta
		,".$this->prefixo."_tbl_pergunta_questao.data_modificacao
		,".$this->prefixo."_tbl_resposta.quantidade_votos
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_pergunta_questao 
		
		LEFT JOIN ".$this->prefixo."_tbl_resposta
		ON ".$this->prefixo."_tbl_resposta.id_pergunta_questao = ".$this->prefixo."_tbl_pergunta_questao.id
		
		WHERE 
		1=1  
		";
	
		$q .= !empty($this->id_pergunta) ? "AND ".$this->prefixo."_tbl_pergunta_questao.id_pergunta = '".$this->id_pergunta."' " : " ";

		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY id DESC";
		$q .= !empty($this->limite) ? " LIMIT 0, ".$this->limite." " : " ";
	
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
	
	public function suma_pergunta_enquete()
	{
			$q = "				

		SELECT
			SUM(".$this->prefixo."_tbl_resposta.quantidade_votos) as suma_votos
		
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_pergunta_questao 
		
		LEFT JOIN ".$this->prefixo."_tbl_resposta
		ON ".$this->prefixo."_tbl_resposta.id_pergunta_questao = ".$this->prefixo."_tbl_pergunta_questao.id
		
		WHERE 
		1=1  
		";
	
		$q .= !empty($this->id_pergunta) ? "AND ".$this->prefixo."_tbl_pergunta_questao.id_pergunta = '".$this->id_pergunta."' " : " ";

		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY ".$this->prefixo."_tbl_pergunta_questao.id DESC";
		$q .= !empty($this->limite) ? " LIMIT 0, ".$this->limite." " : " ";
	
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
	
	public function selecionar2()
	{
		$q = "				

		SELECT
		".$this->prefixo."_tbl_pergunta_questao.id 
		,".$this->prefixo."_tbl_pergunta_questao.corpo
		,".$this->prefixo."_tbl_pergunta_questao.id_pergunta
		,".$this->prefixo."_tbl_pergunta_questao.data_modificacao
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_pergunta_questao 
		
		
		
		WHERE 
		1=1  
		";

		$q .= !empty($this->id_pergunta) ? "AND id_pergunta = '".$this->id_pergunta."' " : " ";
	
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
		
		INSERT INTO ".$this->prefixo."_tbl_pergunta_questao
		(
		
		corpo,
		id_pergunta,
		data_modificacao
		
		)
		VALUES 
		(
		
		'".$this->corpo."',
		'".$this->id_pergunta."',
		'".$this->data_modificacao."'	
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
		
		UPDATE ".$this->prefixo."_tbl_pergunta_questao SET 
		
		titulo = '".$this->titulo."',
		id_pergunta = '".$this->id_pergunta."',
		data_modificacao = '".$this->data_modificacao."'
		
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

		DELETE FROM ".$this->prefixo."_tbl_pergunta_questao WHERE id='".$this->id."'";
		
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
	
	public function excluir2()
	{
		$q = "				

		DELETE FROM ".$this->prefixo."_tbl_pergunta_questao WHERE id_pergunta='".$this->id_pergunta."'";
		
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
		
		SELECT LAST_INSERT_ID(id) AS id  FROM ".$this->prefixo."_tbl_pergunta_questao ORDER BY id DESC LIMIT 1
		
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