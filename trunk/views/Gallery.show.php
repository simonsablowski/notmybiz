<? $this->displayView('components/header.php'); ?>
	<body>
		<div id="document">
			<div id="head">
				<h1 id="logo">
					<a href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>" title="<? echo $this->localize('notmybiz'); ?>"><? echo $this->localize('not<em>my</em>biz'); ?></a>
				</h1>
			</div>
			<div id="body">
				<div id="content">
<? $isAlbum = $Album instanceof GalleryAlbum; if ($isAlbum): ?>
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
							<p><? echo $album->getDescription(); ?></p>
							<? endif; ?>
							<? if ($PreviewImage = $Album->getPreviewImage()): ?>
							<div class="preview_image">
								<a href="<? echo $this->getApplication()->getConfiguration('basePath') . $Album->getKey(); ?>"><img src="http://notmybiz.com/imgproc/<? echo urldecode($PreviewImage->getFileName()); ?>/?w=280&h=280&m=crop" alt="<? echo $PreviewImage->getTitle(); ?>" title="<? echo $PreviewImage->getTitle(); ?>"/></a>
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
							<a href="http://notmybiz.com/imgproc/<? echo urldecode($Image->getFileName()); ?>/?h=500"><img src="http://notmybiz.com/imgproc/<? echo $Image->getFileName(); ?>/?w=200&amp;h=200&amp;m=crop" alt="<? echo $Image->getTitle(); ?>" title="<? echo $Image->getTitle(); ?>"/></a>
						</li>
<? endforeach; ?>
					</ul>
<? endif; ?>
				</div>
			</div>
			<div id="foot">
				<p id="copyright">
					<? echo $this->localize('&copy; 2004-2011 <a href="%s">notmybiz</a>', $this->getConfiguration('basePath')); ?>

				</p>
				<ul id="meta_navigation">
					<li class="menu-item">
						<a class="external" href="http://motivado.com" title="motivado.com">motivado.com</a>
					</li>
					<li class="menu-item">
						<a class="external" href="http://fbrccn.com" title="fbrccn.com">fbrccn.com</a>
					</li>
					<li class="menu-item">
						<a class="external" href="http://simsab.de/en" title="simsab.de">simsab.de</a>
					</li>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
		<!--
		var gaJsHost = 'https:' == document.location.protocol ? 'https://ssl.' : 'http://www.';
		document.write(unescape('%3Cscript src="' + gaJsHost + 'google-analytics.com/ga.js" type="text/javascript"%3E%3C/script%3E'));
		try {
			var pageTracker = _gat._getTracker('UA-2644687-1');
			pageTracker._initData();
			pageTracker._trackPageview();
		} catch (error) {
			
		}
		//-->
		</script>
	</body>
<? $this->displayView('components/footer.php'); ?>