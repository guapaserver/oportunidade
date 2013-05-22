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

	$o_empresa = new Empresa;
	$o_empresa_contato = new Empresa_contato;
	$o_configuracao = new Configuracao;
	$o_ajudante = new Ajudante;
	
	$url_fisico = $o_configuracao->url_fisico();
	$url_virtual = $o_configuracao->url_virtual();
	
	$contato_js = "";
	
	switch($_REQUEST['acao'])
	{
		case 'enviar':
			if(trim($_REQUEST['nome']) != "" && trim($_REQUEST['nome']) != 'nome' && trim($_REQUEST['email']) != "" && trim($_REQUEST['email']) != "email")
			{
				//envia e-mail para usuário cadastrado
				$mensagem = "E-mail de contato enviado atrav&eacute;s do site ".$o_configuracao->site_nome()." com os seguintes dados:\n<br /><br /><b>Nome</b>: ".$_REQUEST["nome"]."\n<br /><b>E-mail</b>: ".$_REQUEST["email"]."\n\n<br />
				<b>Cidade</b>: ".$_REQUEST["cidade"]."\n\n<br /><b>Estado</b>: ".$_REQUEST["estado"]."\n\n<br /><b>Coment&aacute;rio</b>: ".$_REQUEST["comentario"]."\n\n";
				
				if($o_ajudante->email_html($o_configuracao->site_nome()." - Contato pelo módulo Fale Conosco",$mensagem,$o_configuracao->email_contato(),$_REQUEST['_email'],"".$url_virtual."templates/template_mailing.htm"))
				{
					$msg = "<span style=\"float:left;width: 100%; color: #ed1c24\"> E-mail enviado com sucesso!</span>";
				}
				else
				{
					$msg = "<span style=\"float:left;width: 100%; color: #ed1c24\">  Envio de mensagem falhou tente mais tarde.</span>";
				}
			}
			else
			{
				echo "<script>alert('Preencha os campos Nome e E-mail.')</script>";
			}
		break;
	}
	
	$o_empresa->set('estado','a');
	if($rs = $o_empresa->selecionar())
	{
		foreach($rs as $linha)
		{
			$email = $linha['email'];
			$id = $linha['id'];
		}
		$o_empresa_contato->set('id_empresa', 0);
		$r = $o_empresa_contato->selecionar();
		foreach($r as $l)
		{
			if($l['tipo'] != "")
			{
				$telefones = "<font color=\"#ef7d00\" style=\"float:left;margin-left: 50px;margin-bottom: 40px;width: 100%;font-size:23px;\">(".$l['ddd'].") ".$l['numero']." - ".$l['tipo']."</font>";
			}
			else
			{
				$telefones = "<font color=\"#ef7d00\" style=\"float:left;margin-left: 50px;margin-bottom: 40px;width: 100%;font-size:23px;\">(".$l['ddd'].") ".$l['numero']."</font>";
			}
		}
	}
	else
	{
		$contatos = "";
	}
	
	
	$lista = array(
	"[url_virtual]" => $url_virtual,
	"[email]" => $email,
	"[contatos]" => $telefones,
	"[action]" => $url_virtual."fale_conosco/enviar",
	"[msg]" => $msg
	);

	//inicializa o template para administrar as páginas
	$template = $o_ajudante->template("".$url_fisico."templates/contato.html");

	$conteudo = strtr($template,$lista);
	unset($lista);
	
	$corpo_html = $conteudo;

	unset($o_configuracao);
	unset($o_ajudante);
?>