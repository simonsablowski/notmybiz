<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Content-Language" content="<? echo $this->localize('en'); ?>"/>
		<title><? echo $this->localize('notmybiz') . (isset($subtitle) ? ' - ' . $this->localize($subtitle) : ''); ?></title>
		<meta name="dc.title" content="<? echo $this->localize('notmybiz') . (isset($subtitle) ? ' - ' . $this->localize($subtitle) : ''); ?>"/>
		<meta name="description" content="<? echo (isset($subtitle) ? $this->localize($subtitle) . ' - ' : '') . $this->localize('notmybiz.com presents illustration and art by Simon Sablowski and Filippo Baraccani'); ?>"/>
		<meta name="keywords" content="<? echo $this->localize('simon sablowski, sablowski, berlin, filippo baraccani, baraccani, bremen, portfolio, illustration, design, life drawing, character design, portrait, caricature, comic'); ?>"/>
		<meta name="revisit-after" content="1 day"/>
		<link href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>css/notmybiz.css" rel="stylesheet" title="Default" type="text/css"/>
		<link type="image/x-icon" href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>favicon.ico" rel="shortcut icon"/>
		<script type="text/javascript" src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>js/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="<? echo $this->getApplication()->getConfiguration('basePath'); ?>js/notmybiz.js"></script>
<? if (isset($javaScriptFiles)) foreach ($javaScriptFiles as $javaScriptFile): ?>
		<script type="text/javascript" src="<? echo $javaScriptFile; ?>"></script>
<? endforeach; ?>
	</head>
	<body>
		<div id="document">
			<div id="head">
				<h1 id="logo">
					<a href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>" title="<? echo $this->localize('notmybiz'); ?>"><? echo $this->localize('not<em>my</em>biz'); ?></a>
				</h1>
			</div>
			<div id="body">
				<div id="content">
