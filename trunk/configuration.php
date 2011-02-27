<?php

$configuration = array();

$configuration['pathApplication'] = dirname(__FILE__) . '/';

$configuration['basePath'] = '/notmybiz/';

$configuration['includeDirectories'] = array(
	$configuration['pathApplication'],
	$configuration['pathApplication'] . '../nacho/'
);

$configuration['Database'] = array(
	'type' => 'MySql',
	'host' => 'localhost',
	'name' => 'notmybiz',
	'user' => 'root',
	'password' => ''
);

$configuration['Request'] = array(
	'segmentSeparator' => '_',
	'defaultQuery' => 'Gallery_show_',
	'aliasQueries' => array()
);

$configuration['debugMode'] = TRUE;
// $configuration['debugMode'] = FALSE;