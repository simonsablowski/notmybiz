<?php
echo $this->localize('Images') . "\n";
foreach ($Images as $n => $Image) {
	echo $n + 1 . ': ' . $Image->getCachePath . "\n";
}