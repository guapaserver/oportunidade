<?php
class Css extends Executa
{
	private $id;
	private $bg_body; 
	private $bg_body_img; 
	private $bg_destaque; 
	private $destaque_sombra; 
	private $destaque_borda; 
	private $radio_borda; 
	private $tamanho_borda_destaque; 
	private $altura_menu_topo;
	private $bg_menu_topo;
	private $bg_menu_topo_img;
	private $altura_banner;
	private $bg_banner;
	private $bg_banner_img;
	private $bg_linha_menu;
	private $altura_linha_divisoria;
	private $bg_linha_divisoria;
	private $bg_linha_divisoria_img;
	private $logo;
	private $logo_online;
	private $logo_float;
	private $corpo;
	private $criterio;
	
	private $limite;
	private $ordenador;
	private $termo_busca;
	
	private $busca;			
	private $q;			
	private $prefixo;
	
	function __construct()
	{
		parent::__construct();
		$this->prefixo = $this->prefixo();
	}

	function __destruct()
	{
		
	}
	
	public function selecionar()
	{
		$q = "				

		SELECT
		id
		 ,bg_body 
		 ,bg_body_img 
		 ,bg_destaque 
		 ,destaque_sombra 
		 ,destaque_borda 
		 ,radio_borda 
		 ,tamanho_borda_destaque 
		 ,altura_menu_topo
		 ,bg_menu_topo
		 ,bg_menu_topo_img
		 ,altura_banner
		 ,bg_banner
		 ,bg_banner_img
		 ,bg_linha_menu
		 ,altura_linha_divisoria
		 ,bg_linha_divisoria
		 ,bg_linha_divisoria_img
		 ,logo
		 ,logo_online
		 ,logo_float
		 ,corpo
		";
		
		$q .= "FROM ".$this->prefixo."_tbl_css 
		WHERE 
		1=1  
		";
		
		$q .= !empty($this->id) ? "AND id = '".$this->id."' " : " ";
		$q .= !empty($this->criterio) ? "AND ".$this->criterio." " : " ";
 		
		$q .= !empty($this->ordenador) ? "ORDER BY ".$this->ordenador."" : " ORDER BY id DESC ";
		
		$q .= !empty($this->limite) ? " LIMIT 0, ".$this->limite." " : " ";

		$this->sql = $q;
		$stmt = $this->executar();

		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}	
	
	public function editar()
	{
		$q = "
		
		UPDATE ".$this->prefixo."_tbl_css SET 
		
		bg_body= '".$this->bg_body."', 
		bg_body_img= '".$this->bg_body_img."', 
		bg_destaque= '".$this->bg_destaque."', 
		destaque_sombra= '".$this->destaque_sombra."', 
		destaque_borda= '".$this->destaque_borda."', 
		radio_borda= '".$this->radio_borda."', 
		tamanho_borda_destaque= '".$this->tamanho_borda_destaque."', 
		altura_menu_topo= '".$this->altura_menu_topo."',
		bg_menu_topo= '".$this->bg_menu_topo."',
		bg_menu_topo_img= '".$this->bg_menu_topo_img."',
		altura_banner= '".$this->altura_banner."',
		bg_banner= '".$this->bg_banner."',
		bg_banner_img= '".$this->bg_banner_img."',
		bg_linha_menu= '".$this->bg_linha_menu."',
		altura_linha_divisoria= '".$this->altura_linha_divisoria."',
		bg_linha_divisoria= '".$this->bg_linha_divisoria."',
		bg_linha_divisoria_img= '".$this->bg_linha_divisoria_img."',
		logo= '".$this->logo."',
		logo_float= '".$this->logo_float."'
		
		WHERE id='".$this->id."'
		
		";
		
		//Envia a string de consulta
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}
	
