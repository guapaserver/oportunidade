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
	$o_usuario = new Usuario;
	$o_auditoria = new Auditoria;

	$url_fisico = $o_configuracao->url_fisico();
	$url_virtual = $o_configuracao->url_virtual();
	
	switch($_REQUEST['acao'])
	{
		case 'logar':

			//trata dados do usu�rio
			$email = $_POST['_email'];
			$senha = htmlspecialchars($o_ajudante->trata_input($_POST['_senha']));
		
			if(!(empty($email) AND ($senha)))
			{
				//busca usu�rio cuso tipo � igual aos dados enviados e tipo = 1 (administrador)
				$o_usuario->set('email',$email);
				$o_usuario->set('senha',$senha);
				//$o_usuario->set('estado','a');
		
				if($rs = $o_usuario->selecionar_usuario_pessoa())
				{
					//usu�rio existe - registra as informa��es na sess�o
					foreach($rs as $linha)
					{
						$_SESSION["usuario_numero"] = $linha["usuario_id"];
						$_SESSION["usuario_usuario"] = $linha["usuario_nome"];
						$_SESSION["usuario_tipo_id"] = $linha["id"];
						$_SESSION["usuario_cidade"] = $linha["cidade"];
						$_SESSION["usuario_uf"] = $linha["uf"];
						$_SESSION["usuario_email"] = $linha["usuario_email"];
						$_SESSION["usuario_adm_tipo"] = $linha["tipo_nome"];
						$_SESSION["usuario_data_hora"] = $linha["data_acesso"];
						$_SESSION["acesso"] = "sim";
					}
			
					//insere todas permiss�es em vari�vel de sess�o
					$o_usuario_ambiente = new Usuario_ambiente;
					$o_usuario_ambiente->set('id_usuario_tipo',$_SESSION["usuario_tipo_id"]);
					if($rs = $o_usuario_ambiente->selecionar())
					{
						foreach($rs as $l)
						{
							$grupo_ambientes[] = $l['id_ambiente'];
						}
					}
					$_SESSION['grupo_ambientes'] = $grupo_ambientes;
			
					//print_r($_SESSION['grupo_ambientes']);
					
					$o_auditoria->set('acao_descricao',"Acessou o sistema.");
					$o_auditoria->inserir();
					
					//$fancy = "$(document).ready(function (){fancy_function('".$url_virtual."componentes/popup_galeria.php',700,675,'iframe')});";
					
					header("Location: ".$url_virtual.$_REQUEST['ambiente']."/formulario");
				}
				else
				{
					$msg = "Usu�rio ou senha incorretos!";
					//exit();
				}
			}
			else
			{
				$msg =  "Favor digitar corretamente usu�rio e senha.";
			}
			
		break;
		
		case 'sair':
		
			$o_usuario->set('data_acesso',date("Y/m/d H:i:s"));
			$o_usuario->set('id',$_SESSION["usuario_numero"]);
	
			$rs = $o_usuario->editar_data_acesso();
	
			$o_auditoria->set('acao_descricao',"Saiu do sistema: ".$_SESSION["usuario_numero"].".");
			$o_auditoria->inserir();
	
			$_SESSION = array(); //limpa as vari�veis de sess�o
			session_destroy();
	
			header("Location: ".$url_virtual."");
			ob_end_flush();
			
		break;
	}

	//inicializa o template para administrar as p�ginas
	$template = $o_ajudante->template("".$url_fisico."templates/login.html");
	//troca as vari�veis
	$array = array(
		"[url_virtual]" => $url_virtual,
		"[acao]" => $url_virtual."login",
		"[ambiente]" => $_REQUEST['acao'],
		//"[fancy]" => $fancy,
		"[msg]" => $msg
	);

	$conteudo = strtr($template,$array);
	unset($array);
	
	$corpo_html = $conteudo;

	unset($o_configuracao);
	unset($o_ajudante);
	unset($o_auditoria);
	unset($o_usuario);
?>