<? $this->displayView('components/header.php'); ?>
	<body>
		<div id="document">
			<h1>
				Unfortunately,
			</h1>
			<h2>
				we encountered an error:
			</h2>
			<dl class="content">
				<dt class="head">
					Description
				</dt>
				<dd class="head">
					&nbsp;
				</dd>
				<dt class="even">
					Type:
				</dt>
				<dd class="even">
					<? echo $Error->getType(); ?>

				</dd>
<? if ($Error->getMessage()): ?>
				<dt class="odd">
					Message:
				</dt>
				<dd class="odd">
					<? echo $Error->getMessage(); ?>

				</dd>
<? endif; ?>
<? if ($this->getApplication()->getConfiguration('debugMode')): ?>
<? if ($Error->getDetails()): ?>
				<dt class="even">
					Details:
				</dt>
				<dd class="even">
					<div class="highlight">
<? var_dump($Error->getDetails()); ?>

					</div>
				</dd>
<? endif; ?>
<? if ($Error->getTrace()): ?>
				<dt class="odd">
					Trace:
				</dt>
				<dd class="odd">
					<div class="highlight">
<? var_dump($Error->getTrace()); ?>

					</div>
				</dd>
<? endif; ?>
<? endif; ?>
			</dl>
		</div>
	</body>
<? $this->displayView('components/footer.php'); ?>