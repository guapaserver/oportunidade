<?php
$o_css = new Css;
$o_imagem = new Imagem;

echo $o_ajudante->sub_menu_gc("NOVO","msg=5&acao_adm=layout_adm&acao=novo&layout=form","NOVO LAYOUT");
echo $o_ajudante->mensagem($_REQUEST['msg']);

switch($_REQUEST['acao'])
{
	case 'novo':
		$o_ajudante->barrado(226);
		$acao = "editado";
		
		$o_css->set('id',$_REQUEST['_id']);
		$rs = $o_css->selecionar();
		foreach($rs as $l)
		{}
	break;

	case 'editado':
		$o_ajudante->barrado(226);
		$o_css->set('id','1');
		if($rs = $o_css->selecionar())
		{
			foreach($rs as $l)
			{
				
			}
		}
		
		if($l['bg_body_img'] == "NULL" || trim($l['bg_body_img']) == "")
		{}
		else
		{
			if (!copy("../imagens/site_gc/".$l['bg_body_img'], "../imagens/site/".$l['bg_body_img'])) {
				echo "falha ao copiar $file...\n";
			}
		}
		
		if($l['bg_menu_topo_img'] == "NULL" || trim($l['bg_menu_topo_img']) == "")
		{}
		else
		{
			if (!copy("../imagens/site_gc/".$l['bg_menu_topo_img'], "../imagens/site/".$l['bg_menu_topo_img'])) {
				echo "falha ao copiar $file...\n";
			}
		}
		
		if($l['bg_banner_img'] == "NULL" || trim($l['bg_banner_img']) == "")
		{}
		else
		{
			if (!copy("../imagens/site_gc/".$l['bg_banner_img'], "../imagens/site/".$l['bg_banner_img'])) {
				echo "falha ao copiar $file...\n";
			}
		}
		
		if($l['bg_linha_divisoria_img'] == "NULL" || trim($l['bg_linha_divisoria_img']) == "")
		{}
		else
		{
			if (!copy("../imagens/site_gc/".$l['bg_linha_divisoria_img'], "../imagens/site/".$l['bg_linha_divisoria_img'])) {
				echo "falha ao copiar $file...\n";
			}
		}
		
		if($l['logo'] == "NULL" || trim($l['logo']) == "")
		{}else
		{
			$logo = $l['logo'];
			$newlogo = $logo;
			if (!copy("../imagens/site_gc/".$logo, "../imagens/site/".$newlogo)) {
				echo "falha ao copiar $file...\n";
			}
			$o_css = new Css;
			$o_css->set('id', '1');		
			$o_css->set('logo_online', $logo);
			$o_css->editar_bg();
		}
		
		$file = 'formatacao_test.css';
		$newfile = 'formatacao_custom.css';

		if (!copy("../inc/css/".$file, "../inc/css/".$newfile)) {
			//echo "falha ao copiar $file...\n";die();
		}

		$o_auditoria->set('acao_descricao',"Edição do Layout: ".$_SESSION["usuario_usuario"].".");
		$o_auditoria->inserir();
		header("Location: ".$_SERVER['PHP_SELF']."?acao_adm=layout_adm&acao=novo&layout=form&msg=1");
	break;

	default:
	break;
}


