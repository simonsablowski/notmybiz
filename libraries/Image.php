<?php

class Image extends Application {
	protected $source;
	protected $width;
	protected $height;
	protected $crop;
	protected $grey;
	protected $quality;
	protected $directory;
	protected $fileName;
	protected $extension;
	protected $cachePath;
	
	public function __construct($source, $width, $height, $crop, $grey, $quality) {
		$this->setSource($source);
		$this->setWidth(round($width));
		$this->setHeight(round($height));
		$this->setCrop($crop == 'true');
		$this->setGrey($grey == 'true');
		$this->setQuality(round($quality));
	}
	
	protected function checkConfiguration() {
		if (is_null($this->getConfiguration('parameterSets'))) {
			throw new FatalError('Parameter sets not configured');
		}
		if (is_null($this->getConfiguration('baseUploadPath'))) {
			throw new FatalError('Base upload path not configured');
		}
		if (is_null($this->getConfiguration('extensions'))) {
			throw new FatalError('Extensions not configured');
		}
	}
	
	protected function getParameters() {
		return array(
			'width' => $this->getWidth(),
			'height' => $this->getHeight(),
			'crop' => $this->getCrop(),
			'grey' => $this->getGrey(),
			'quality' => $this->getQuality()
		);
	}
	
	protected function analyzeParameters() {
		if (!in_array($this->getParameters(), $this->getConfiguration('parameterSets'))) {
			throw new FatalError('Invalid parameters', $this->getParameters());
		}
	}
	
	protected function analyzeSource() {
		$this->setSource($this->getConfiguration('baseUploadPath') . str_replace('..', '', $this->getSource()));
		if (is_null($this->getSource() || !file_exists($this->getSource()))) {
			throw new FatalError('Invalid source', $this->getSource());
		}
	}
	
	protected function analyzePath() {
		$pathinfo = pathinfo($this->getSource());
		$this->setDirectory($pathinfo['dirname']);
		if (!isset($pathinfo['filename'])) {
			$fileName = $pathinfo['filename'];
		} else {
			$fileName = substr($pathinfo['basename'], 0, strlen($pathinfo['basename']) - strlen($pathinfo['extension']) - 1);
		}
		$this->setFileName(preg_replace('/\W/', '', $fileName));
		$this->setExtension(strtolower($pathinfo['extension']));
	}
	
	protected function analyzeExtension() {
		if (!in_array($this->getExtension(), $this->getConfiguration('extensions'))) {
			throw new FatalError('Invalid extension', $this->getExtension());
		}
	}
	
	public function analyze() {
		$this->checkConfiguration();
		$this->analyzeParameters();
		$this->analyzeSource();
		$this->analyzePath();
		$this->analyzeExtension();
		
		$this->setCachePath($this->getDirectory() . '/cache/' . $this->getFileName() . '-' .
			($this->getWidth() ? $this->getWidth() : '') . 'x' .
			($this->getHeight() ? $this->getHeight() : '') .
			($this->getCrop() ? '-c' : '') . 
			($this->getGrey() ? '-g' : '') .
			($this->getQuality() ? '-q' . $this->getQuality() : '') . '.' .
			$this->getExtension());
	}
	
	public function convert() {
		if (file_exists($this->getCachePath())) return;
		
		if (!$this->getWidth() || !$this->getHeight() || $this->getCrop()) {
			$identify = sprintf('identify -format "%%w %%h" "%s"', $this->getSource());
			exec($identify, $output);
			$params = explode(' ', $output[0]);
			
			$width = $params[0];
			$height = $params[1];
			$wperh = $width / $height;
			$hperw = $height / $width;
			$calcw = $this->getHeight() * $wperh;
			$calch = $this->getWidth() * $hperw;
			$adjw = $this->getWidth() > $calcw ? $this->getWidth() : $calcw;
			$adjh = $this->getHeight() > $calch ? $this->getHeight() : $calch;
			$gravity = $wperh >= 1 ? 'Center' : 'North';
		}
		
		$convert = sprintf('convert "%s" -resize %dx%d %s %s -strip %s "%s"', $this->getSource(),
			$this->getWidth() && !$this->getCrop() ? $this->getWidth() : ($this->getWidth() && $this->getCrop() ? $adjw : $width),
			$this->getHeight() && !$this->getCrop() ? $this->getHeight() : ($this->getHeight() && $this->getCrop() ? $adjh : $height),
			$this->getCrop() && $this->getWidth() && $this->getHeight() ? ' -gravity ' . $gravity . ' -crop ' . $this->getWidth() . 'x' . $this->getHeight() . '+0+0 +repage' : '',
			$this->getGrey() ? ' -colorspace Gray' : '',
			$this->getQuality() ? ' -quality ' . $this->getQuality() : '',
			$this->getCachePath());
		exec($convert);
	}
	
	public function display() {
		$this->setConfiguration('header', sprintf('Content-Type: image/%s', $this->getExtension()));
		$this->setupHeader();
		readfile($this->getCachePath());
	}
}