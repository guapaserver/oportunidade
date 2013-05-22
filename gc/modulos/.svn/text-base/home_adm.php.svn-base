<?php
//a fazer
$o_produto = new Produto;
$o_produto_tipo = new Produto_tipo;
$o_auditoria = new Auditoria;

echo $o_ajudante->sub_menu_gc("","","HOME");

echo $o_ajudante->mensagem($_REQUEST['msg']);
switch($_REQUEST['acao'])
{

	case 'excluir':
		$o_ajudante->barrado(232);
		$o_produto->set('id',$_REQUEST['_id']);
		if($rs = $o_produto->selecionar())
		{
			foreach($rs as $l)
			{
				if($l['id_album'] > 0)
				{
					$o_imagem = new Imagem;
					$o_imagem->set('id_album', $l['id_album']);
					if($rs_img = $o_imagem->selecionar())
					{
						foreach($rs_img as $l_img)
						{
							if(file_exists("../imagens/produtos/".$l_img["nome"]))
							{
								unlink("../imagens/produtos/".$l_img['nome']);
							}
							
							$o_imagem->set('id', $l_img['id']);
							if($rs_i = $o_imagem->selecionar())
							{
								foreach($rs_i as $l_i)
								{
								}
							}
							$o_imagem->excluir();
						}
					}
					unset($o_imagem);
				}

				if($l['id_album_02'] > 0)
				{
					$o_imagem = new Imagem;
					$o_imagem->set('id_album', $l['id_album_02']);
					if($rs_img = $o_imagem->selecionar())
					{
						foreach($rs_img as $l_img)
						{
							if(file_exists("../imagens/produtos/".$l_img["nome"]))
							{
								unlink("../imagens/produtos/".$l_img['nome']);
							}
						
							$o_imagem->set('id', $l_img['id']);
							if($rs_i = $o_imagem->selecionar())
							{
								foreach($rs_i as $l_i)
								{
								}
							}
							$o_imagem->excluir();
						}
					}
					unset($o_imagem);
				}

				if($l['id_album_03'] > 0)
				{
					$o_imagem = new Imagem;
					$o_imagem->set('id_album', $l['id_album_03']);
					if($rs_img = $o_imagem->selecionar())
					{
						foreach($rs_img as $l_img)
						{
							if(file_exists("../imagens/produtos/".$l_img["nome"]))
							{
								unlink("../imagens/produtos/".$l_img['nome']);
							}

							$o_imagem->set('id', $l_img['id']);
							if($rs_i = $o_imagem->selecionar())
							{
								foreach($rs_i as $l_i)
								{
								}
							}
							$o_imagem->excluir();
						}
					}
					unset($o_imagem);
				}

				if($l['id_album_04'] > 0)
				{
					$o_imagem = new Imagem;
					$o_imagem->set('id_album', $l['id_album_04']);
					if($rs_img = $o_imagem->selecionar())
					{
						foreach($rs_img as $l_img)
						{
							if(file_exists("../imagens/produtos/".$l_img["nome"]))
							{
								unlink("../imagens/produtos/".$l_img['nome']);
							}
							$o_imagem->set('id', $l_img['id']);
							if($rs_i = $o_imagem->selecionar())
							{
								foreach($rs_i as $l_i)
								{
								}
							}
							$o_imagem->excluir();
						}
					}
					unset($o_imagem);
				}

				$rs = $o_produto->excluir();

				$o_auditoria->set('acao_descricao',"Exclusão da Matéria: ".$_REQUEST['_id'].".");
				$o_auditoria->inserir();
				header("Location: index.php?acao_adm=home_adm&msg=8&layout=lista");
			}
		}
		else
		{
			die("Erro ao tentar excluir Matéria.");
		}
	break;

	default:
	break;
}


switch($_REQUEST['layout'])
{
	case 'lista':
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th><b>TÍTULO</b></th>
					<th><b>AMBIENTE</b></th>
					<th><b>IMAGEM</b></th>
					<th><b>ORDEM</b></th>
					<th><b>ESTADO</b></th>
					
					<th><b>EDITAR</b></th>
					<th><b>EXCLUIR</b></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
				<th><b>TÍTULO</b></th>
					<th><b>AMBIENTE</b></th>
					<th><b>IMAGEM</b></th>
					<th><b>ORDEM</b></th>
					<th><b>ESTADO</b></th>
					
					<th><b>EDITAR</b></th>
					<th><b>EXCLUIR</b></th>
				</tr>
			</tfoot>
			<tbody>
				<?php 
				$o_produto = new Produto;
				$o_produto->set('ordenador',"ordem");
				if($rs = $o_produto->selecionar())
				{
					foreach($rs as $l)
					{
						$o_ilustra = new Ilustra;
						$o_ilustra->set('album_id',$l['id_album']);
						$o_ilustra->set('largura','40');
						$o_ilustra->set('altura','40');
						$o_ilustra->set('limite','1');
						$o_ilustra->set('pasta','produtos');
						$o_ilustra->set('acao_click', '1');
						$o_ilustra->set('separador',' ');
						$imagem = $o_ilustra->galeria();

						//if($l["estado"] == "i"){$l["estado"] = "off-line";}else{$l["estado"] = "on-line";}
						if($l["na_home"] == "s"){$l["na_home"] = "sim";}else{$l["na_home"] = "não";}
						
						echo "<tr>";
						echo "<td>".$l['nome']."</td>";
						$nome_assunto = "";	
						
						echo "<td>".strtoupper($l['nome_tipo_produto'])."</td>";
						
						echo "<td align=\"center\">".$imagem."</td>";

						//Ordem do produto na home
						$array = array ("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "x", "z");
						echo "<td align=\"center\">".$o_ajudante->drop_varios($array, "_ordem", $l['ordem'], "return modifica_ordem_home(".$l["id"].",this.value);", "", "select_width")."</td>";
						
						$estado = "<td align=\"center\">
							<select class=\"select_width\" name=\"_estado\" id=\"_estado\" size=\"1\" onchange=\"return modifica_estado_home('".$l["id"]."',this.value);\">
							
							<option value=\"a\" "; 
							if($l["estado"] == 'a'){$estado .= 'selected';} 
							$estado .=  ">on-line</option>
							<option value='i' "; 
							if($l["estado"] == 'i'){$estado .= 'selected';}
							$estado .=  ">off-line</option>
							</select>
						
						</td>";
						echo $estado;
						
						if($l['id_produto_tipo'] == 1)
						{
							$ambiente = "noticias_adm";
						}
						elseif($l['id_produto_tipo'] == 2)
						{
							$ambiente = "oportunidade_adm";
						}
						else
						{
							$ambiente = "galeria_virtual_adm";
						}
						
						echo "<td align=\"center\"><a href='index.php?msg=3&_id=".$l["id"]."&acao=editar&layout=form&acao_adm=".$ambiente."'><img src=\"../imagens/gc/edit.png\" title=\"editar\" /></a></td>";							
						echo "<td align=\"center\"><a href=javascript:confirma('index.php?_id=".$l["id"]."&acao=excluir&acao_adm=".$_REQUEST["acao_adm"]."','".str_replace(' ', '_', $l["nome"])."');><img src=\"../imagens/gc/cancel.png\" title=\"excluir\" /></a></td>";
						
						echo "</tr>";
						unset($o_ilustra);
					}
				}
				unset($o_produto);
				?>
			</tbody>
		</table>
		<br/><br/><br/>
		<?php
	break;

	default:
	break;
}
unset($o_produto);
unset($o_usuario_produto);
unset($o_categoria_produto);
?>