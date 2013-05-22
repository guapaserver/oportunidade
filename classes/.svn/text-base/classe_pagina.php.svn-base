<?php

class Pagina extends Executa
{
	private $id;
	private $idioma; 
	private $nome; 
	private $estado;
	private $corpo;
	private $formatacao;
	private $olho;
	private $data;
	private $chamado;
	private $id_pagina_tipo;
	private $id_pagina_estilo;

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
		".$this->prefixo."_tbl_pagina.id 
		,".$this->prefixo."_tbl_pagina.idioma 
		,".$this->prefixo."_tbl_pagina.ordem 
		,".$this->prefixo."_tbl_pagina.nome 
		,".$this->prefixo."_tbl_pagina.estado
		,".$this->prefixo."_tbl_pagina.corpo
		,".$this->prefixo."_tbl_pagina.formatacao
		,".$this->prefixo."_tbl_pagina.olho
		,".$this->prefixo."_tbl_pagina.chamado
		,".$this->prefixo."_tbl_pagina.id_pagina_tipo
		,".$this->prefixo."_tbl_pagina.id_pagina_estilo
		
		";

		$q .= !empty($this->busca) ? ",(SELECT id FROM ".$this->prefixo."_tbl_linkador WHERE link_id = concat('index.php?acao=paginas&pagina_id=',".$this->prefixo."_tbl_pagina.id) limit 0, 1) as n_id" : " ";
		$q .= !empty($this->busca) ? ",(SELECT nome FROM ".$this->prefixo."_tbl_linkador WHERE link_id = concat('index.php?acao=paginas&pagina_id=',".$this->prefixo."_tbl_pagina.id) limit 0, 1) as n_nome" : " ";
		$q .= !empty($this->busca) ? ",(SELECT id FROM ".$this->prefixo."_tbl_botao where id = n_id  limit 0, 1 )as b_id" : " ";
		
		$q .= !empty($this->busca) ? ",(SELECT id FROM ".$this->prefixo."_tbl_linkador_link WHERE link = 'index.php?acao=paginas&pagina_id='".$this->prefixo."_tbl_pagina.id) limit 0, 1) as link_id" : " ";
		
		$q .= "FROM ".$this->prefixo."_tbl_pagina 
		WHERE 
		1=1  
		";

		$q .= !empty($this->termo_busca) ? "AND (nome LIKE '%".$this->termo_busca."%' OR corpo LIKE '%".$this->termo_busca."%') " : " ";
		$q .= !empty($this->nome) ? "AND nome = '".$this->nome."' " : " ";
		$q .= !empty($this->idioma) ? "AND idioma = '".$this->idioma."' " : " ";
		$q .= !empty($this->id) ? "AND id = '".$this->id."' " : " ";
		$q .= !empty($this->id_pagina_tipo) ? "AND id_pagina_tipo = '".$this->id_pagina_tipo."' " : " ";
		$q .= !empty($this->estado) ? "AND estado = '".$this->estado."' " : " ";
		$q .= !empty($this->chamado) ? "AND chamado = '".$this->chamado."' " : " ";
 		$q .= !empty($this->corpo) ? "AND corpo = '".$this->corpo."' " : " ";
		$q .= !empty($this->acesso_pag) ? "AND acesso_pag = '".$this->acesso_pag."' " : " ";
		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY id DESC ";
		
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
	