switch($_REQUEST['layout'])
{
	case 'form': 
		$o_monta_site = new Monta_site;
		?>
		<form name="form" class="formularios" action="<?=$_SERVER['PHP_SELF']?>" method="post">
			
			<h1>BODY</h1>
			<strong></strong><h2>Body</h2>
			<strong>BG:</strong>
			<input type="text" name="bg_body" tabindex="1" class="color-picker" size="8" autocomplete="on" value="<?=$l['bg_body']?>" />
			<hr class="hr_invisivei">
			
			<strong>BG Imagem</strong><br />
			<div id="file-uploader_body">
				<noscript>
					<input tabindex="2"  name="_arquivo" id="_arquivo" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			
			<script language="javascript">
				$(window).load(function() {
					createUploader_frond('file-uploader_body','fundo','div_resultado_body');
				});
			</script> 
			<?php
				if($l['bg_body_img'] == "NULL" || trim($l['bg_body_img']) == "")
				{
					$res = "";
				}
				else
				{					
					$o_monta_site->set('div', 'div_resultado_body');
					$o_monta_site->set('parametro', 'fundo');
					$res = $o_monta_site->css_imagem();
				}
			?>
			<strong></strong>
			<div id="div_resultado_body"><?=$res?></div>
			<hr>
			
			<h1>HEADER</h1>
			<strong></strong><h2>Menu</h2>
			<strong>Altura:</strong>
			<input name="altura_menu_topo" tabindex="3" type="text" value="<?=$l["altura_menu_topo"]?>" onblur="javascript: edita_campo_css('altura_menu_topo', this.value);" size="7" maxlength="10"> (px)
			<hr class="hr_invisivei">
			
			<strong>BG:</strong>
			<input type="text" name="bg_menu_topo" tabindex="4" class="color-picker" size="8" autocomplete="on" value="<?=$l['bg_menu_topo']?>" />
			<hr class="hr_invisivei">
			
			<strong>BG Imagem</strong><br />
			<div id="file-uploader_menu">
				<noscript>
					<input tabindex="5"  name="_arquivo_00" id="_arquivo_00" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			
			<script language="javascript">
				$(window).load(function() {
					createUploader_frond('file-uploader_menu','bg_menu_topo','div_resultado_menu');
				});
			</script> 
			
			<?php
				if($l['bg_menu_topo_img'] == "NULL" || trim($l['bg_menu_topo_img']) == "")
				{
					$res = "";
				}
				else
				{				
					$o_monta_site->set('div', 'div_resultado_menu');
					$o_monta_site->set('parametro', 'bg_menu_topo');
					$res = $o_monta_site->css_imagem();
				}
			?>
			
			<strong></strong>
			<div id="div_resultado_menu"><?=$res?></div>
			<hr>
			
			<strong></strong><h2>Banner</h2>
			
			<!--<strong>Altura:</strong>
			<input name="_altura_banner" tabindex="6" type="text" value="<?=$l["altura_banner"]?>" size="7" maxlength="10"> (px)
			<hr class="hr_invisivei">-->
			
			<strong>BG:</strong>
			<input type="text" name="bg_banner" tabindex="7" class="color-picker" size="8" autocomplete="on" value="<?=$l['bg_banner']?>" />
			<hr class="hr_invisivei">
			
			<strong>BG Imagem</strong><br />
			<div id="file-uploader_banner">
				<noscript>
					<input tabindex="8"  name="_arquivo_01" id="_arquivo_01" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			
			<script language="javascript">
				$(window).load(function() {
					createUploader_frond('file-uploader_banner','bg_banner','div_resultado_banner');
				});
			</script> 
			
			<?php
				if($l['bg_banner_img'] == "NULL" || trim($l['bg_banner_img']) == "")
				{
					$res = "";
				}
				else
				{			
					$o_monta_site->set('div', 'div_resultado_banner');				
					$o_monta_site->set('parametro', 'bg_banner');
					$res = $o_monta_site->css_imagem();
				}
			?>
			
			<strong></strong>
			<div id="div_resultado_banner"><?=$res?></div>
			<hr>
			
			<strong></strong><h2>Linha Menu</h2>
			<strong>BG:</strong>
			<input type="text" name="bg_linha_menu" tabindex="9" class="color-picker" size="8" autocomplete="on" value="<?=$l['bg_linha_menu']?>" />
			<hr>
			
			<strong></strong><h2>Linha divisória</h2>
			
			<strong>Altura:</strong>
			<input name="altura_linha_divisoria" type="text" tabindex="10"  onblur="javascript: edita_campo_css('altura_linha_divisoria', this.value);" value="<?=$l["altura_linha_divisoria"]?>" size="7" maxlength="10"> (px)
			<hr class="hr_invisivei">
			
			<strong>BG:</strong>
			<input type="text" name="bg_linha_divisoria" class="color-picker"  tabindex="11"  size="8" autocomplete="on" value="<?=$l['bg_linha_divisoria']?>" />
			<hr class="hr_invisivei">
			
			<strong>BG Imagem</strong><br />
			<div id="file-uploader_linha_divisoria">
				<noscript>
					<input tabindex="12"  name="_arquivo_02" id="_arquivo_02" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			
			<script language="javascript">
				$(window).load(function() {
					createUploader_frond('file-uploader_linha_divisoria','bg_linha_divisoria','div_resultado_linha_divisoria');
				});
			</script> 
			
			<?php
				if($l['bg_linha_divisoria_img'] == "NULL" || trim($l['bg_linha_divisoria_img']) == "")
				{
					$res = "";
				}
				else
				{					
					$o_monta_site->set('div', 'div_resultado_linha_divisoria');
					$o_monta_site->set('parametro', 'bg_linha_divisoria');
					$res = $o_monta_site->css_imagem();
				}	
			?>
			
			<strong></strong>
			<div id="div_resultado_linha_divisoria"><?=$res?></div>
			<hr>
			
			<strong></strong><h2>Logo</h2>
			
			<strong>Logo</strong><br />
			<div id="file-uploader_logo">
				<noscript>
					<input tabindex="13"  name="_arquivo_03" id="_arquivo_03" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			
			<script language="javascript">
				$(window).load(function() {
					createUploader_frond('file-uploader_logo','logo','div_resultado_logo');
				});
			</script> 
			
			<?php
				if($l['logo'] == "NULL" || trim($l['logo']) == "")
				{
					$res = "";
				}
				else
				{	
					$o_monta_site->set('div', 'div_resultado_logo');				
					$o_monta_site->set('parametro', 'logo');
					$res = $o_monta_site->css_imagem();
				}
			?>
			<strong></strong>
			<div id="div_resultado_logo"><?=$res?></div>			
			<hr class="hr_invisivei">
			
			<strong>Posição do Logo</strong>
			<input type="radio"  value="e" <?php if ($l["logo_float"] == "e") echo "checked";?> name="logo_float" onchange="javascript: edita_campo_css('logo_float', this.value);" tabindex="14"> esquerda
			<input type="radio"  value="c" <?php if ($l["logo_float"] == "c") echo "checked";?> name="logo_float" onchange="javascript: edita_campo_css('logo_float', this.value);"> centro
			<input type="radio"  value="d" <?php if ($l["logo_float"] == "d") echo "checked";?> name="logo_float" onchange="javascript: edita_campo_css('logo_float', this.value);"> direita
			<hr>			
			
			<h1>CORPO</h1>
			<strong></strong><h2>Destaques</h2>
			
			<strong>BG:</strong>
			<input type="text" name="bg_destaque" class="color-picker"  tabindex="16"  size="8" autocomplete="on" value="<?=$l['bg_destaque']?>" />
			<hr class="hr_invisivei">
			
			<strong>Sombra</strong>
			<input type="radio"  value="s" <?php if ($l["destaque_sombra"] == "s") echo "checked";?> name="destaque_sombra" onchange="javascript: edita_campo_css('destaque_sombra', this.value);" tabindex="15"> com sombras
			<input type="radio"  value="n" <?php if ($l["destaque_sombra"] == "n") echo "checked";?> name="destaque_sombra" onchange="javascript: edita_campo_css('destaque_sombra', this.value);"> sem sombras
			<hr>
			
			<strong>Borda arredondada?</strong>
			<input type="radio"  value="s" <?php if ($l["destaque_borda"] == "s") echo "checked";?> name="destaque_borda" onchange="javascript: edita_campo_css('destaque_borda', this.value);" tabindex="15"> sim
			<input type="radio"  value="n" <?php if ($l["destaque_borda"] == "n") echo "checked";?> name="destaque_borda" onchange="javascript: edita_campo_css('destaque_borda', this.value);"> não
			<hr>
			
			<strong>Borda arredondada com um raio de:</strong>
			<input name="radio_borda" type="text" tabindex="10"  onblur="javascript: edita_campo_css('radio_borda', this.value);" value="<?=$l["radio_borda"]?>" size="7" maxlength="10"> (px)
			<hr>
			
			<strong>Margim da Imagem destaque:</strong>
			<input name="tamanho_borda_destaque" type="text" tabindex="10"  onblur="javascript: edita_campo_css('tamanho_borda_destaque', this.value);" value="<?=$l["tamanho_borda_destaque"]?>" size="7" maxlength="10"> (px)
			<hr class="hr_invisivei">
			
			<strong> </strong>
			<input name="btn_preview" id="btn_preview" type="button" class="button_custom"  alt="Preview" value="Preview"/>
			
			<input name="image" type="image" onClick="return atualiza_css();"  alt="Enviar alterações" src="../imagens/gc/btn_cadastrar.png"/>
			
			<input type="hidden" name="acao" value="<?=$acao?>">
			<input type="hidden" name="acao_adm" value="layout_adm">
			<input type="hidden" name="_id" value="<?=$l["id"]?>">
		</form>
		<?php
	break;


	default:
	break;
}
unset($o_css);
unset($o_imagem);
?>

<script language="javascript">
	$(document).ready( function () {
		function init() {
			
			// Enabling miniColors
			$('.color-picker').miniColors(
			{
				close: function(hex, rgb) 
				{
					$this = $(this);					
					edita_campo_css($this.attr('name'),hex);
				}
			});
			
			// With opacity
			$('.color-picker-opacity').miniColors();
		}				
		init();
	});
	
	function edita_campo_css(campo, parametro)
	{
		$.ajax({
		url: "ajax_gc_adm.php",
		data: {acao_adm: "atualiza_css", acao: "editar", campo: campo, parametro: parametro},
		cache: false,
		success: function(html)
		{
			if(html.match(/.*sem_registros.*/i))
			{}
			else
			{}
		}
		});
	}
	
	$('#btn_preview').click(function (){
	
		$.ajax({
		url: "../ajax/cria_css.php",
		data: {acao_adm: ""},
		cache: false,
		success: function(html)
		{
			if(html.match(/.*sucesso.*/i))
			{
				popup_geral_02('site_teste', '', '');
			}
		}
		});
	});
	
</script>