<? $basePath = 'http://notmybiz.com/'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Content-Language" content="<? echo $this->localize('en'); ?>"/>
		<base href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>"/>
		<title><? echo $this->localize('notmybiz'); ?></title>
		<link href="<? echo $basePath; ?>default/css/style.css" rel="stylesheet" title="Default" type="text/css"/>
		<link href="<? echo $basePath; ?>dark/css/style.css" rel="alternate stylesheet" title="Dark" type="text/css"/>
		<link type="image/x-icon" href="<? echo $basePath; ?>favicon.ico" rel="shortcut icon"/>
		<script type="text/javascript" src="<? echo $basePath; ?>js/mootools.js"></script>
	</head>
