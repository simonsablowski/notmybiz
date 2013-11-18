<?php

class GalleryImage extends Gallery {
	protected static $defaultSorting = array(
		'AlbumId' => 'ascending',
		'position' => 'ascending'
	);
	protected $fields = array(
		'id',
		'AlbumId',
		'fileName',
		'title',
		'description',
		'position',
		'preview',
		'status',
		'created',
		'modified'
	);
	protected $requiredFields = array(
		'fileName'
	);
	
	protected $Album = null;
	
	protected function loadAlbum() {
		try {
			$this->setAlbum(GalleryAlbum::find($this->getAlbumId()));
		} catch (Error $Error) {
			$this->setAlbum(null);
		}
	}
}