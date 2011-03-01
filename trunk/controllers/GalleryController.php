<?php

class GalleryController extends Controller {
	protected $imagesPerPage = 12;
	
	public function show($key) {
		$page = ($page = $this->getRequest()->getData('page')) ? $page : 1;
		
		if (!empty($key)) {
			$Album = GalleryAlbum::findByKey($key);
			$Albums = $Album->getAlbums();
			$pagination = Pagination::setup($Album->getNumberImages(), $this->getImagesPerPage(), $page);
			$Images = $Album->getImages(sprintf('%d, %d', $pagination['start'], $this->getImagesPerPage()));
		} else {
			$Album = NULL;
			$Albums = Gallery::getIndexAlbums();
			$pagination = Pagination::setup(Gallery::getNumberIndexImages(), $this->getImagesPerPage(), $page);
			$Images = Gallery::getIndexImages(sprintf('%d, %d', $pagination['start'], $this->getImagesPerPage()));
		}
		
		$this->displayView('Gallery.show.php', array(
			'Album' => $Album,
			'Albums' => $Albums,
			'Images' => $Images,
			'pagination' => $pagination
		));
	}
}