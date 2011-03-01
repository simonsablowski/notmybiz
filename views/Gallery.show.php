<? $this->displayView('components/header.php'); ?>
<? $isAlbum = $Album instanceof GalleryAlbum; if ($isAlbum): ?>
					<h2>
<? foreach ($Album->getAncestors() as $Ancestor): ?>
						<a class="path-part" href="<? echo $this->getApplication()->getConfiguration('basePath') . $Ancestor->getKey(); ?>"><? echo $this->localize($Ancestor->getTitle()); ?></a>
<? endforeach; ?>
						<? echo $this->localize($Album->getTitle()); ?>

					</h2>
					<div id="gallery" style="display: none;">
						<img id="current_image" src="" title="" alt=""/>
						<p id="current_title"></p>
						<p id="current_description"></p>
						<div class="controls">
							<a class="control" id="previous_link" href="#">&nbsp;</a>
							<a class="control" id="play_link" href="#">&nbsp;</a><a class="control" id="stop_link" style="display: none;" href="#">&nbsp;</a>
							<a class="control" id="next_link" href="#">&nbsp;</a>
							<a class="control" id="hide_link" href="#">&nbsp;</a>
						</div>
					</div>
<? endif; ?>
<? if (count($Albums)): ?>
					<ul class="albums">
<? foreach ($Albums as $n => $Album): ?>
						<li class="<? echo ($n + 1) % 2 ? 'odd' : 'even'; ?><? if (($n + 1) % 3 == 0) echo ' last-in-row'; ?> album">
							<h<? echo $isAlbum ? 3 : 2; ?>>
								<a href="<? echo $this->getApplication()->getConfiguration('basePath') . $Album->getKey(); ?>"><? echo $this->localize($Album->getTitle()); ?></a>
							</h3>
<? if ($Album->getDescription()): ?>
							<p>
								<? echo $album->getDescription(); ?>
							</p>
<? endif; ?>
<? if ($PreviewImage = $Album->getPreviewImage()): ?>
							<div class="preview_image">
								<a href="<? echo $this->getApplication()->getConfiguration('basePath') . $Album->getKey(); ?>"><img src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>imgproc/<? echo urldecode($PreviewImage->getFileName()); ?>/?w=280&h=280&m=crop" alt="<? echo $PreviewImage->getTitle(); ?>" title="<? echo $PreviewImage->getTitle(); ?>"/></a>
							</div>
<? endif; ?>
						</li>
<? endforeach; ?>
					</ul>
<? endif; ?>
<? if (count($Images)): ?>
					<ul class="gallery images">
<? foreach ($Images as $n => $Image): ?>
						<li class="<? echo ($n + 1) % 2 ? 'odd' : 'even'; ?><? if (($n + 1) % 4 == 0) echo ' last-in-row'; ?> image">
							<a href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>imgproc/<? echo urldecode($Image->getFileName()); ?>/?h=500"><img src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>imgproc/<? echo $Image->getFileName(); ?>/?w=200&amp;h=200&amp;m=crop" alt="<? echo $Image->getTitle(); ?>" title="<? echo $Image->getTitle(); ?>"/></a>
						</li>
<? endforeach; ?>
					</ul>
<? if ($pagination['last'] > 1): ?>
					<div class="pagination">
						<? if ($pagination['current'] != $pagination['first']): ?><a class="first page" href="?page=<? echo $pagination['first']; ?>">&nbsp;</a><? else: ?><span class="first page">&nbsp;</span><? endif; ?>

						<? if ($pagination['current'] != $pagination['previous']): ?><a class="previous page" href="?page=<? echo $pagination['previous']; ?>">&nbsp;</a><? else: ?><span class="previous page">&nbsp;</span><? endif; ?>

<? foreach (range($pagination['first'], $pagination['last']) as $page): ?>
						<? if ($pagination['current'] != $page): ?><a class="page" href="?page=<? echo $page; ?>"><? echo $page; ?></a><? else: ?><span class="page"><? echo $page; ?></span><? endif; ?>

<? endforeach; ?>
						<? if ($pagination['current'] != $pagination['next']): ?><a class="next page" href="?page=<? echo $pagination['next']; ?>">&nbsp;</a><? else: ?><span class="next page">&nbsp;</span><? endif; ?>

						<? if ($pagination['current'] != $pagination['last']): ?><a class="last page" href="?page=<? echo $pagination['last']; ?>">&nbsp;</a><? else: ?><span class="last page">&nbsp;</span><? endif; ?>

					</div>
<? endif; ?>
<? endif; ?>
					<script type="text/javascript" src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>js/lightbox.js"></script>
					<script type="text/javascript" src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>js/gallery.js"></script>
<? $this->displayView('components/footer.php'); ?>