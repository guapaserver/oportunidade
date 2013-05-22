<?php
	ob_start(); 
	session_name("user");
	session_start("user");

	ini_set('display_errors', E_ALL);

	header("Content-Type: text/html; charset=ISO-8859-1");
	setlocale(LC_CTYPE,"pt_BR");

	include ("../inc/includes.php");

	$o_configuracao = new Configuracao;

	$url_virtual = $o_configuracao->url_virtual();
	$url_fisico = $o_configuracao->url_fisico();

	$o_css = new Css;
	$o_css->set('id', '1');
	if($rs = $o_css->selecionar())
	{
		foreach($rs as $l)
		{
			$corpo = $l['corpo'];
		}
	}

/* BODY */
	if($l['bg_body_img'] == "NULL" || trim($l['bg_body_img']) == "")
	{
		$background_body = " background:  ".$l['bg_body'].";";
	}
	else
	{	
		$background_body = " background:  ".$l['bg_body']." url(../../imagens/site_gc/".$l['bg_body_img'].");";
	}
	
	$background_destaque = " background:  ".$l['bg_destaque']." ;";
	
	if($l['destaque_sombra'] == 's')
	{
		$img_sombra_01 = " background-image: url(../../imagens/site/sombra_01.png);";
		$img_sombra_02 = " background-image: url(../../imagens/site/sombra_02.png);";
		$img_sombra_03 = " background-image: url(../../imagens/site/sombra_03.png);";
		$img_sombra_04 = " background-image: url(../../imagens/site/sombra_04.png);";
	}
	else
	{
		$img_sombra_01 = "";
		$img_sombra_02 = "";
		$img_sombra_03 = "";
		$img_sombra_04 = "";
	}
	
	if($l['radio_borda'] == "NULL" || trim($l['radio_borda']) == "")
	{
		$radio_borda = "5";
	}
	else
	{
		$radio_borda = $l['radio_borda'];
	}
	
	if($l['destaque_borda'] == 's')
	{
		$destaque_borda = " 	
			border-radius:".$radio_borda."px; 
			-moz-border-radius:".$radio_borda."px; /* Firefox */ 
			-webkit-border-radius:".$radio_borda."px; /* Safari y Chrome */ 
			
			-moz-box-shadow: #fff 0px 6px 1px;
			";
			
			/*-webkit-border-radius: 8px;
			-moz-border-radius: 8px;
			border-radius: 8px;
			-webkit-box-shadow: #666 0px 6px 1px;
			-moz-box-shadow: #666 0px 6px 1px;*/

	}
	else
	{
		$destaque_borda = "";
	}
	
	$tamanho_borda_destaque = " padding: ".$l['tamanho_borda_destaque']."px;";
/* FIM BODY */


/* MENU TOPO */
	$altura_menu_topo = " height: ".$l['altura_menu_topo']."px;";

	if($l['bg_menu_topo_img'] == "NULL" || trim($l['bg_menu_topo_img']) == "")
	{
		
		$background_menu_topo = " background:  ".$l['bg_menu_topo'].";";
	}
	else
	{	
		$background_menu_topo = " background:  ".$l['bg_menu_topo']." url(../../imagens/site_gc/".$l['bg_menu_topo_img'].");";
	}
/* FIM MENU TOPO */

/* BANNER */
	$l_i = getimagesize("".$url_virtual."imagens/site_gc/".$l['logo']."");
	//$altura_banner = $l_i[1] + 32 + 39 + 5;
	$altura_banner = 220;
	$altura_banner = " min-height:".$altura_banner."px; max-height:".$altura_banner."px;";
//die($l['bg_banner_img']);
	if($l['bg_banner_img'] == "NULL" || trim($l['bg_banner_img']) == "")
	{
		
		$background_banner = " background:  ".$l['bg_banner'].";";
	}
	else
	{	
		$background_banner = " background:  ".$l['bg_banner']." url(../../imagens/site_gc/".$l['bg_banner_img'].");";
	}
/* FIM BANNER */

/* LOGO */
	$altura_div_logo = $l_i[1] + 32;
	$altura_div_logo = " height:".$altura_div_logo."px;";

	if($l['logo_float'] == 'e')
	{
		$float_logo = " margin-left:25px;  	float:left;";
	}
	elseif($l['logo_float'] == 'c')
	{
		$float_logo = "
			left:50%;
			margin-left:-141px;	
			position:relative;";
	}
	else
	{
		$float_logo = " float:right; ";
	}
/* FIM LOGO */

/* HR */
	$background_hr = " border-top: 1px solid ".$l['bg_linha_menu'].";";
/* FIM HR */

/* BANNER BASE */
	$altura_base_banner = " min-height:".$l['altura_linha_divisoria']."px;";
	if($l['bg_linha_divisoria_img'] == "NULL" || trim($l['bg_linha_divisoria_img']) == "")
	{
		
		$background_base_banner = " background:  ".$l['bg_linha_divisoria'].";";
	}
	else
	{	
		$background_base_banner = " background:  ".$l['bg_linha_divisoria']." url(../../imagens/site/".$l['bg_linha_divisoria_img'].");";
	}
/* FIM BANNER BASE */

$conteudo = $corpo;

$lista = array(
	"[background_body]" => $background_body,
	"[background_destaque]" => $background_destaque,
	"[img_sombra_01]" => $img_sombra_01,
	"[img_sombra_02]" => $img_sombra_02,
	"[img_sombra_03]" => $img_sombra_03,
	"[img_sombra_04]" => $img_sombra_04,
	"[tamanho_borda_destaque]" => $tamanho_borda_destaque,
	"[destaque_borda]" => $destaque_borda,
	"[altura_menu_topo]" => $altura_menu_topo,
	"[background_menu_topo]" => $background_menu_topo,
	"[altura_banner]" => $altura_banner,
	"[background_banner]" => $background_banner,
	"[altura_div_logo]" => $altura_div_logo,
	"[float_logo]" => $float_logo,
	"[background_hr]" => $background_hr,
	"[altura_base_banner]" => $altura_base_banner,
	"[background_base_banner]" => $background_base_banner,
);	

$texto = strtr($conteudo,$lista);

// Cria o arquivo 
file_put_contents("".$url_fisico."/inc/css/formatacao_test.css", $texto);

// Abre o arquivo
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("".$url_fisico."/inc/css/formatacao_test.css", "a");

// Escreve "exemplo de escrita" no bloco1.txt
$escreve = fwrite($fp, "");

// Fecha o arquivo
fclose($fp);

echo "sucesso";

unset($o_css);
?>