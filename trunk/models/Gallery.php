<?php

abstract class Gallery extends Model {
	public static function getIndexAlbums() {
		return GalleryAlbum::findAll(array(
			'ParentId' => ''
		));
	}
	
	public static function getNumberIndexImages() {
		return GalleryImage::countAll(array(
			'AlbumId' => ''
		));
	}
	
	public static function getIndexImages($imagesPerPage = NULL) {
		return GalleryImage::findAll(array(
			'AlbumId' => ''
		), NULL, $imagesPerPage);
	}
}