<?php

error_reporting(E_ALL);

require_once dirname(__FILE__) . '/../configuration.php';
foreach ($configuration['includeDirectories'] as $includeDirectory) {
	if (file_exists($filePath = $includeDirectory . 'Application.php')) break include $filePath;
}

$configuration['viewsDirectory'] = 'views/cli/';
$configuration['executionTime'] = 3600;

$Application = new Application($configuration);
$Application->run(implode(isset($configuration['Request']['segmentSeparator']) ? $configuration['Request']['segmentSeparator'] : '/', array('Gallery', 'generateImages')));