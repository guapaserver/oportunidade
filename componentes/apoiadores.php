<?php
	ob_start(); 
	session_name("user");
	session_start("user");
	ini_set('display_errors', E_ALL);

	if(!$_SESSION["idioma"])
	{
		$_SESSION["idioma"] = "br";
	}

	include ("inc/includes.php");

	$o_ilustra = new Ilustra;
	$o_ajudante = new Ajudante;
	$o_configuracao = new Configuracao;

	$url_fisico = $o_configuracao->url_fisico();
	$url_virtual = $o_configuracao->url_virtual();
	
	$o_apoiadores = new Apoiadores;
	if($rs = $o_apoiadores->selecionar())
	{
		foreach($rs As $l)
		{
			$lista .= '<div class="element   box col4   masonry-brick" style="position: relative; top: 0px; width: 200px; height: 200px;">
		<div class="element_contenedor2 ">';
		
			$lista .= "<img src=\"".$url_virtual."utilitarios/thumbnail.php?largura=200&amp;img=../imagens/galeria/".$l['logo']."\" title=\"".$l['logo']."\" alt=\"".$l['titulo']."\">";
			
			$lista .= '</div> </div>';
		}
		
	}

	//inicializa o template para administrar as páginas
	$template = $o_ajudante->template("".$url_fisico."templates/apoiadores.html");

	//troca as variáveis
	$array = array(
		"[lista]" => $lista,
		"[url_virtual]" => $url_virtual
	);

	$conteudo = strtr($template,$array);
	unset($array);
	
	$corpo_html = $conteudo;

	unset($o_configuracao);
	unset($o_ajudante);
?>