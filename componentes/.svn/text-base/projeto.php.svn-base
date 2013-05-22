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
	
	/*Monta pagina projeto*/
	/*$o_pagina = new Pagina;
	$o_pagina->set('id_pagina_tipo', 1);
	if($rs = $o_pagina->selecionar_03())
	{
		foreach($rs as $linha)
		{*/
			$servico_lista .= "<img src='".$url_virtual."imagens/site/projeto.png' /> <br>";
			
		//}
		
	//}
	
	/*Monta pagina projeto*/

	//inicializa o template para administrar as páginas
	$template = $o_ajudante->template("".$url_fisico."templates/projeto.html");

	//troca as variáveis
	$array = array(
		"[lista]" => $servico_lista
	);

	$conteudo = strtr($template,$array);
	unset($array);
	
	$corpo_html = $conteudo;

	unset($o_configuracao);
	unset($o_ajudante);
?>