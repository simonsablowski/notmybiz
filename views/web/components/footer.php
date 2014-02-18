		</div>
		<footer id="footer">
			<p id="copyright">
				<?php echo $this->localize('copyright', array(date('Y'))); ?> <a href="<?php echo $this->getConfiguration('basePath'); ?>"><?php echo $this->localize('document-title'); ?></a>
				&mdash; <a href="<?php echo $this->getConfiguration('basePath'); ?>disclaimer"><?php echo $this->localize('disclaimer-title'); ?></a>
			</p>
		</footer>
<?php echo $this->getConfiguration('trackingCode'); ?>

	</body>
</html>
