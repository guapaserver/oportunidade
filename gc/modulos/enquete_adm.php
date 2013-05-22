<?php
//a fazer
$o_pergunta = new Pergunta;
$o_pergunta_questao = new Pergunta_questao;
echo $o_ajudante->sub_menu_gc("NOVA,EDITAR | EXCLUIR","msg=5&acao_adm=enquete_adm&acao=nova&layout=form,msg=6&acao_adm=enquete_adm&layout=lista&msg=2","Enquete");
echo $o_ajudante->mensagem($_REQUEST['msg']);

switch($_REQUEST['acao'])
{
	case 'nova':
	
		$o_ajudante->barrado(36);
		$acao = "inserido";
		
		/*Insere e recupera id da pergunta*/
		$o_pergunta->set('data_modificacao', date("Y/m/d H:i:s"));
		if($o_pergunta->inserir())
		{
			if($rs = $o_pergunta->selecionar())
			{
				foreach($rs as $l)
				{
					$id_pergunta = $l['id'];
				}
			}
			
		}
		
	break;


	case 'inserido':
		
		$o_ajudante->barrado(36);
		
		$o_pergunta->set('id', $_REQUEST["_id"]);
		$o_pergunta->set('data_modificacao', date("Y/m/d H:i:s"));
		$o_pergunta->set('titulo', $_REQUEST['_titulo']);
		$o_pergunta->set('estado',$_REQUEST['estado']);
		$o_pergunta->editar();
		
		$o_auditoria->set('acao_descricao',"Inserção de nova pergunta no questionario: <b>".$_REQUEST['_titulo']." - id ".$_REQUEST['_id']."</b>.");
		$o_auditoria->inserir();
		header("Location: ".$_SERVER['PHP_SELF']."?acao_adm=enquete_adm&layout=lista&msg=7");

	break;


	case 'editar':
	
		$o_ajudante->barrado(35);
		$acao = "editado";
		$o_pergunta->set('id',$_REQUEST['_id']);
		$rs = $o_pergunta->selecionar();
		foreach($rs as $l)
		{}
		
		$id_pergunta = $_REQUEST['_id'];

		?>
		<script language="javascript">
			$(window).load(function() {
				ajaxHTML('pergunta_questoes','<?= $o_configuracao->url_virtual()?>gc/ajax_gc_adm.php?acao_adm=adicionar_questao&acao=&id_pergunta=<?= $_REQUEST['_id']?>');
			});
		</script>
		<?php

	break;


	case 'editado':
	
		$o_ajudante->barrado(35);
		
		$o_pergunta->set('id', $_REQUEST["_id"]);
		$o_pergunta->set('data_modificacao', date("Y/m/d H:i:s"));
		$o_pergunta->set('titulo', $_REQUEST['_titulo']);
		$o_pergunta->set('estado',$_REQUEST['estado']);
		$o_pergunta->editar();
		
		$o_auditoria->set('acao_descricao',"Edição de pergunta no questionario: <b>".$_REQUEST['_titulo']." - id ".$_REQUEST['_id']."</b>.");
		$o_auditoria->inserir();
		header("Location: ".$_SERVER['PHP_SELF']."?acao_adm=enquete_adm&layout=lista&id=".$id."&msg=1");
		
	break;


	case 'excluir':
		$o_ajudante->barrado(30);
		
		$o_pergunta->set('id',$_REQUEST['_id']);
		if($rs = $o_pergunta->excluir())
		{
			$o_pergunta_questao->set('id_pergunta',$_REQUEST['_id']);
			$o_pergunta_questao->excluir2();
		}
		
		$id_pergunta = $_REQUEST['_id'];

		$o_auditoria->set('acao_descricao',"Exclusão da enquete:  <b>".$_REQUEST['_titulo']." - id ".$_REQUEST['_id']."</b>");
		$o_auditoria->inserir();
		header("Location: ".$_SERVER['PHP_SELF']."?acao_adm=enquete_adm&msg=8&layout=lista");
	break;

	default:
	break;
}


