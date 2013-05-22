<?php
ob_start(); 
session_name("user");
session_start("user");

ini_set('display_errors', E_ALL);

header("Content-Type: text/html; charset=ISO-8859-1");
setlocale(LC_CTYPE,"pt_BR");

include ("../inc/includes.php");

$mostrar_div = 5;
$limite_inicio_ajax = ($_GET['limite_01']*$mostrar_div)-$mostrar_div;

switch($_REQUEST['acao_adm'])
{
	case 'produtos':
		$o_monta_produto = new Monta_produto;
		$o_monta_produto->set('limite_inicio', $limite_inicio_ajax);
		$o_monta_produto->set('limite', $mostrar_div);
		$o_monta_produto->set('estado','a');
		$o_monta_produto->set('ordenador','ordem, data desc');
		
		switch($_REQUEST['produto_tipo'])
		{
			case 'home':
				
				$o_monta_produto->set('home', '1');
				if($servico_lista = $o_monta_produto->lista())
				{
					
					echo $servico_lista;
				
				}
				else
				{
					echo "sem_registros";

				}
			//	$filtro = $
				echo "<script>
				var value = $('#nome_filtro').val(); 
				filtro_menu(value);
				</script>";
			break;	
			
			case 'noticias':
				$o_monta_produto->set('id_produto_tipo', '1');
				if($servico_lista = $o_monta_produto->monta_lista_noticias())
				{
					
					echo $servico_lista;
				
				}
				else
				{
					echo "sem_registros";
				}
			break;	
			
			case 'oportunidade':
				$o_monta_produto->set('id_produto_tipo', '2');
				if($servico_lista = $o_monta_produto->monta_lista_oportunidade())
				{
					
					echo $servico_lista;
				
				}
				else
				{
					echo "sem_registros";
				}
				
			break;	
			
			case 'galeria_virtual':
				$o_monta_produto->set('id_produto_tipo', '3');
			break;


		}
		
		unset($o_monta_produto);
		
	break;
	
	case 'correspondentes':
		$o_monta_produto = new Monta_produto;
		$o_monta_produto->set('limite_inicio', $limite_inicio_ajax);
		$o_monta_produto->set('limite', $mostrar_div);
		$o_monta_produto->set('estado','a');
		$o_monta_produto->set('ordenador','ordem, data_hora desc');
		$o_monta_produto->set('id_produto_tipo', '2');
		if($servico_lista = $o_monta_produto->monta_lista_correspondentes())
		{
			
			echo $servico_lista;
		
		}
		else
		{
			echo "sem_registros";
		}
	break;
	
	case 'enquete':
		$o_monta_produto = new Monta_produto;
		$o_monta_produto->set('limite_inicio', $limite_inicio_ajax);
		$o_monta_produto->set('limite', $mostrar_div);
		$o_monta_produto->set('estado','a');
		$o_monta_produto->set('ordenador','ordem, data_hora desc');
		$o_monta_produto->set('id_produto_tipo', '2');
		if($servico_lista = $o_monta_produto->monta_lista_enquete())
		{
			
			echo $servico_lista;
		
		}
		else
		{
			echo "sem_registros";
		}
	break;
}




	



?>