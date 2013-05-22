<?php
class Resize_img
{
    private $nome_imagem;
    private $ruta_imagem;
    private $largura;
    private $altura;
    private $qualidade;
	
    function set($prop, $value)
	{
        $this->$prop = $value;
    }

    function __construct()
	{

    }
	
	function __destruct()
	{

    }
	function resize_imagem()
	{
		ob_start();
		$ruta_imagem = $this->ruta_imagem.$this->nome_imagem;
		$nome_imagem = $this->nome_imagem;
		//descobre extensão
		$t_img = strlen($ruta_imagem);
		$t_img = $t_img - 3;
		$imagem = substr($ruta_imagem, $t_img,3);

		switch($imagem)
		{
			case "jpg":
			case "JPG":
			header("Content-type: image/jpeg");
			$im = imagecreatefromjpeg($ruta_imagem);
			break;

			case "gif":
			case "GIF":
			header("Content-type: image/gif");
			$im = imagecreatefromgif($ruta_imagem);
			break;

			case "png":
			case "PNG":
			header("Content-type: image/x-png");
			$im = imagecreatefrompng($ruta_imagem);
			break;

			default:
			header("Content-type: image/jpeg");
			break;
		}

		$largura = imagesx($im);
		$altura = imagesy($im);

		$nova_altura = $this->altura;

		if($this->largura)
		{
			$nova_largura = $this->largura;
		}
		else
		{
			$nova_largura = ($largura*$nova_altura)/$altura;
		}

		if($nova_altura != "")
		{}
		else
		{
			$nova_altura = ceil(($nova_largura / $largura) * $altura);
		}

		if(!$this->qualidade){$qualidade = 100;} else {$qualidade = $this->qualidade;}

		$nova = imagecreatetruecolor($nova_largura,$nova_altura);
		//imagecopyresized($nova,$im,0,0,0,0,$largurad,$alturad,$largurao,$alturao);
		imagecopyresampled($nova, $im, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura, $altura);
		imagejpeg($nova, '../../imagens/galeria_thumbnail/'.$nome_imagem , $qualidade);
		imagedestroy($nova);
		imagedestroy($im);
	
	}
}
?>