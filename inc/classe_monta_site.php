<?php
class Monta_site
{
	private $id;
	private $div;
	private $parametro;
	private $id_pergunta;

	function __construct()
	{
	}

	function __destruct()
	{
	}

	function set($prop, $value)
	{
		$this->$prop = $value;
	}

	function monta_lista_blog()
	{
		$o_configuracao = new Configuracao;
		$url_virtual = $o_configuracao->url_virtual();
		
		$o_produto_materia = new Produto_materia;		
		$o_produto_materia->set('id_produto', $this->id_produto);
		$o_produto_materia->set('ordenador', 'id');
		$texto = "";
		if($rs = $o_produto_materia->selecionar())
		{
			$cont = $rs->rowCount();
			foreach($rs as $l)
			{
				$texto .= '<div class="blog_materia">';		
				//$texto .= '<b>T�tulo: </b><input name="_nome_blog_[]" type="text" value="'.$l['nome'].'" size="30" maxlength="50" />';
				$texto .= "<a href=\"javascript:ajax_pagina('materia_blog','excluir', '".$l['id']."', '".$this->id_produto."', '', '', '', '', '', '', 'div_blog_lista', 'ajax_gc_adm', 'false');\" class=\"materia_del\"><img src=\"".$url_virtual."imagens/site/resp-errada.png\" align=\"absmiddle\" ></a><br><br>";
				$texto .= '<b>�lbum: '.$l['nome_album'].'&nbsp;</b>';
				$texto .= '<input type="hidden" name="_id_album_blog_[]" value="'.$l['id_album'].'">';
				$texto .= '<input type="hidden" name="_id_produto_materia_[]" value="'.$l['id'].'">';
				$texto .= '<a id="add" class="ajuda" href="javascript:popup_geral_02(\'album_popup\',\'editar_album\', \''.$l['id_album'].'_'.$l['nome_album'].'\');"><img src="'.$url_virtual.'imagens/gc/btn_editor.gif" align="absmiddle" ><span>Clique aqui para editar o Album.</span></a><br>';		
				$texto .= '<b>Descri��o: </b><textarea name="_corpo_blog_[]" cols="80" rows="4">'.$l['corpo'].'</textarea><br/><br/>';
				
				$texto .= '<br/></div>';
			}
			$texto .= '<input type="hidden" name="_numero_campos_blog_ms" value="'.$cont.'">';
		}
		else
		{
			$texto = false;
		}
		
		return $texto;
	}
	
	function ilustra_imagem()
	{

		$o_ilustra = new Ilustra;
		$o_ilustra->set('album_id',$this->id_album);
		$o_ilustra->set('largura',$this->x);
		$o_ilustra->set('altura',$this->y);
		$o_ilustra->set('limite',$this->limite);
		$o_ilustra->set('pasta',$this->pasta);
		$o_ilustra->set('endereco_base','s');
		$o_ilustra->set('separador',' ');
		$o_ilustra->set('url',$this->url);
		$o_ilustra->set('acao_click', $this->click);
		$o_ilustra->set('div_imagem', $this->div_imagem);
		$o_ilustra->set('ordenador', $this->ordenador);
		$o_ilustra->set('not_in', $this->not_in);
		$foto = $o_ilustra->galeria();
		
		unset($o_ilustra);
		
		return $foto;
	}
	
	function css_imagem()
	{
		$o_configuracao = new Configuracao;
		$url_virtual = $o_configuracao->url_virtual();
		$o_css = new Css;
		$o_css->set('id', '1');
		if($rs = $o_css->selecionar())
		{
			foreach($rs as $l)
			{
				switch($this->parametro)
				{
					case 'fundo':
						$nome_img = $l['bg_body_img'];
						$case = "bg_body_img";
					break;
					
					case 'bg_menu_topo':
						$nome_img = $l['bg_menu_topo_img'];
						$case = "bg_menu_topo_img";
					break;
					
					case 'bg_banner':
						$nome_img = $l['bg_banner_img'];
						$case = "bg_banner_img";
					break;
					
					case 'bg_linha_divisoria':
						$nome_img = $l['bg_linha_divisoria_img'];
						$case = "bg_linha_divisoria_img";
					break;
					
					case 'logo':
						$nome_img = $l['logo'];
						$case = "logo";
					break;
				}
			}
			
			$l = getimagesize("".$url_virtual."imagens/site_gc/".$nome_img."");
			$imagem = " 
				<div class=\"img_css\">
					<img width=\"".$l[0]."\" height=\"".$l[1]."\" src=\"".$url_virtual."imagens/site_gc/".$nome_img."\" \">
					<a title=\"Eliminar Imagem\" href=\"javascript:ajax_pagina('upload_bgs','excluir', '".$case."', '', '', '', '', '', '', '', '".$this->div."', 'ajax_gc_adm', 'false');\">
					<img src=\"".$url_virtual."imagens/site/resp-errada.png\" /></a>
				</div>";
		
		}
		else
		{
			$imagem = false;
		}
		
		return $imagem;
		unset($o_configuracao);
	}
}
?>