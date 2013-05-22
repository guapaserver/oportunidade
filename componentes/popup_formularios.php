<?php
ob_start();
session_name("adm");
session_start("adm");
include("../inc/includes.php");

$o_configuracao = new Configuracao;
$o_ajudante = new Ajudante;

$url_virtual = $o_configuracao->url_virtual();


	switch($_REQUEST['acao'])
	{		
		case 'correspondentes':
			
			switch($_REQUEST['subacao'])
			{
				case 'enviar':
					
					if(trim($_REQUEST['nome']) != "" && trim($_REQUEST['nome']) != 'nome' && trim($_REQUEST['email']) != "" && trim($_REQUEST['email']) != "email")
					{
						if($_REQUEST["termos"] == "Sim")
						{
							//envia e-mail para usuário cadastrado
							$mensagem = "E-mail de contato enviado atrav&eacute;s do site ".$o_configuracao->site_nome()." com os seguintes dados:\n<br /><br />
							<b>Nome Completo</b>: ".$_REQUEST["nome"]."\n<br />
							<b>CPF</b>: ".$_REQUEST["cpf"]."\n\n<br>
							<b>Data de Nascimento:</b>: ".$_REQUEST["data_nascimento"]."\n\n<br>
							<b>E-mail</b>: ".$_REQUEST["email"]."\n\n<br />
							<b>Cidade</b>: ".$_REQUEST["cidade"]."\n\n<br />
							<b>Estado</b>: ".$_REQUEST["estado"]."\n\n<br />
							<b>CEP</b>: ".$_REQUEST["cep"]."\n\n<br>
							<b>Telefone</b>: ".$_REQUEST["telefone"]."\n\n<br>
							<b>Você gostaria de ser um correspondente?</b>: ".$_REQUEST["_correspondente"]."\n\n<br>
							<b>Li e aceito os termos de uso e condi&ccedil;&otilde;es gerais</b>:
							".$_REQUEST["termos"]."\n\n";
							
							if($o_ajudante->email_html($o_configuracao->site_nome()." - Nova solicitação de cadastro",$mensagem,$o_configuracao->email_contato(),$_REQUEST['email'],"../templates/template_mailing.htm"))
							{
								$msg = "<span style=\"float:left;width: 100%; color: #ed1c24; margin-left: 50px;\"> Email enviado com sucesso! <br> Aguarde confirma&ccedil;&atilde;o de cadastro. </span>";
							}
							else
							{
								$msg = "<span style=\"float:left;width: 100%; color: #ed1c24; margin-left: 50px;\">  Envio de mensagem falhou tente mais tarde.</span>";
							}
						}
						else
						{
							echo "<script>alert('Aceite os termos de uso e condições gerais, para efetuar o cadastro')</script>";
						}
					}
					else
					{
						echo "<script>alert('Preencha os campos Nome e E-mail.')</script>";
					}
				
				break;
				
				default:
					
				break;//Fecha default de subacao
				
			}//Switch de Subacao
			
		break;//Fecha correspondentes
		
		default:
		
		break;
		
	}
	
unset($o_ajudante);
unset($o_configuracao);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link href="../inc/css/formatacao.css" rel="stylesheet" type="text/css" />
<script src="../inc/js/MascaraValidacao.js" ></script>
</head>



<body style="background: #ffffff;">
	<h2 class="titulo_form">Cadastro</h2>
	
	<form name="formulario_galeria" id="formulario_galeria" action="../componentes/popup_formularios.php?acao=correspondentes&subacao=enviar" method="post">
		<strong>Nome completo:</strong>
		<input type="text" name="nome" value="" style='width: 100%;'>
		
		<div style="float:left;width: 60%;">
			<strong>CPF:</strong>
			<input type="text" name="cpf" value="" style='width: 90%;' onKeyPress="MascaraCPF(formulario_galeria.cpf)" maxlength="14">
		</div>
		
		<div style="float:left;width: 40%;">
			<strong>Data de Nascimento:</strong>
			<input type="text" name="data_nascimento" value="" style='width: 100%;' onKeyPress="MascaraData(formulario_galeria.data_nascimento)" maxlength="10">
		</div>
		
		<strong>E-mail:</strong>
		<input type="text" name="email" value="" style='width: 100%;'>
		
		<strong>Endereço:</strong>
		<input type="text" name="endereco" value="" style='width: 100%;'>

		<div class="cidade">
			<strong>Cidade:</strong>
			<input type="text" name="cidade" value="" style='width: 260px;'>
		</div>


		<div class="estado">
			<strong>Estado:</strong>
			<input type="text" name="estado" value="" style='width: 170px;'>
		</div>

		<div style="width:100%;float:left;">
			<strong style="float:left">CEP:</strong><br><br>
			<input type="text" name="cep" value="" style='width: 240px; float:left;' onKeyPress="MascaraCep(formulario_galeria.cep)" maxlength="10">
		</div>
		
		<div style="width:100%;float:left;">
			<strong>Telefone:</strong><br><br>
			<input type="text" name="telefone" value="" style='width: 240px; float:left;' onKeyPress="MascaraTelefone(formulario_galeria.telefone)" maxlength="14">
		</div>
		
		
		<strong style="font-size: 13px;margin:20px 20px 20px 0px;">Você gostaria de ser um correspondente?</strong>
		<input type="radio" name="_correspondente" value="sim" ><strong style="width: 30px; margin-right: 60px;font-size: 13px;">sim</strong>
		<input type="radio" name="_correspondente" value="não"><strong style="width: 30px;font-size: 13px;">não</strong>
		
		<strong style="font-size: 13px;margin-top:40px;"><input type="radio" value="Sim" name="termos"> Li e aceito os termos de uso e condi&ccedil;&otilde;es gerais.</strong>
						
		<input type="submit" name="enviar" value="" class="enviar" style="margin-top: 40px;">
	</form>
		<?php echo $msg;?>
</body>