	public function editar_bg()
	{
		$q = " UPDATE ".$this->prefixo."_tbl_css SET ";
		
		$q .= !empty($this->id) ? " id = '".$this->id."' " : " ";
		$q .= !empty($this->bg_body) ? " ,bg_body= '".$this->bg_body."' " : " ";
		$q .= !empty($this->bg_body_img) ? " ,bg_body_img= '".$this->bg_body_img."' " : " ";
		$q .= !empty($this->bg_destaque) ? " ,bg_destaque= '".$this->bg_destaque."' " : " ";
		$q .= !empty($this->destaque_sombra) ? " ,destaque_sombra= '".$this->destaque_sombra."' " : " ";
		$q .= !empty($this->destaque_borda) ? " ,destaque_borda= '".$this->destaque_borda."' " : " ";
		$q .= !empty($this->radio_borda) ? " ,radio_borda= '".$this->radio_borda."' " : " ";
		$q .= !empty($this->tamanho_borda_destaque) ? " ,tamanho_borda_destaque= '".$this->tamanho_borda_destaque."' " : " ";
		$q .= !empty($this->bg_menu_topo) ? " ,bg_menu_topo= '".$this->bg_menu_topo."' " : " ";
		$q .= !empty($this->altura_menu_topo) ? " ,altura_menu_topo= '".$this->altura_menu_topo."' " : " ";
		$q .= !empty($this->bg_menu_topo_img) ? " ,bg_menu_topo_img= '".$this->bg_menu_topo_img."' " : " ";
		$q .= !empty($this->altura_banner) ? " ,altura_banner= '".$this->altura_banner."' " : " ";
		$q .= !empty($this->bg_banner) ? " ,bg_banner= '".$this->bg_banner."' " : " ";
		$q .= !empty($this->bg_linha_menu) ? " ,bg_linha_menu= '".$this->bg_linha_menu."' " : " ";
		$q .= !empty($this->altura_linha_divisoria) ? " ,altura_linha_divisoria= '".$this->altura_linha_divisoria."' " : " ";
		$q .= !empty($this->bg_banner_img) ? " ,bg_banner_img= '".$this->bg_banner_img."' " : " ";
		$q .= !empty($this->bg_linha_divisoria) ? " ,bg_linha_divisoria= '".$this->bg_linha_divisoria."' " : " ";
		$q .= !empty($this->bg_linha_divisoria_img) ? " ,bg_linha_divisoria_img= '".$this->bg_linha_divisoria_img."' " : " ";
		$q .= !empty($this->logo) ? " ,logo= '".$this->logo."' " : " ";		
		$q .= !empty($this->logo_online) ? " ,logo_online= '".$this->logo_online."' " : " ";		
		$q .= !empty($this->logo_float) ? " ,logo_float= '".$this->logo_float."' " : " ";		
		
		$q .= " WHERE id='".$this->id."' ";
		
		//Envia a string de consulta
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}	
	
	public function excluir_campo()
	{
		$q = " UPDATE ".$this->prefixo."_tbl_css SET ";
		
		$q .= !empty($this->id) ? " id = '".$this->id."' " : " ";
		$q .= !empty($this->bg_body_img) ? " ,bg_body_img = '' " : " ";
		$q .= !empty($this->bg_menu_topo_img) ? " ,bg_menu_topo_img= '' " : " ";
		$q .= !empty($this->bg_banner_img) ? " ,bg_banner_img= '' " : " ";
		$q .= !empty($this->bg_linha_divisoria_img) ? " ,bg_linha_divisoria_img= '' " : " ";
		$q .= !empty($this->logo) ? " ,logo= '".$this->logo."' " : " ";		
		
		$q .= " WHERE id='".$this->id."' ";
		
		//Envia a string de consulta
		$this->sql = $q;
		$stmt = $this->executar();
		
		//verifica se houve um retorno maior que 0
		if($stmt->rowCount() > 0)
		{
			return $stmt;
		}
		else
		{
			return false;
		}
	}	
	
	function set($prop, $value)
	{
      $this->$prop = $value;
	}
}

?>