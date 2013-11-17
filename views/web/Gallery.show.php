<?php $isAlbum = $Album instanceof GalleryAlbum; ?>
<?php $this->displayView('components/header.php', array('pageTitle' => $isAlbum ? $Album->getTitle() : NULL)); ?>
			<div id="slideshow">
				<ul class="controls">
					<li class="control previous">
						<a href="#" title="<?php echo $this->localize('slideshow-previous'); ?>"><?php echo $this->localize('slideshow-previous'); ?></a>
					</li>
					<li class="control next">
						<a href="#" title="<?php echo $this->localize('slideshow-next'); ?>"><?php echo $this->localize('slideshow-next'); ?></a>
					</li>
					<li class="control close">
						<a href="#" title="<?php echo $this->localize('slideshow-close'); ?>"><?php echo $this->localize('slideshow-close'); ?></a>
					</li>
				</ul>
				<div class="current"></div>
			</div>
			<div id="body">
<?php if ($isAlbum): ?>
				<h2>
					<?php foreach ($Album->getAncestors() as $Ancestor): ?><a class="path-part" href="<?php echo $this->getApplication()->getConfiguration('basePath') . $Ancestor->getKey(); ?>"><?php echo $this->localize($Ancestor->getTitle()); ?></a><?php endforeach; ?><?php echo $this->localize($Album->getTitle()); ?>

				</h2>
<?php endif; ?>
				<div id="gallery">
<?php $numberAlbums = count($Albums); ?>
<?php if ($numberAlbums > 0): ?>
					<ul class="albums">
<?php foreach ($Albums as $n => $Album): ?>
						<li class="<?php echo ($n + 1) % 2 ? 'odd' : 'even'; ?><?php if (($n + 1) % ($numberAlbums < 3 ? 2 : 3) == 0) echo ' last-in-row'; ?> album">
							<h<?php echo $isAlbum ? 3 : 2; ?>>
								<a href="<?php echo $this->getApplication()->getConfiguration('basePath') . $Album->getKey(); ?>"><?php echo $this->localize($Album->getTitle()); ?></a>
							</h3>
<?php if ($Album->getDescription()): ?>
							<p>
								<?php echo $album->getDescription(); ?>
							</p>
<?php endif; ?>
<?php if ($PreviewImage = $Album->getPreviewImage()): ?>
							<div class="preview-image">
								<a href="<?php echo $this->getApplication()->getConfiguration('basePath') . $Album->getKey(); ?>"><img src="<?php echo $this->getApplication()->getConfiguration('mediaPath'); ?>Image:show:<?php echo urldecode($PreviewImage->getFileName()); ?>:<?php if ($numberAlbums < 3): ?>434:434<?php else: ?>280:280<?php endif; ?>:true:false:80" alt="<?php echo $PreviewImage->getTitle(); ?>" title="<?php echo $PreviewImage->getTitle(); ?>"/></a>
							</div>
<?php endif; ?>
						</li>
<?php endforeach; ?>
					</ul>
<?php endif; ?>
<?php if (count($Images)): ?>
					<ul class="images thumbnails">
<?php foreach ($Images as $n => $Image): ?>
						<li class="<?php echo ($n + 1) % 2 ? 'odd' : 'even'; ?><?php if (($n + 1) % 10 == 0) echo ' last-in-row'; ?> image thumbnail">
							<a href="<?php echo $this->getApplication()->getConfiguration('mediaPath'); ?>Image:show:<?php echo urldecode($Image->getFileName()); ?>:896:500:false:false:90"><img src="<?php echo $this->getApplication()->getConfiguration('mediaPath'); ?>Image:show:<?php echo urldecode($Image->getFileName()); ?>:75:75:true:true:80" alt="<?php echo $Image->getTitle(); ?>" title="<?php echo $Image->getTitle(); ?>"/></a>
						</li>
<?php endforeach; ?>
					</ul>
<?php endif; ?>
				</div>
			</div>
<?php $this->displayView('components/footer.php'); ?>