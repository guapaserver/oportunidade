<?php
class Resposta extends Executa
{
	private $id;
	private $quantidade_votos;
	private $id_pergunta_questao;
	private $data_modificacao;
	
	private $limite;
	private $ordenador;
	private $termo_busca;
	private $criterio_sql;
	private $not_in;

	private $DESC_ASC;
	
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
		,quantidade_votos 
		,data_modificacao
		,id_pergunta_questao
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_resposta 
		WHERE 
		1=1  
		";
		
		$q .= !empty($this->termo_busca) ? "AND nome LIKE '%".$this->termo_busca."%' " : " ";
		$q .= !empty($this->quantidade_votos) ? "AND quantidade_votos = '".$this->quantidade_votos."' " : " ";
		$q .= !empty($this->id_pergunta_questao) ? "AND id_pergunta_questao = '".$this->id_pergunta_questao."' " : " ";
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
	
	public function selecionar_enquete_complemento()
	{
		$q = "

		SELECT DISTINCT 
		".$this->prefixo."_tbl_resposta.id 
		,".$this->prefixo."_tbl_resposta.quantidade_votos 
		,".$this->prefixo."_tbl_resposta.id_pergunta_questao
	
		,DATE_FORMAT (".$this->prefixo."_tbl_resposta.data_modificacao, '%d/%m/%Y') as data_tratada
		";

		$q .= "FROM ".$this->prefixo."_tbl_resposta 

		WHERE 
		1=1  
		";

		$q .= !empty($this->quantidade_votos) ? "AND ".$this->prefixo."_tbl_resposta.quantidade_votos = '".$this->quantidade_votos."' " : " ";
		$q .= !empty($this->corpo) ? "AND corpo = '".$this->corpo."' " : " ";
		$q .= !empty($this->id) ? "AND ".$this->prefixo."_tbl_resposta.id = '".$this->id."' " : " ";
		$q .= !empty($this->id_pergunta_questao) ? "AND ".$this->prefixo."_tbl_resposta.id_pergunta_questao = '".$this->id_pergunta_questao."' " : " ";

		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador." ".$this->DESC_ASC."" : " ORDER BY id DESC ";
		empty($this->limite_inicio) ? $limite_inicio_02 = "0" : $limite_inicio_02 = $this->limite_inicio;
		$q .= !empty($this->limite) ? " LIMIT ".$limite_inicio_02.", ".$this->limite." " : " ";

		//echo "<pre>".$q."</pre>";
		//die($q);
		//echo $q;
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
		
		INSERT INTO ".$this->prefixo."_tbl_resposta
		(
		
		quantidade_votos,
		data_modificacao,
		id_pergunta_questao
		
		)
		VALUES 
		(
		
		'".$this->quantidade_votos."',
		'".$this->data_modificacao."',
		'".$this->id_pergunta_questao."'		
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
		
		UPDATE ".$this->prefixo."_tbl_resposta SET 
		
		quantidade_votos = '".$this->quantidade_votos."', 
		data_modificacao = '".$this->data_modificacao."',
		id_pergunta_questao = '".$this->id_pergunta_questao."'
		
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

		DELETE FROM ".$this->prefixo."_tbl_resposta WHERE id='".$this->id."'";
		
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
		
		SELECT LAST_INSERT_ID(id) AS id  FROM ".$this->prefixo."_tbl_resposta ORDER BY id DESC LIMIT 1
		
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