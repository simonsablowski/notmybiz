<?php

abstract class Gallery extends Model {
	protected static $defaultSorting = array(
		'position' => 'ascending'
	);
	
	public static function getIndexAlbums() {
		return GalleryAlbum::findAll(array(
			'ParentId' => ''
		));
	}
	
	public static function getIndexImages($imagesPerPage) {
		return GalleryImage::findAll(array(
			'AlbumId' => ''
		), NULL, $imagesPerPage);
	}
}