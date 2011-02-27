<?php

class GalleryController extends Controller {
	protected $imagesPerPage = 12;
	
	public function show($key = '') {
		if (!empty($key)) {
			$Album = GalleryAlbum::findByKey($key);
			$Albums = $Album->getAlbums();
			$Images = $Album->getImages($this->getImagesPerPage());
		} else {
			$Album = NULL;
			$Albums = Gallery::getIndexAlbums();
			$Images = Gallery::getIndexImages($this->getImagesPerPage());
		}
		
		$this->displayView('Gallery.show.php', array(
			'Album' => $Album,
			'Albums' => $Albums,
			'Images' => $Images
		));
	}
}