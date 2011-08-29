<?php

class ImageController extends Controller {
	public function show($source, $width, $height, $crop, $grey, $quality) {
		$Image = new Image($source, $width, $height, $crop == 'true', $grey == 'true', $quality);
		$Image->setConfiguration($this->getConfiguration('Image'));
		$Image->analyze();
		$Image->convert();
		$Image->display();
	}
}