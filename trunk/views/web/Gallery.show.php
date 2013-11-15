<? $isAlbum = $Album instanceof GalleryAlbum; ?>
<? $this->displayView('components/header.php', array(
	'subtitle' => $isAlbum ? $Album->getTitle() : NULL,
	'javaScriptFiles' => array(
		$this->getApplication()->getConfiguration('basePath') . 'js/jquery.history.js',
		$this->getApplication()->getConfiguration('basePath') . 'js/jquery.galleriffic.js',
		$this->getApplication()->getConfiguration('basePath') . 'js/jquery.opacityrollover.js',
		$this->getApplication()->getConfiguration('basePath') . 'js/gallery.js'
	)
)); ?>
<? if ($isAlbum): ?>
					<h2>
						<? foreach ($Album->getAncestors() as $Ancestor): ?><a class="path-part" href="<? echo $this->getApplication()->getConfiguration('basePath') . $Ancestor->getKey(); ?>"><? echo $this->localize($Ancestor->getTitle()); ?></a><? endforeach; ?><? echo $this->localize($Album->getTitle()); ?>

					</h2>
<? endif; ?>
<? $numberAlbums = count($Albums); ?>
<? if ($numberAlbums > 0): ?>
					<ul class="albums">
<? foreach ($Albums as $n => $Album): ?>
						<li class="<? echo ($n + 1) % 2 ? 'odd' : 'even'; ?><? if (($n + 1) % ($numberAlbums < 3 ? 2 : 3) == 0) echo ' last-in-row'; ?> album">
							<h<? echo $isAlbum ? 3 : 2; ?>>
								<a href="<? echo $this->getApplication()->getConfiguration('basePath') . $Album->getKey(); ?>"><? echo $this->localize($Album->getTitle()); ?></a>
							</h3>
<? if ($Album->getDescription()): ?>
							<p>
								<? echo $album->getDescription(); ?>
							</p>
<? endif; ?>
<? if ($PreviewImage = $Album->getPreviewImage()): ?>
							<div class="preview-image">
								<a href="<? echo $this->getApplication()->getConfiguration('basePath') . $Album->getKey(); ?>"><img src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>Image:show:<? echo urldecode($PreviewImage->getFileName()); ?>:<? if ($numberAlbums < 3): ?>434:434<? else: ?>280:280<? endif; ?>:true:false:80" alt="<? echo $PreviewImage->getTitle(); ?>" title="<? echo $PreviewImage->getTitle(); ?>"/></a>
							</div>
<? endif; ?>
						</li>
<? endforeach; ?>
					</ul>
<? endif; ?>
					<div id="gallery">
<? if (count($Images)): ?>
						<a class="previous page-link" style="visibility: hidden;" href="#" title="<? echo $this->localize('Previous page'); ?>">&larr;</a>
						<ul class="images thumbs">
<? foreach ($Images as $n => $Image): ?>
							<li class="<? echo ($n + 1) % 2 ? 'odd' : 'even'; ?><? if (($n + 1) % 10 == 0) echo ' last-in-row'; ?> image">
								<a class="thumb" href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>Image:show:<? echo urldecode($Image->getFileName()); ?>:896:500:false:false:90"><img src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>Image:show:<? echo urldecode($Image->getFileName()); ?>:75:75:true:true:80" alt="<? echo $Image->getTitle(); ?>" title="<? echo $Image->getTitle(); ?>"/></a>
							</li>
<? endforeach; ?>
						</ul>
						<a class="next page-link" style="visibility: hidden;" href="#" title="<? echo $this->localize('Next page'); ?>">&rarr;</a>
						<div id="loading"></div>
						<div id="slideshow"></div>
<? endif; ?>
					</div>
<? $this->displayView('components/footer.php'); ?>