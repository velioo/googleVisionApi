<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$path =  $_SERVER['DOCUMENT_ROOT'] . '/googleVisionApi/' . 'vendor/autoload.php';
require_once $path;

use Google\Cloud\Vision\VisionClient;

class Image extends CI_Controller {
	
	private $projectId = 'learned-thunder-162918';
	
	public function index() {
	}
	
	public function send_image() {
		
		$filepath = $_SERVER['DOCUMENT_ROOT'] . '/googleVisionApi/assets/googlevisionapi.json';
		
		$vision = new VisionClient([
			'projectId' => $this->projectId,
			'keyFilePath' => $filepath
		]);
		
		# The name of the image file to annotate
		$fileName = $_SERVER['DOCUMENT_ROOT'] . '/googleVisionApi/assets/imgs/Emilia Cosplay.jpg';
		
		# Prepare the image to be annotated
		$image = $vision->image(fopen($fileName, 'r'), [
			'LABEL_DETECTION',
			'FACE_DETECTION',
			'TEXT_DETECTION',
			'DOCUMENT_TEXT_DETECTION'
		]);
		
		# Performs label detection on the image file
		$labels = $vision->annotate($image)->labels();
		$faces = $vision->annotate($image)->faces();
		$info = $vision->annotate($image)->info();
		
		echo "Labels:\n";
		var_dump($labels);
		//foreach ($labels as $label) {
		//	echo $label->description() . "\n";
		//}
		
		echo "Faces:\n";
		
		var_dump($faces);
		//foreach ($faces as $face) {
		//	var_dump($face) . "\n";
		//}
		
		echo "Raw Info:\n";
		var_dump($info);
		
	}
}
