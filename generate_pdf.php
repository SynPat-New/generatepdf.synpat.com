<?php
require_once("dompdf_config.inc.php");
if(isset( $_POST["data"] ) ) {
	$postData = json_decode($_POST["data"],true);
	print_r($postData);
	die;
	$textContent = "";
	$comparableData = $postData['links'];
	
	print_r($comparableData);
	die;
	for($l=0;$l<count($comparableData);$l++){
		$linksFile = $comparableData[$l];
		if(!empty($linksFile)){
			$info = new SplFileInfo($linksFile);
			$fileExt = $info->getExtension();
			if(trim($fileExt) =="txt"){
				$textContent .= '<pre style="word-wrap: break-word; white-space: pre-wrap;">';
				$textContent .= htmlspecialchars(file_get_contents($linksFile),ENT_QUOTES);			
				$textContent .= '</pre>';
			} else {
				$textContent .=file_get_contents($linksFile);
			}
		}
		if ( get_magic_quotes_gpc() )
		$textContent = stripslashes($textContent);
	}
	echo $textContent;
	die;
  $dompdf = new DOMPDF();
  $dompdf->load_html($textContent);
  $dompdf->set_paper($_POST["paper"], $_POST["orientation"]);
  $dompdf->render();
  $output = $dompdf->output();
  $dompdf->stream("dompdf_out.pdf");
  echo $output;
  exit(0);
}