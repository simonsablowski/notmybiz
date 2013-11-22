<?php $this->displayView('components/header.php'); ?>
			<article id="body">
<?php $fields = array('Message'); if ($this->getApplication()->getConfiguration('debugMode')) $fields = array_merge($fields, array('Details', 'Trace')); ?>
<?php foreach ($fields as $n => $field): ?>
				<div class="<?php if ($n + 1 == count($fields)) echo 'last '; echo $n % 2 ? 'odd' : 'even'; ?>">
<?php $getter = 'get' . $field; ?>
<?php if ($field != 'Details' && $field != 'Trace'): ?>
					<?php echo $this->localize($Error->$getter()); ?>
<?php else: ?>
					<div class="highlight">
						<?php var_dump($Error->$getter()); ?>
					</div>
<?php endif; ?>

					<p>&nbsp;</p>
				</div>
<?php endforeach; ?>
			</article>
<?php $this->displayView('components/footer.php'); ?>