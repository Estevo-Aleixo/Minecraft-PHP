<?php
namespace de\wbbaddons\minecraft\api\util;

class Logger {
	const PLAIN = 1;
	const HTML = 2;
	const STD = 3;
	
	public $logfileExt = ".log";
	public $logfileName = "Logger";
	public $logDir = "";
	
	public function __construct($outputType = self::STD, $logToFile = false) {
		$this->outputType = $outputType;
		$this->logToFile = $logToFile;
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
				echo self::date() . " Plain Logger initialized!\n";
				break;
			case self::HTML:
				$this->method = self::HTML;
				echo file_get_contents(__DIR__ . '/htmlLog.tpl');
				"<tr><td class='time'>" . self::date() . "</td> " . "<td class='message'>HTMLog initialized!</td></tr>\n";
				if($this->logToFile) "<tr><td class='time'>" . self::date() . "</td> " . "<td class='message'>HTML tags will be stripped in logfile.</td></tr>\n";
				break;
			case self::STD:
				$this->method = self::STD;
				fwrite(STDOUT, self::date() . " STD Logger initialized!\n");
				break;
		}
	}
	
	public function log($message, $print = true) {
		switch($this->method) {
			case self::PLAIN:
				$this->plainLog($message, $print);
				break;
			case self::HTML:
				$this->htmlLog($message, $print);
				break;
			case self::STD:
				$this->STDLog($message, $print);
				break;
		}
	}
	
	private function plainLog($message, $print) {
		$message = self::date() . " " . $message . "\n";
		if($this->logToFile) fwrite($this->handle, $message);
		if($print) echo $message;
	}
	
	private function htmlLog($message, $print) {
		$message = "<tr><td class='time'>" . self::date() . "</td> " . "<td class='message'>". $message . "</td></tr>\n";
		if($this->logToFile) fwrite($this->handle, strip_tags($message));
		if($print) echo $message;
	}
	
	private function stdLog($message, $print) {
		$message = self::date() . " " . $message . "\n";
		if($this->logToFile) fwrite($this->handle, $message);
		if($print) fwrite(STDOUT, $message);
	}
	
	public function date() {
		return date("[H:i:s]", time());
	}
}