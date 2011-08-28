<?php

class GalleryController extends Controller {
	public function show($key) {
		if (!empty($key)) {
			$Album = GalleryAlbum::findByKey($key);
			$Albums = $Album->getAlbums();
			$Images = $Album->getImages();
		} else {
			$Album = NULL;
			$Albums = Gallery::getIndexAlbums();
			$Images = Gallery::getIndexImages();
		}
		
		$this->displayView('Gallery.show.php', array(
			'Album' => $Album,
			'Albums' => $Albums,
			'Images' => $Images
		));
	}
	
	public function generateImages() {
		$this->setConfiguration($this->getConfiguration('Image'));
		
		if (is_null($this->getConfiguration('parameterSets'))) {
			throw new FatalError('Parameter sets not configured');
		}
		
		$Images = array();
		foreach (GalleryImage::findAll() as $GalleryImage) {
			foreach ($this->getConfiguration('parameterSets') as $parameterSet) {
				list($width, $height, $crop, $grey, $quality) = array_values($parameterSet);
				$Image = new Image($GalleryImage->getFileName(), $width, $height, $crop, $grey, $quality);
				$Image->setConfiguration($this->getConfiguration());
				$Image->analyze();
				$Image->convert();
				$Images[] = $Image;
			}
		}
		
		$this->displayView('Gallery.generateImages.php', array(
			'Images' => $Images
		));
	}
}