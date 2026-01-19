<?php

require_once("dompdf_config.inc.php");
if(isset( $_POST ) ) {
	$postData = $_POST;
	/*$parentFileName = $_SERVER['DOCUMENT_ROOT'].'/store/'.$postData['license'].'/parent_file.pdf';
	if(!file_exists($parentFileName)){
		$fhParent = fopen($parentFileName, "w+");
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://dev.synpat.com/customers/file_content', 
			CURLOPT_USERAGENT => 'Send Request for create demo portfolio',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => array(
				'file_url' => $postData['parent']
			)
		));
		$resp = curl_exec($curl);
		if($resp){
			if(!empty($resp)){
				fwrite($fhParent, $resp);
				fclose($fhParent);
			}
		} 
	}*/

	$textContent = stripslashes($postData['content']);	

	$style = '<style>.ui-state-default,

.ui-widget-content .ui-state-default,

.ui-widget-header .ui-state-default {

	border: 1px solid #990000;

	background: #990000;

	font-weight: bold;

	color: #FFFFFF;

}

.tabs-page .left-assets {

    padding: 0px;

    width: 100%;

    float: left

}

.assetsNav1-title {

    font-size: 14px;

    margin-bottom: 0;

    font-weight: bold;

    white-space: nowrap;

    border-bottom: 1px solid #e5e5e5;

    padding-bottom: 5px;

    color: #990000;

    margin-top: 25px;

    margin-top: 0;

    width: 100%;

    float: none

}

p {

    margin: 0px !important;

    margin-bottom: 10px !important;

}

/** Damages form */



.damages-form {

    padding-right: 4px;

}

.damages-form label {

    display: block;

    margin-bottom: 3px;

    margin-top: 10px;

}

.damages-form label b {

    display: inline-block;

    vertical-align: middle;

    width: 255px;

}

.damages-form label span{

	vertical-align: middle;

}

.damages-form input[type=text] {

    outline: none !important;

    padding: 5px 10px;

    vertical-align: middle;

    width: 99px;

}

.damages-form input[type=text].text-center {

    text-align: center;

}

.damages-form-output {

    background: #990000;

    color: #ffffff;

    display: inline-block;

    margin: 0;

    padding: 5px 10px;

    text-align: center;

    vertical-align: middle;

    width: 99px;

}

.damages-form .ui-slider-horizontal {

    background: #CD3333;

    border: none;

    display: inline-block;

    height: 0.15em;

    margin-right: 11px;

    margin-right: 0;

    margin-top: 10px;

    position: relative;

    width: 100px;

}

.damages-form-output{width:80px}

.damages-form .ui-slider .ui-slider-range {

    background: #CD3333;

}

.damages-form .ui-slider-horizontal .ui-slider-handle {

    background: #CD3333 !important;

    border-color: #CD3333;

    height: 8px;

    margin-left: -4px !important;

    margin-right: 0 !important;

    position: absolute;

    top: -3px;

    width: 8px;

}

</style>';



	$dompdf = new DOMPDF();

	$dompdf->load_html($style.$textContent);

	$dompdf->set_paper("letter","portrait");

	$dompdf->render();

	$output = $dompdf->output();

	$outputName = $_SERVER['DOCUMENT_ROOT'].'/store/'.$postData['license'].'/content.pdf';
	
	$fh = fopen($outputName, "w+");

	fwrite($fh, $output);

	fclose($fh);
	
	/*$fileArray= array($_SERVER['DOCUMENT_ROOT'].'/store/'.$postData['license'].'/content.pdf');

	$outputName = $_SERVER['DOCUMENT_ROOT'].'/store/'.$postData['license'].'/royalties.pdf';

	include 'PDFMerger.php';

	$pdf = new PDFMerger;

	$pdf->addPDF($_SERVER['DOCUMENT_ROOT'].'/store/'.$postData['license'].'/content.pdf', 'all')
	->merge('file', $outputName);*/

	echo str_replace($_SERVER['DOCUMENT_ROOT'],'http://www.synpat.com',$outputName); 

	exit(0);

}