switch($_REQUEST['layout'])
{

	case 'form': 
		?>
		<form name="formulario_enquete" id="formulario_enquete" class="formularios" action="<?=$_SERVER['PHP_SELF']?>" method="post">

		<strong>Pergunta</strong>
		<textarea rows="5" name="_titulo" id="_titulo" cols="33"><?=$l["titulo"]?></textarea>
		<?php echo $o_ajudante->ajuda("Digite a pergunta. Máximo 600 caracteres.");?>
		<hr>
		
		<strong>Questões</strong>
		<input type="text" name="_questao" id="_questao" value="" /> 
		<br>
		<input type="button"  onclick="ajaxHTML('pergunta_questoes','<?= $o_configuracao->url_virtual()?>gc/ajax_gc_adm.php?acao_adm=adicionar_questao&acao=novo&parametro='+_questao.value+'&id_pergunta=<?= $id_pergunta?>')" tabindex="5" value="Adicionar">
		<hr style="border: none;">
		
		<div id="pergunta_questoes"></div>
		
		<hr>
		
		<strong>Estado</strong>
		<input type="radio"  value="a" <?php if ($l["estado"] == "a") echo "checked";?> name="estado"> on-line 
		<input type="radio"  value="i" <?php if ($l["estado"] == "i") echo "checked";?> name="estado"> off-line
		<?php echo $o_ajudante->ajuda("Escolha se esta Enquete aparecerá no site.");?>
		
		<hr>
		<strong> </strong>
		<input name="image" type="image"  onClick="return checa_campos('ilustrar_imagem');"  alt="Salvar alterações" src="../imagens/gc/btn_cadastrar.png">
		<?php
		if($acao != "inserido")
		{
			?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.formulario_imagem.reset();"><img src="../imagens/gc/btn_cancelar.png" border="0"></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:confirma('index.php?msg=6&id=<?=$l["id"]?>&acao=excluir&acao_adm=enquete_adm','<?=$l["nome"]?>')"><img src="../imagens/gc/btn_excluir.png" border="0"></a>
			<?php
		}
		?>
		<input type="hidden" name="acao_adm" value="enquete_adm">
		<input type="hidden" name="acao" value="<?=$acao?>">
		<input type="hidden" name="_id" value="<?=$id_pergunta?>">
		</form>
		<?php
	break;

	case 'lista':

		if($rs = $o_pergunta->selecionar())
		{
			?>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th><b>ID</b></th>
						<th><b>PERGUNTA</b></th>
						<th><b>DATA</b></th>
						<th><b>ESTADO</b></th>
						<th><b>EDITAR</b></th>
						<th><b>EXCLUIR</b></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><b>ID</b></th>
						<th><b>PERGUNTA</b></th>
						<th><b>DATA</b></th>
						<th><b>ESTADO</b></th>
						<th><b>EDITAR</b></th>
						<th><b>EXCLUIR</b></th>
					</tr>
				</tfoot>
				<tbody>
				<?php
				$o_pergunta = new Pergunta;
				if($rs = $o_pergunta->selecionar())
				{
					foreach($rs as $l)
					{
						if($l['id'] != 1)
						{
							if($l['estado'] == "a"){$estado = "On-line";}else{$estado="Off-line";}
							
							echo "<td>".$l["id"]."</td>";
							echo "<td>".$l['titulo']."</td>";
							echo "<td align=\"center\">".$l['data_modificacao']."</td>";
							echo "<td align=\"center\">".$estado."</td>";
							echo "<td align=\"center\"><a href='index.php?msg=3&_id=".$l["id"]."&acao=editar&layout=form&acao_adm=".$_REQUEST["acao_adm"]."'><img src=\"../imagens/gc/edit.png\" title=\"editar\" /></a></td>";
							echo "<td align=\"center\"><a href=javascript:confirma('index.php?_id=".$l["id"]."&acao=excluir&acao_adm=".$_REQUEST["acao_adm"]."','".$l["nome"]."');><img src=\"../imagens/gc/cancel.png\" title=\"excluir\" /></a></td>";
							echo "</tr>";
						}
					}
				}
				unset($o_pergunta);
				?>
				</tbody>
			</table>
			<br/><br/><br/>
			<?php
		}
		else
		{
			echo $o_ajudante->mensagem(14);
		}
	break;


default:
break;
}
?>