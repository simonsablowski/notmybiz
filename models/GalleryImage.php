<?php

class GalleryImage extends Gallery {
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
}