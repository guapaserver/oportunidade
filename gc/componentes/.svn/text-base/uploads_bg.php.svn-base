<?php
ob_start();
session_name("adm");
session_start("adm");
require_once("../../inc/includes.php");
/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
	/**
	 * Save the file to the specified path
	 * @return boolean TRUE on success
	 */
	function save($path) {    
		$input = fopen("php://input", "r");
		$temp = tmpfile();
		$realSize = stream_copy_to_stream($input, $temp);
		fclose($input);
		
		if ($realSize != $this->getSize()){            
			return false;
		}
		
		$target = fopen($path, "w");        
		fseek($temp, 0, SEEK_SET);
		stream_copy_to_stream($temp, $target);
		fclose($target);
		
		return true;
	}
	function getName() {
		return $_GET['qqfile'];
	}
	function getSize() {
		if (isset($_SERVER["CONTENT_LENGTH"])){
			return (int)$_SERVER["CONTENT_LENGTH"];            
		} else {
			throw new Exception('Getting content length is not supported.');
		}      
	}   
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {  
	/**
	 * Save the file to the specified path
	 * @return boolean TRUE on success
	 */
	function save($path) {
		if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
			return false;
		}
		return true;
	}
	function getName() {
		return $_FILES['qqfile']['name'];
	}
	function getSize() {
		return $_FILES['qqfile']['size'];
	}
}

class qqFileUploader {
	private $allowedExtensions = array();
	private $sizeLimit = 10485760;
	private $file;

	function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){        
		$allowedExtensions = array_map("strtolower", $allowedExtensions);
			
		$this->allowedExtensions = $allowedExtensions;        
		$this->sizeLimit = $sizeLimit;
		
		$this->checkServerSettings();       

		if (isset($_GET['qqfile'])) {
			$this->file = new qqUploadedFileXhr();
		} elseif (isset($_FILES['qqfile'])) {
			$this->file = new qqUploadedFileForm();
		} else {
			$this->file = false; 
		}
	}
	
	private function checkServerSettings(){        
		$postSize = $this->toBytes(ini_get('post_max_size'));
		$uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
		
		if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
			$size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
			die("{'error':'increase post_max_size and upload_max_filesize to $size'}");    
		}        
	}
	
	private function toBytes($str){
		$val = trim($str);
		$last = strtolower($str[strlen($str)-1]);
		switch($last) {
			//case 'g': $val *= 10240;
			//case 'm': $val *= 1024;
			//case 'k': $val *= 1024;        
			case 'g': $val *= 10240000;
			case 'm': $val *= 10240000;
			case 'k': $val *= 10240000;        
		}
		return $val;
	}
	
	/**
	 * Returns array('success'=>true) or array('error'=>'error message')
	 */
	function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
		
		if (!is_writable($uploadDirectory)){
			return array('error' => "Server error. Upload directory isn't writable.");
		}
		
		if (!$this->file){
			return array('error' => 'No files were uploaded.');
		}
		
		$size = $this->file->getSize();
		
		if ($size == 0) {
			return array('error' => 'File is empty');
		}
		if ($size > $this->sizeLimit) {
			return array('error' => 'File is too large');
		}

		
		
		$pathinfo = "";
		$pathinfo = pathinfo($this->file->getName());
		$filename = $pathinfo['filename'];
		//$filename = md5(uniqid());
		
		$ext = $pathinfo['extension'];
		
		$ext = (string)$ext;
		
		if($ext == "jpeg" || $ext == "JPEG" || $ext == "jpg" || $ext == "JPG")
		{
			$ext = "jpg";
		}

		if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
			$these = implode(', ', $this->allowedExtensions);
			return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
		}
		
		$filename = $_REQUEST['nome_bg'];
		$filename = $this->carateres_especiais($filename);

		$o_css = new Css;
		$o_css->set('id', '1');
		
		switch($filename)
		{
			case 'fundo':
				$o_css->set('bg_body_img', $filename. '.' . $ext);
			break;
			
			case 'bg_menu_topo':
				$o_css->set('bg_menu_topo_img', $filename. '.' . $ext);
			break;
			
			case 'bg_banner':
				$o_css->set('bg_banner_img', $filename. '.' . $ext);
			break;
			
			case 'bg_linha_divisoria':
				$o_css->set('bg_linha_divisoria_img', $filename. '.' . $ext);
			break;
			
			case 'logo':
				$o_css->set('logo', $filename. '.' . $ext);
			break;
		}
		
		$o_css->editar_bg();
		
		if ($this->file->save($uploadDirectory . $filename. '.' . $ext)){
			return array('success'=>true);
		} else {
			return array('error'=> 'Could not save uploaded file.' .
				'The upload was cancelled, or server error encountered');
		}
	}    
	
	function carateres_especiais($nome){
	  $n_n = str_replace(" ","_",$nome);   
	  $n_n = str_replace("á","a",$n_n);
	  $n_n = str_replace("é","e",$n_n);
	  $n_n = str_replace("í","i",$n_n);
	  $n_n = str_replace("ó","o",$n_n);
	  $n_n = str_replace("ú","u",$n_n);
	  $n_n = str_replace("ç","c",$n_n);
	  $n_n = str_replace("ã","a",$n_n);
	  $n_n = str_replace("â","a",$n_n);
	  $n_n = str_replace("õ","o",$n_n);
	  $n_n = str_replace("!","",$n_n);
	  $n_n = str_replace("?","",$n_n);
	  $n_n = str_replace(":","",$n_n);
	  $n_n = str_replace("[","",$n_n);
	  $n_n = str_replace("]","",$n_n);
	  $n_n = str_replace("(","",$n_n);
	  $n_n = str_replace(")","",$n_n);
	  
	  return $n_n;
	}
}

// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array();
// max file size in bytes
$sizeLimit = 10 * 1024 * 1024;

$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
//$result = $uploader->handleUpload('uploads/');
if($_SESSION['rota_upload_imagem'])
{
	$result = $uploader->handleUpload($_SESSION['rota_upload_imagem']);
}
else
{	
	$result = $uploader->handleUpload('../../imagens/site_gc/');
}
// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
