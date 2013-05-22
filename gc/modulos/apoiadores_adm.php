<script language="javascript">
$(function()
{
	data_picker('data_01');
	data_picker('data_02');
});
</script>

<?php
$o_apoiadores = new Apoiadores;
$o_configuracao = new Configuracao;

echo $o_ajudante->sub_menu_gc("NOVO,EDITAR | EXCLUIR","msg=5&acao_adm=apoiadores_adm&acao=novo&layout=form,acao_adm=apoiadores_adm&layout=lista&msg=2","APOIADORES",$acao);
echo $o_ajudante->mensagem($_REQUEST['msg']);

switch($_REQUEST["acao"])
{
	case 'novo':
		$o_ajudante->barrado(9);
		$acao = "inserido";
	break;

	case 'inserido':
		$o_ajudante->barrado(9);


			$o_apoiadores->set('titulo',$_REQUEST['_nome']);
			$o_apoiadores->set('logo',$_REQUEST['_logo']);
			$o_apoiadores->set('data_modificacao',date("Y-m-d H:i:s"));
			$r = $o_apoiadores->inserir();

			$o_auditoria->set('acao_descricao',"Inserção de novo apoiador: ".$_REQUEST["_nome"].".");
			$o_auditoria->inserir();

			header("Location: ".$_SERVER['PHP_SELF']."?layout=lista&acao_adm=apoiadores_adm&msg=7");
		
	break;

	case 'editar':
		$acao = "editado";
		$o_ajudante->barrado(5);
		$o_apoiadores->set('id',$_REQUEST['_id']);
		$rs = $o_apoiadores->selecionar();
		foreach($rs as $l)
		{}
	break;

	case 'editado':
		$o_ajudante->barrado(5);
		
		$o_apoiadores->set('titulo',$_REQUEST['_nome']);
		$o_apoiadores->set('logo',$_REQUEST['_logo']);
		$o_apoiadores->set('data_modificacao',date("Y-m-d H:i:s"));
		$o_apoiadores->set('id',$_REQUEST['_id']);
		$r = $o_apoiadores->editar();

		$o_auditoria->set('acao_descricao',"Edição de apoiador: ".$_REQUEST["_nome"].".");
		$o_auditoria->inserir();

		header("Location: ".$_SERVER['PHP_SELF']."?layout=lista&acao_adm=apoiadores_adm&msg=1");
	break;

	case 'excluir':
		$o_ajudante->barrado(44);
		
		$o_apoiadores->set('id',$_REQUEST['_id']);
		$rs = $o_apoiadores->excluir();

		$o_auditoria->set('acao_descricao',"Exclusão de apoiador: ".$_REQUEST['_id'].".");
		$o_auditoria->inserir();

		header("Location: ".$_SERVER['PHP_SELF']."?layout=lista&acao_adm=apoiadores_adm&msg=8");
	break;

	default:
	break;
}

