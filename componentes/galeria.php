<?php
ob_start(); 
session_name("user");
session_start("user");

	$o_ilustra = new Ilustra;
	$o_ajudante = new Ajudante;
	$o_configuracao = new Configuracao;

	$url_fisico = $o_configuracao->url_fisico();
	$url_virtual = $o_configuracao->url_virtual();

	$o_monta_produto = new Monta_produto;
	$o_monta_produto->set('limite_inicio', 0);
	$o_monta_produto->set('limite', 5);
	$o_monta_produto->set('estado','a');
	$o_monta_produto->set('ordenador','ordem, data desc');
	$o_monta_produto->set('acesso', $_SESSION["acesso"]);
	$servico_lista = $o_monta_produto->monta_lista_galeria();
	
	//inicializa o template para administrar as p�ginas
	$template = $o_ajudante->template("".$url_fisico."templates/galeria.html");

	//troca as vari�veis
	$descricao = $servico_lista;
	
	if($_SESSION["acesso"] == "sim")
	{
		switch($_REQUEST['acao'])
		{
			case 'formulario':
				
				$fancy = "$(document).ready(function (){fancy_function('".$url_virtual."componentes/popup_galeria.php',700,675,'iframe')});";
				
			break;
		}
	}

	$array = array(
		"[descricao]" => $descricao
		,"[fancy]" => $fancy
		,"[url_virtual]" => $url_virtual
	);

	 $conteudo = strtr($template,$array);
	unset($array);

	//seleciona o nome da imagem
	$o_imagem = new Imagem;
	$o_imagem->set('id_album',$id_album);
	$o_imagem->set('limite',1);
	if($res_imagem = $o_imagem->selecionar())
	{
		foreach($res_imagem as $l_imagem)
		{
			$nome_imagem = $l_imagem['nome'];
		}
	}
	unset($o_imagem);
	//unset($o_ilustra);

	$image_face_fb = $url_virtual."imagens/galeria/".$nome_imagem;

	$title_face_fb = $pagina_titulo;
	$url_face_fb = $url_virtual."pagina/".$_REQUEST['id'];
	$description_face_fb = "";
	$image_face_fb = $image_face_fb;
	
	$corpo_html = $conteudo;

	unset($o_configuracao);
	unset($o_ajudante);
?>