

<?php

//header ('Content-type: text/html; charset=iso-8859-1');
//ob_start();
//session_name("user");
//session_start("user");

require_once("../inc/includes.php");
$o_ajudante = new Ajudante;

switch ($_REQUEST['acao_adm'])
{
	case 'upload_imagens':
		switch ($_REQUEST['acao'])
		{
			case 'lista':
				if($_REQUEST['parametro'] != "")
				{
					$o_monta_site = new Monta_site;
					
					$click = "";
					if($_REQUEST['parametro'] == "album_01")
					{
						$id_album = $_REQUEST['id_album'];
					}
										
					if($id_album > 0)
					{
						$o_monta_site->set('id_album', $id_album);
						$o_monta_site->set('x', 80);
						$o_monta_site->set('y', 80);
						$o_monta_site->set('click', '15');
						$o_monta_site->set('pasta', 'produtos');
						$o_monta_site->set('div_imagem', "".$_REQUEST['_div']."");
						$o_monta_site->set('ordenador', "nome asc");
						$texto = $o_monta_site->ilustra_imagem();
					}
					else
					{
						$texto = "nao tem album";
					}
					
					echo $texto;
					unset($o_monta_site);
				}
				else
				{
					echo "";
				}
			break;
			
		}
		
	break;
	
	case 'lista_fotos':
		switch ($_REQUEST['acao'])
		{
			case 'excluir':
				$o_monta_site = new Monta_site;
				
				$o_imagem = new Imagem;
				$o_imagem->set('id', $_REQUEST['parametro']);
				if($rs = $o_imagem->selecionar())
				{
					foreach($rs as $l)
					{
					}
				}
				if(file_exists("../imagens/produtos/".$l["nome"]))
				{
					unlink("../imagens/produtos/".$l['nome']);
				}

				$o_imagem->excluir();
				
				$o_monta_site->set('id_album', $_REQUEST['_id_album']);
				$o_monta_site->set('x', 80);
				$o_monta_site->set('y', 80);
				$o_monta_site->set('click', 15);
				$o_monta_site->set('pasta', 'produtos');
				$o_monta_site->set('div_imagem', "".$_REQUEST['_div']."");
				$o_monta_site->set('ordenador', "nome asc");
				$texto = $o_monta_site->ilustra_imagem();
				echo $texto;
				unset($o_imagem);
				unset($o_monta_site);
			break;
			
			case 'excluir_grupo':
				$o_monta_site = new Monta_site;
				
				$_REQUEST['parametro'] = trim($_REQUEST['parametro']);
				$ids_imagens = explode(',', $_REQUEST['parametro']);
				$cont = count($ids_imagens);
				
				for($i=0; $i<$cont; $i++)
				{
					$o_imagem = new Imagem;
					$o_imagem->set('id', $ids_imagens[$i]);
					if($rs = $o_imagem->selecionar())
					{
						foreach($rs as $l)
						{
						}
					}
					if(file_exists("../imagens/produtos/".$l["nome"]))
					{
						unlink("../imagens/produtos/".$l['nome']);
					}

					$o_imagem->excluir();
				}
				
				$o_monta_site->set('id_album', $_REQUEST['_id_album']);
				$o_monta_site->set('x', 80);
				$o_monta_site->set('y', 80);
				$o_monta_site->set('click', 15);
				$o_monta_site->set('pasta', 'produtos');
				$o_monta_site->set('div_imagem', "".$_REQUEST['_div']."");
				$o_monta_site->set('ordenador', "nome asc");
				$texto = $o_monta_site->ilustra_imagem();
				echo $texto;
				unset($o_imagem);
				unset($o_monta_site);
			break;
		}
	break;
	
	case 'seleciona_enquete':
	
		$id_pergunta = trim($_REQUEST["_id_pergunta"]);
		$id_resposta = trim($_REQUEST["_id_enquete"]);
	
		$sucesso_resposta = false;
		
		if($id_pergunta != "" && $id_resposta != "")
		{	
			$o_resposta = new Resposta;
			$o_resposta->set('id_pergunta_questao', $id_resposta);
			if($rs = $o_resposta->selecionar())
			{
				foreach($rs as $l)
				{
					$quantidade_votos = $l['quantidade_votos'] + 1;
					$o_resposta->set('quantidade_votos', $quantidade_votos);
					$o_resposta->set('data_modificacao', date("Y-m-d H:i:s"));
					$o_resposta->set('id', $l['id']);
					if($rs_ed = $o_resposta->editar())
					{
						$sucesso_resposta = true;
					}
				}
			}
			else
			{
				
				$o_resposta->set('quantidade_votos', '1');
				$o_resposta->set('data_modificacao', date("Y-m-d H:i:s"));
				if($rs_in = $o_resposta->inserir())
				{
					$sucesso_resposta = true;
				}
				
			}	
		}
		if($sucesso_resposta)
		{
			echo "sucesso_resposta";	
		}
		
	break;


	case 'modifica_ordem_home':
		if($_REQUEST["_id_produto"] != "" && $_REQUEST['_ordem'] != "")
		{
			$o_produto = new Produto;
			$o_produto->set('data', date("Y-m-d H:i:s"));
			$o_produto->set('ordem', $_REQUEST['_ordem']);
			$o_produto->set('id', $_REQUEST["_id_produto"]);
			$res = $o_produto->editar_ordem_home();
			if(!$res)
			{
				echo "nao_modificou";
			}
			unset($o_produto);
		}
		else
		{
			echo "nao_modificou";
		}
	break;
	
	case 'modifica_estado_home':
		if($_REQUEST["_id_produto"] != "" && $_REQUEST['_estado'] != "")
		{
			$o_produto = new Produto;
			$o_produto->set('data', date("Y-m-d H:i:s"));
			$o_produto->set('estado', $_REQUEST['_estado']);
			$o_produto->set('id', $_REQUEST["_id_produto"]);
			$res = $o_produto->editar_estado_home();
			if(!$res)
			{
				echo "nao_modificou";
			}
			unset($o_produto);
		}
		else
		{
			echo "nao_modificou";
		}
	break;
	
	case 'notificao':
		$o_produto = new Produto;
		$o_produto->set('id_produto_tipo', '3');
		$o_produto->set('estado', 'i');
		if($res = $o_produto->selecionar())
		{
			echo "novas_img";
		}
	break;
	
	default:
	break;
}

unset($o_ajudante);


?>