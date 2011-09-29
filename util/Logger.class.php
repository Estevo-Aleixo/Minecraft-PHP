<?php
namespace de\wbbaddons\minecraft\api\util;

class Logger {
	const PLAIN = 1;
	const HTML = 2;
	const STD = 3;
	
	public $logfileExt = ".log";
	public $logfileName = "Logger";
	public $logDir = "";
	
	public function __construct($outputType = self::STD, $logToFile = false, $printOutput = true) {
		$this->outputType = $outputType;
		$this->logToFile = $logToFile;
		$this->printOutput = $printOutput;
		$this->logDir = __DIR__ . "/logs";
		if($this->outputType == self::STD && !defined("STDOUT")) $this->outputType = self::HTML;	
	}
	
	public function init() {
		if($this->logToFile) {
			if(!is_dir($this->logDir)) mkdir($this->logDir);
			$this->logfile = $this->logDir . "/" . $this->logfileName . $this->logfileExt;
			//if(is_file($this->logfile)) rename($this->logfile, $this->logfile . "." . date("d.m.Y-H.i.s", filemtime($this->logfile)) . ".bak");
			$this->handle = fopen($this->logfile, "w+");
		}
		
		switch($this->outputType) {
			case self::PLAIN:
				$this->method = self::PLAIN;
				$this->plainLog("Plain Logger initialized!");
				break;
			case self::HTML:
				$this->method = self::HTML;
				echo file_get_contents(__DIR__ . '/htmlLog.tpl');
				$this->htmlLog("HTMLog initialized!");
				if($this->logToFile) $this->htmlLog("HTML tags will be stripped in logfile.");
				break;
			case self::STD:
				$this->method = self::STD;
				$this->stdLog("STD Logger initialized!");
				break;
		}
	}
	
	public function log($message) {
		switch($this->method) {
			case self::PLAIN:
				$this->plainLog($message);
				break;
			case self::HTML:
				$this->htmlLog($message);
				break;
			case self::STD:
				$this->STDLog($message);
				break;
		}
	}
	
	private function plainLog($message) {
		$message = self::date() . " " . $message . "\n";
		if($this->logToFile) fwrite($this->handle, $message);
		if($this->printOutput) echo $message;
	}
	
	private function htmlLog($message) {
		$message = "<p><span class='time'>" . self::date() . "</span> " . "<span class='message'>". $message . "</span></p>\n";
		if($this->logToFile) fwrite($this->handle, strip_tags($message));
		if($this->printOutput) echo $message;
	}
	
	private function stdLog($message) {
		$message = self::date() . " " . $message . "\n";
		if($this->logToFile) fwrite($this->handle, $message);
		if($this->printOutput) fwrite(STDOUT, $message);
	}
	
	public function date() {
		return date("[H:i:s]", time());
	}
}