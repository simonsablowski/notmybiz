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
}