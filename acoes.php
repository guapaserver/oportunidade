<?php
switch($_REQUEST["acao_adm"])
{
	case 'enquete':
		require("componentes/enquete.php");
	break;
	
	case 'galeria_virtual':
		require("componentes/galeria.php");
	break;
	
	case 'oportunidades':
		require("componentes/oportunidade.php");
	break;
	
	case 'correspondentes':
		require("componentes/correspondentes.php");
	break;
	
	case 'noticias':
		require("componentes/noticias.php");
	break;

	case 'materia':
	case 'interna':
		require("componentes/interna.php");
	break;
	
	case 'pagina':
		require("componentes/pagina.php");
	break;
	
	case 'projeto':
	case 'o_projeto':
		require("componentes/projeto.php");
	break;
	
	case 'apoiadores':
		require("componentes/apoiadores.php");
	break;

	case 'contato':
		require("componentes/contato.php");
	break;
	
	case 'login':
		require("componentes/login.php");
	break;

	case 'fale_conosco':
		require("componentes/contato.php");
	break;
	
	default:
		require("componentes/home.php");
	break;
}
?>