	public function selecionar_02()
	{
		$q = "				

		SELECT
		".$this->prefixo."_tbl_pagina.id
		,".$this->prefixo."_tbl_pagina.nome
		,".$this->prefixo."_tbl_pagina.corpo
		,".$this->prefixo."_tbl_pagina.ordem
		,".$this->prefixo."_tbl_pagina.formatacao
		,".$this->prefixo."_tbl_pagina.estado
		,".$this->prefixo."_tbl_pagina.olho
		,".$this->prefixo."_tbl_pagina.idioma
		,".$this->prefixo."_tbl_pagina.chamado
		";

		$link_tratado = "index.php?acao=paginas&pagina_id=".$this->prefixo."_tbl_pagina.id";
		
		$q .= !empty($this->busca) ?",(SELECT id FROM ".$this->prefixo."_tbl_linkador_link WHERE link =".$link_tratado." limit 0, 1) as link_id" : " ";

		$q .= "FROM ".$this->prefixo."_tbl_pagina 
		WHERE 
		1=1  
		";

		$q .= !empty($this->termo_busca) ? "AND (nome LIKE '%".$this->termo_busca."%' OR corpo LIKE '%".$this->termo_busca."%') " : " ";
		$q .= !empty($this->nome) ? "AND nome = '".$this->nome."' " : " ";
		$q .= !empty($this->corpo) ? "AND corpo = '".$this->corpo."' " : " ";
		$q .= !empty($this->idioma) ? "AND idioma = '".$this->idioma."' " : " ";
		$q .= !empty($this->id) ? "AND id = '".$this->id."' " : " ";
		$q .= !empty($this->estado) ? "AND estado = '".$this->estado."' " : " ";
		$q .= !empty($this->chamado) ? "AND chamado = '".$this->chamado."' " : " ";
		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY id DESC ";
		
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
	
	public function selecionar_03()
	{
		$q = "

		SELECT
		".$this->prefixo."_tbl_pagina.id 
		,".$this->prefixo."_tbl_pagina.idioma 
		,".$this->prefixo."_tbl_pagina.ordem 
		,".$this->prefixo."_tbl_pagina.nome 
		,".$this->prefixo."_tbl_pagina.estado
		,".$this->prefixo."_tbl_pagina.corpo
		,".$this->prefixo."_tbl_pagina.formatacao
		,".$this->prefixo."_tbl_pagina.olho
		,".$this->prefixo."_tbl_pagina.chamado
		,".$this->prefixo."_tbl_pagina.id_pagina_tipo
		,".$this->prefixo."_tbl_pagina.id_pagina_estilo
		,".$this->prefixo."_tbl_pagina_estilo.imagem as estilo_imagem
		
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_pagina
		
		INNER  JOIN ".$this->prefixo."_tbl_pagina_estilo
		ON ".$this->prefixo."_tbl_pagina_estilo.id = ".$this->prefixo."_tbl_pagina.id_pagina_estilo
		
		WHERE 
		1=1  
		";

		$q .= !empty($this->termo_busca) ? "AND (nome LIKE '%".$this->termo_busca."%' OR corpo LIKE '%".$this->termo_busca."%') " : " ";
		$q .= !empty($this->nome) ? "AND nome = '".$this->nome."' " : " ";
		$q .= !empty($this->idioma) ? "AND idioma = '".$this->idioma."' " : " ";
		$q .= !empty($this->id) ? "AND id = '".$this->id."' " : " ";
		$q .= !empty($this->id_pagina_tipo) ? "AND id_pagina_tipo = '".$this->id_pagina_tipo."' " : " ";
		$q .= !empty($this->estado) ? "AND estado = '".$this->estado."' " : " ";
		$q .= !empty($this->chamado) ? "AND chamado = '".$this->chamado."' " : " ";
 		$q .= !empty($this->corpo) ? "AND corpo = '".$this->corpo."' " : " ";
		$q .= !empty($this->acesso_pag) ? "AND acesso_pag = '".$this->acesso_pag."' " : " ";
		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY id DESC ";
		
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
		
		INSERT INTO ".$this->prefixo."_tbl_pagina
		(
		
		nome,
		corpo,
		data,
		formatacao,
		ordem,
		olho,
		estado,
		idioma,
		id_pagina_tipo,
		id_pagina_estilo
		
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
		'".$this->idioma."',
		'".$this->id_pagina_tipo."',
		'".$this->id_pagina_estilo."'
		
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
		
		UPDATE ".$this->prefixo."_tbl_pagina SET 
		
		nome = '".$this->nome."', 
		corpo = '".$this->corpo."', 
		formatacao = '".$this->formatacao."', 
		ordem = '".$this->ordem."', 
		olho = '".$this->olho."',
		idioma = '".$this->idioma."',
		estado = '".$this->estado."',
		data = '".$this->data."',
		id_pagina_tipo = '".$this->id_pagina_tipo."',
		id_pagina_estilo = '".$this->id_pagina_estilo."'


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
	
	public function editar_chamado()
	{
		$q = "
		
		UPDATE ".$this->prefixo."_tbl_pagina SET 
		
		chamado = '".$this->chamado."'
		
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

		DELETE FROM ".$this->prefixo."_tbl_pagina WHERE id='".$this->id."'";
		
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
		
		SELECT LAST_INSERT_ID(id) AS id  FROM ".$this->prefixo."_tbl_pagina ORDER BY id DESC LIMIT 1
		
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