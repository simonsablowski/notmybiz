<? $isAlbum = $Album instanceof GalleryAlbum; $this->displayView('components/header.php', $isAlbum ? array('subtitle' => $Album->getTitle()) : array()); ?>
					<script type="text/javascript" src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>js/jquery-1.3.2.js"></script>
					<script type="text/javascript" src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>js/jquery.history.js"></script>
					<script type="text/javascript" src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>js/jquery.galleriffic.js"></script>
					<script type="text/javascript" src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>js/jquery.opacityrollover.js"></script>
<? if ($isAlbum): ?>
					<h2>
<? foreach ($Album->getAncestors() as $Ancestor): ?>
						<a class="path-part" href="<? echo $this->getApplication()->getConfiguration('basePath') . $Ancestor->getKey(); ?>"><? echo $this->localize($Ancestor->getTitle()); ?></a>
<? endforeach; ?>
						<? echo $this->localize($Album->getTitle()); ?>

					</h2>
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
							<div class="preview-image">
								<a href="<? echo $this->getApplication()->getConfiguration('basePath') . $Album->getKey(); ?>"><img src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>imgproc/<? echo urldecode($PreviewImage->getFileName()); ?>/?w=280&amp;h=280&amp;m=crop" alt="<? echo $PreviewImage->getTitle(); ?>" title="<? echo $PreviewImage->getTitle(); ?>"/></a>
							</div>
<? endif; ?>
						</li>
<? endforeach; ?>
					</ul>
<? endif; ?>
<? if (count($Images)): ?>
					<div id="gallery">
						<a class="previous page-link" style="visibility: hidden;" href="#" title="<? echo $this->localize('Previous page'); ?>">&larr;</a>
						<ul class="images thumbs">
<? foreach ($Images as $n => $Image): ?>
							<li class="<? echo ($n + 1) % 2 ? 'odd' : 'even'; ?><? if (($n + 1) % 10 == 0) echo ' last-in-row'; ?> image">
								<a class="thumb" href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>imgproc/<? echo urldecode($Image->getFileName()); ?>/?h=500&amp;w=800"><img src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>imgproc/<? echo $Image->getFileName(); ?>/?w=75&amp;h=75&amp;m=crop" alt="<? echo $Image->getTitle(); ?>" title="<? echo $Image->getTitle(); ?>"/></a>
							</li>
<? endforeach; ?>
						</ul>
						<a class="next page-link" style="visibility: hidden;" href="#" title="<? echo $this->localize('Next page'); ?>">&rarr;</a>
					</div>
					<div id="slideshow"></div>
					<script type="text/javascript">
					jQuery(document).ready(function($) {
						var onMouseOutOpacity = 0.5;
						$('#gallery ul.thumbs li').opacityrollover({
							mouseOutOpacity: onMouseOutOpacity,
							mouseOverOpacity: 1.0,
							fadeSpeed: 'fast',
							exemptionSelector: '.selected'
						});
						
						var gallery = $('#gallery').galleriffic({
							numThumbs: 10,
							preloadAhead: 10,
							enableBottomPager: false,
							imageContainerSel: '#slideshow',
							loadingContainerSel: '#loading',
							enableHistory: true,
							onSlideChange: function(prevIndex, nextIndex) {
								this.find('ul.thumbs').children()
									.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
									.eq(nextIndex).fadeTo('fast', 1.0);
							},
							onPageTransitionOut: function(callback) {
								this.fadeTo('fast', 0.0, callback);
							},
							onPageTransitionIn: function() {
								var prevPageLink = this.find('a.previous').css('visibility', 'hidden');
								var nextPageLink = this.find('a.next').css('visibility', 'hidden');
								
								if (this.displayedPage > 0)
									prevPageLink.css('visibility', 'visible');
								
								var lastPage = this.getNumPages() - 1;
								if (this.displayedPage < lastPage)
									nextPageLink.css('visibility', 'visible');
								
								this.fadeTo('fast', 1.0);
							}
						});
						
						gallery.find('a.previous').click(function(e) {
							gallery.previousPage();
							e.preventDefault();
						});
						
						gallery.find('a.next').click(function(e) {
							gallery.nextPage();
							e.preventDefault();
						});
						
						function pageload(hash) {
							if (hash) {
								$.galleriffic.gotoImage(hash);
							} else {
								gallery.gotoIndex(0);
							}
						}
						
						$.historyInit(pageload, "advanced.html");
						
						$("a[rel='history']").live('click', function(e) {
							if (e.button != 0) return true;
							
							var hash = this.href;
							hash = hash.replace(/^.*#/, '');
							
							$.historyLoad(hash);
							
							return false;
						});
					});
					</script>
<? endif; ?>
<? $this->displayView('components/footer.php'); ?>