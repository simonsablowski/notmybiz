<?php

class GalleryAlbum extends Gallery {
	protected $fields = array(
		'id',
		'key',
		'ParentId',
		'title',
		'description',
		'position',
		'status',
		'created',
		'modified'
	);
	protected $requiredFields = array(
		'key',
		'title'
	);
	
	protected $Parent = NULL;
	protected $PreviewImage = NULL;
	
	protected function loadParent() {
		try {
			$this->setParent(self::find($this->getParentId()));
		} catch (Error $Error) {
			$this->setParent(NULL);
		}
	}
	
	protected function loadAncestors() {
		$Ancestors = array($this);
		if ($Parent = $this->getParent()) {
			$Ancestors = array_merge($Parent->loadAncestors(), $Ancestors);
		}
		
		return $Ancestors;
	}
	
	public function getAncestors() {
		$Ancestors = $this->loadAncestors();
		array_pop($Ancestors);
		
		return $Ancestors;
	}
	
	public function getAlbums() {
		return GalleryAlbum::findAll(array(
			'ParentId' => $this->getId()
		));
	}
	
	public function getImages($imagesPerPage) {
		return GalleryImage::findAll(array(
			'AlbumId' => $this->getId()
		), NULL, $imagesPerPage);
	}
	
	protected function loadPreviewImage() {
		try {
			return $this->setPreviewImage(GalleryImage::findFirst(array(
				'AlbumId' => $this->getId(),
				'preview' => 'yes'
			)));
		} catch (Error $Error) {
			foreach ($this->getAlbums() as $Album) {
				if ($PreviewImage = $Album->getPreviewImage()) {
					return $this->setPreviewImage($PreviewImage);
				}
			}
		}
	}
}