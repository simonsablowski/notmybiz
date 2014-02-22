<?php

$configuration = array();

$configuration['pathApplication'] = dirname(__FILE__) . '/';

$configuration['basePath'] = '/';
$configuration['mediaPath'] = '/';

$configuration['includeDirectories'] = array(
	$configuration['pathApplication'],
	$configuration['pathApplication'] . '../../nacho/'
);

$configuration['Database'] = array(
	'type' => 'MySql',
	'host' => 'localhost',
	'name' => 'notmybiz',
	'user' => 'root',
	'password' => ''
);

$configuration['Localization'] = array(
	'default' => 'en',
	'en' => array(
		'language' => 'en',
		'locale' => 'en_GB',
		'name' => 'English'
	)
);

$configuration['Request'] = array(
	'segmentSeparator' => ':',
	'defaultQuery' => 'Gallery:show:',
	'aliasQueries' => array(
		'(disclaimer)' => 'Static:show:$1'
	)
);

$configuration['Image'] = array(
	'parameterSets' => array(
		array(
			'width' => 100,
			'height' => 100,
			'crop' => true,
			'grey' => true,
			'quality' => 70
		),
		array(
			'width' => 280,
			'height' => 280,
			'crop' => true,
			'grey' => false,
			'quality' => 80
		),
		array(
			'width' => 900,
			'height' => 500,
			'crop' => false,
			'grey' => false,
			'quality' => 90
		)
	),
	'baseUploadPath' => $configuration['pathApplication'] . '../media/',
	'extensions' => array(
		'jpg',
		'jpeg',
		'png',
		'gif'
	)
);

$configuration['trackingCode'] = "\t\t<script type=\"text/javascript\">\n\t\t<!--\n\t\tvar gaJsHost = 'https:' == document.location.protocol ? 'https://ssl.' : 'http://www.';\n\t\tdocument.write(unescape('%3Cscript src=\"' + gaJsHost + 'google-analytics.com/ga.js\" type=\"text/javascript\"%3E%3C/script%3E'));\t\t//-->\n\t\t</script>\n\t\t<script type=\"text/javascript\">\n\t\t<!--\n\t\ttry {\n\t\t\tvar pageTracker = _gat._getTracker('UA-2644687-1');\n\t\t\tpageTracker._initData();\n\t\t\tpageTracker._trackPageview();\n\t\t} catch (error) {\n\t\t\t\n\t\t}\n\t\t//-->\n\t\t</script>";

$configuration['debugMode'] = false;