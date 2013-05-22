<?php
ob_start(); 
session_name("user");
session_start("user");
include("../inc/includes.php");

$o_configuracao = new Configuracao;
$o_album = new Album;
$o_ajudante = new Ajudante;


$url_vitual = $o_configuracao->url_virtual();

if($_SESSION["acesso"] == "sim")
{

	switch($_REQUEST['acao'])
	{
		case 'gravar':
			
			$o_produto = new Produto;
			$o_imagem = new Imagem;

			/*Caso tenha imagens na session, cria o album e salva as imagens*/
			$o_produto->set('id_usuario',$_SESSION["usuario_numero"]);
			$o_produto->set('corpo', $_REQUEST['descricao']);
			$o_produto->set('nome', $_REQUEST['titulo']);
			$o_produto->set('id_produto_tipo', $_REQUEST['id_produto_tipo']);
			$o_produto->set('estado', 'i');
			$o_produto->set('id_album',$_SESSION['id_album_uploads']);
			if($o_produto->inserir())
			{
				//envia e-mail para usuário cadastrado
				$mensagem = "Novo cadastro na &aacute;rea de ".$_REQUEST['msg'].":\n<br /><br />
				<b>T&iacute;tulo do Projeto:</b>: ".$_REQUEST["titulo"]."\n<br />
				<b>Descri&ccedil;&atilde;o do Projeto:</b>: ".$_REQUEST["descricao"]."\n\n";
				
				if($o_ajudante->email_html($o_configuracao->site_nome()." - Nova solicitação de cadastro",$mensagem,$_REQUEST['email'],$_REQUEST['email'],"../templates/template_mailing.htm"))
				{
					$msg = "<span style=\"float:left;width: 100%; color: #ed1c24; margin-left: 50px;\"> Email enviado com sucesso! <br> Aguarde aprovação. </span>";
				}
				else
				{
					$msg = "<span style=\"float:left;width: 100%; color: #ed1c24; margin-left: 50px;\">  Envio de mensagem falhou tente mais tarde.</span>";
				}

			}
			
			$_SESSION['id_album_uploads'] = "";

			$msg_sucesso = "<br> Projeto enviado com sucesso!";

			unset($o_produto);
			unset($o_categoria_produto);
			unset($o_album);
			unset($o_imagem);
			
		break;
		
		default:
			
			$o_album = new Album;
			$o_album->set('estado', 'x');
			$date = date('Y-m-d', strtotime('-1 day'));
			$o_album->set('criterio', 'DATE_FORMAT(data_hora, \'%Y-%m-%d\') <= \''.$date.'\'');
			if($rs = $o_album->selecionar())
			{
				foreach($rs as $l_album)
				{
					$o_imagem = new Imagem;
					$o_imagem->set('id_album', $l_album['id']);
					if($rs = $o_imagem->selecionar())
					{
						foreach($rs as $l_imagem)
						{
							$file = "../imagens/produtos/".$l_imagem['nome'];//trocar o endereço
							if(file_exists($file))
							{
								unlink($file); 
							}
							$o_imagem->set('id',$l_imagem['id']);
							$o_imagem->excluir();
						}
					}
					unset($o_imagem);
					$o_album->set('id',$l_album['id']);
					$rs = $o_album->excluir();
				}
			}
			unset($o_album);
			
			$o_album = new Album;
			$o_album->set('estado', 'a');
			$o_album->set('nome', $_SESSION["usuario_usuario"]."-".date("Y-m-d H:i:s"));
			$o_album->set('id_album_tipo', 1);
			$o_album->set('estado', 'x');
			$o_album->set('data_hora', date("Y-m-d H:i:s"));
			if($o_album->inserir())
			{
				if($r = $o_album->selecionar())
				{
					foreach($r as $l_album)
					{
						$id_album = $l_album['id'];
					}
				}
				
			}
				
			$_SESSION['id_album_uploads'] = $id_album;
		
		break;
		
	}
	
	
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<script type="text/javascript" src="../inc/js/jquery.js" ></script>
	<script type="text/javascript" src="../inc/js/customSelect.jquery.js"></script>
	
	
	<!--Plugin para subir mutliplas imagens-->
	<script src="../inc/js/fileuploader.js" type="text/javascript"></script>
	<script src="../inc/js/jquery.blockUI.js" type="text/javascript"></script>
	<!--Plugin para subir mutliplas imagens-->
	
	<script src="../inc/js/java_script.js" type="text/javascript"></script>

	<link href="../inc/css/formatacao.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
	$(function(){
	
	$('select.styled').customSelect();
	
	});
	
	function abre_janela_02(theURL,winName,features)
		{
			window.open(theURL,winName,features);
		}
		
	</script>
	
	</head>
	
	
	
	<body style="background: #ffffff;">
	<h2 class="titulo_form">Ol&aacute;, <?= $_SESSION["usuario_usuario"] ?>! <?= $msg_sucesso ?></h2> 
	<!--<a href="<?= $url_vitual ?>login/sair" style="color: red; text-decoration:none; float: left;">Sair</a>-->
	<form name="formulario_galeria" id="formulario_galeria" action="<?= $url_vitual ?>componentes/popup_galeria.php?acao=gravar" method="post">
		<strong>T&iacute;tulo do Projeto:</strong>
		<input type="text" name="titulo" value="" style='width: 100%;'>
		
				
		<strong>Descri&ccedil;&atilde;o do projeto:</strong>
		<textarea name="descricao" style='width: 100%; height: 130px;'></textarea>
		
	
		
		<div id="div_carrega_imagem">
			<div id="file-uploader-demo1">
				<noscript>
					<input tabindex="6"  name="_arquivo" id="_arquivo" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			<strong></strong>
			<!--<input type="button" name="_on" value=" todas " onclick="jqCheckAll('cmp_<?=$id_album?>_img', 1);"/>
			<input type="button" name="_off" value=" nenhuma " onclick="jqCheckAll('cmp_<?=$id_album?>_img', 0);"/>
			<input type="button" name="_exc" value=" excluir " onclick="javascript:apagar_imagens('<?=$id_album?>', 'cmp_<?=$id_album?>_img','div_ajax_resultado');"/>-->
			
			<hr class="hr_invisible">
		</div>
		
		
			<div id="div_ajax_resultado"></div>
		
		
		<script type="text/javascript">
				
			$(window).load(function() {
				createUploader_galeria('album_01', 'file-uploader-demo1','div_ajax_resultado', <?=$id_album?>);
			});
				
		</script>
	
		<br/><br/><br/>
		
		<br/><br/>	
		<input type="submit" name="enviar" value="" class="enviar" onClick="return checa_campos('formulario_galeria_');">
		<input type="hidden" name="url_virtual" id="url_virtual" value="<?=$url_vitual?>" />
	</form>
	
	<?php echo $_REQUEST['email']?>
	
	</body>
<?php
}

/*Caso nao esteja logado*/
else
{
	echo "ok";
	//header("Location: http://localhost/oportunidade/login");	
}


unset($o_configuracao);
unset($o_album);
unset($o_produto);
unset($o_categoria_produto);
unset($o_imagem);
?>








