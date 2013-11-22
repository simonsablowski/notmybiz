<!DOCTYPE html>
<html lang="<?php echo $this->localize('document-language'); ?>">
	<head>
		<title><?php echo $this->localize('document-title') . (isset($pageTitle) ? ' - ' . $this->localize($pageTitle) : ''); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="description" content="<?php echo (isset($pageTitle) ? $this->localize($pageTitle) . ' - ' : '') . $this->localize('meta-description'); ?>">
		<meta name="keywords" content="<?php echo $this->localize('meta-keywords'); ?>">
		<meta name="robots" content="index, follow">
		<meta name="revisit-after" content="1 day">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
		<link href="<?php echo $this->localize('canonical-url'); ?>" rel="canonical">
		<link href="<?php echo $this->getApplication()->getConfiguration('basePath'); ?>css/notmybiz.css" rel="stylesheet" type="text/css">
		<link href="<?php echo $this->getApplication()->getConfiguration('basePath'); ?>img/notmybiz.ico" rel="shortcut icon" type="image/x-icon">
		<script src="<?php echo $this->getApplication()->getConfiguration('basePath'); ?>js/notmybiz.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="document">
			<header id="header">
				<h1 id="logo">
					<a href="<?php echo $this->getApplication()->getConfiguration('basePath'); ?>" title="<?php echo $this->localize('document-title'); ?>"><?php echo $this->localize('document-title'); ?></a>
				</h1>
			</header>