switch($_REQUEST['layout'])
{
	case 'form': 
		?>
		<form name="form_usuario" class="formularios" id="form_usuario" action="<?=$_SERVER['PHP_SELF']?>" method="post" onSubmit="return CheckRequiredFields();"> 
			<strong>Nome:</strong>
			<input name="_nome" value="<?=$l['titulo']?>" tabindex="1" maxlength="150" id="_nome" type="text" size="30">
			<span class="requerido">*</span>
			<?php echo $o_ajudante->ajuda("Digite o nome. Máximo 150 caracteres.");?>
			<hr>
			
			<strong>Logo da Empresa</strong>
			<input name="_logo" id="_logo" type="text" size="30" readonly="readonly" value="<?=$l["logo"]?>" />
			<?php if($acao != "inserido"){echo $o_ajudante->btn_img("Clique para visualizar sua imagem atual.","javascript:abre_janela_02('../utilitarios/visualiza_util.php?acao_visualiza=visualiza_img&img_endereco=imagens/galeria/".$l["logo"]."','img_util','scrollbars=yes,resizable=yes,width=450,height=300');","btn_visualizar.png","0");}?>
			<?php echo $o_ajudante->btn_img("Clique para visualizar as imagens que voc&ecirc; j&aacute; tem.","javascript:abre_janela_02('../utilitarios/img_util.php?campo_nome=_logo&img_util=mostra&img_util_endereco=galeria','img_util','scrollbars=yes,resizable=yes,width=450,height=300');","btn_ver.png","0");?>
			<?php echo $o_ajudante->btn_img("Clique para deletar uma imagem.","javascript:abre_janela_02('../utilitarios/img_util.php?img_util=img_deleta_02&img_util_endereco=galeria','img_util','scrollbars=yes,resizable=yes,width=450,height=300');","btn_deleta.png","0");?>
			<?php echo $o_ajudante->btn_img("Clique para enviar uma nova imagem.","javascript:abre_janela_02('../utilitarios/img_util.php?formulario=form_usuario&campo_nome=_logo&pasta_destino=galeria&img_util=img_procura','img_util','scrollbars=yes,resizable=yes,width=450,height=300');","btn_envia.png","0");?>
			<?php echo $o_ajudante->ajuda("Escolha a imagem. Lembre-se que a extensão da imagem deve estar em letras minúsculas. Exemplo: .jpg");?>
			<br>
			<img src="<?=$url_virtual?>utilitarios/thumbnail.php?largura=100&amp;img=../imagens/galeria/<?=$l['logo'] ?>">
			<hr>

			<strong>&nbsp;</strong>
			<input name="image" type="image"  onClick="return checa_campos('sistema_apoiadores');"  alt="Salvar alterações" src="../imagens/gc/btn_cadastrar.png"> 
			<?php
			if($acao == "editado")
			{
				?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.form_usuario.reset();"><img  alt="Desfazer" src="../imagens/gc/btn_cancelar.png"></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:confirma('index.php?_id=<?=$l["id"]?>&acao=excluir&acao_adm=apoiadores_adm','<?=$l["nome"]?>')"><img src="../imagens/gc/btn_excluir.png" border="0"></a>
				<?php
			}
			?>
			<hr >

			<input type="hidden" name="acao_adm" value="apoiadores_adm">
			<input type="hidden" name="acao" value="<?=$acao?>">
			<input type="hidden" name="_id" value="<?=$l["id"]?>">
			<input type="hidden" name="msg" value="1">
		</form>
		<?php
	break;

	case 'lista':
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th><b>NOME</b></th>
					<th><b>LOGO</b></th>
					<th><b>EDITAR</b></th>
					<th><b>EXCLUIR</b></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><b>NOME</b></th>
					<th><b>LOGO</b></th>
					<th><b>EDITAR</b></th>
					<th><b>EXCLUIR</b></th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				$o_apoiadores = new Apoiadores;
				$o_apoiadores->set('ordenador',"titulo");
				if($rs = $o_apoiadores->selecionar())
				{
					foreach($rs as $l)
					{

						echo "<tr>";
						echo "<td>".$l['titulo']."</td>";
						echo "<td>".$l['logo']."</td>";

						echo "<td align=\"center\"><a href='index.php?msg=3&_id=".$l["id"]."&acao=editar&layout=form&acao_adm=".$_REQUEST["acao_adm"]."'><img src=\"../imagens/gc/edit.png\" title=\"editar\" /></a></td>";
						echo "<td align=\"center\"><a href=javascript:confirma('index.php?_id=".$l["id"]."&acao=excluir&acao_adm=".$_REQUEST["acao_adm"]."','".$l["nome"]."');><img src=\"../imagens/gc/cancel.png\" title=\"excluir\" /></a></td>";
						echo "</tr>";
					}
				}
				unset($o_apoiadores);
				?>
			</tbody>
		</table>
		<br/><br/><br/>
		<?php
	break;

	default:
		echo "";
	break;
}

unset($o_apoiadores);
unset($o_configuracao);
?>