				</div>
			</div>
			<div id="foot">
				<p id="copyright">
					<? echo $this->localize('&copy; 2004-%d <a href="%s">notmybiz</a>', array(date('Y'), $this->getConfiguration('basePath'))); ?>

				</p>
				<ul id="menu">
<? foreach ($this->getConfiguration('partnerSites') as $title => $url): ?>
					<li class="menu-item">
						<a href="<? echo $url; ?>" title="<? echo $title; ?>"><? echo $title; ?></a>
					</li>
<? endforeach; ?>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
		<!--
		var gaJsHost = 'https:' == document.location.protocol ? 'https://ssl.' : 'http://www.';
		document.write(unescape('%3Cscript src="' + gaJsHost + 'google-analytics.com/ga.js" type="text/javascript"%3E%3C/script%3E'));		//-->
		</script>
		<script type="text/javascript">
		<!--
		try {
			var pageTracker = _gat._getTracker('UA-2644687-1');
			pageTracker._initData();
			pageTracker._trackPageview();
		} catch (error) {
			
		}
		//-->
		</script>
	</body>
</html>
