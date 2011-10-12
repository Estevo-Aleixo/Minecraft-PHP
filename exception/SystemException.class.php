<?php
namespace de\wbbaddons\minecraft\api\exception;
use de\wbbaddons\minecraft\api\MinecraftPHP;

class SystemException extends \Exception {
	protected $description;
	
	/**
	 * Creates a new SystemException.
	 * 
	 * @param	string		$message	error message
	 * @param	integer		$code		error code
	 * @param	string		$description	description of the error	
	 */
	public function __construct($message = '', $code = 0, $description = '') {
		parent::__construct($message, $code);
		$this->description = $description;
	}
	
	public function __getTraceAsString() {
		//if something should be stripped out of trace, do it here
		$string = $this->getTraceAsString();
		
		return $string;
	}
	
	public function log() {
		$errorMessage  = "\n";
		$errorMessage .= "Fatal Error:\n";
		$errorMessage .= "error message: " . str_replace(array("\r\n", "\n", "\r"), '', $this->getMessage()) . "\n";
		$errorMessage .= "description: " . $this->description . "\n";
		$errorMessage .= "error code: " . $this->getCode() . "\n";
		$errorMessage .= "file: " . $this->getFile() . "\n";
		$errorMessage .= "php version: " . phpversion() . "\n";
		$errorMessage .= "date: " . gmdate('r') . "\n";
		$errorMessage .= "Stacktrace:" . "\n";
		$errorMessage .= $this->__getTraceAsString() . "\n";

		$errSplit = explode("\n", $errorMessage);
		
		$biggest = 0;
		foreach ($errSplit as $split) {
			$tmp = strlen($split);
			if($tmp > $biggest) $biggest = $tmp; 
		}
		
		$errorMessage = "\n" . str_repeat("#", $biggest + 4) . "\n";
		
		foreach ($errSplit as $split) {
			$split = "# " . $split;
			$tmp = $biggest - (strlen($split) - 2);
			if($tmp > 0) $split = $split . str_repeat(" ", $tmp) . " #";
			else $split .= " #";
			$errorMessage .= $split . "\n";
		}
		
		$errorMessage = $errorMessage . str_repeat("#", $biggest + 4) . "\n";
		
		return $errorMessage;
	}
	
	/**
	 * Prints this exception.
	 * This method is called by MinecraftPHP::handleException().
	 */
	public function showHTML() {
		MinecraftPHP::$logger->log($this->log(), false);
	echo'
		<tr class="systemException">
			<td></td>
			<td>
				<h1 style="margin: 0px;">Fatal Error:</h1>
				<b>error message: </b>'. $this->getMessage() ."<br />\n".'
				<b>description: </b>'. $this->description ."<br />\n".
				'<b>error code: </b>'. intval($this->getCode())."<br />\n".
				'<b>file: </b> '. $this->getFile().' ('. $this->getLine().')'."<br />\n".'
				<b>php version: </b> '. phpversion()."<br />\n".'
				<b>date: </b>'. gmdate('r') ."<br />\n".'
				<b>Stacktrace: </b><br />
				<pre style="margin-top: 0px;">'. $this->__getTraceAsString().'</pre>
			</td>
		</tr>';
	}
	
	public function getSTDTrace() {
		$traceAsArray = $this->getTrace();
		$traceAsString = '';
		$i = 0;
		foreach($traceAsArray as $traceLine) {
			if(isset($traceLine['file'])) $file = str_replace(MinecraftPHP::MCPDIR, '', $traceLine['file']);
			if(isset($traceLine['class'])) $class = str_replace(array('de\\wbbaddons\\minecraft\\api\\', '\\'), array('', DIRECTORY_SEPARATOR), $traceLine['class']);
			if(!empty($traceLine['args'])) {
				$function = $traceLine['function'] . "(";
				foreach($traceLine['args'] as $arg) {
					$function .= $arg . ", ";
				}
				$function = substr($function, 0, -2) . ")";
			} else $function = $traceLine['function'] . "()";
			
			$traceAsString .= "#". $i ." ";
			if(isset($file)) $traceAsString .= $file .": ";
			if(isset($class)) $traceAsString .= $class;
			if(isset($traceLine['type'])) $traceAsString .= $traceLine['type'];
			if(isset($function)) $traceAsString .= $function . "\n";
			$i++;
		}
		$traceAsString .= "#". $i ." {main}";
		
		return $traceAsString;
	}
	
	/**
	 * Prints this exception.
	 * This method is called by MinecraftPHP::handleException().
	 */
	public function showSTD() {
		MinecraftPHP::$logger->log($this->log(), false);
		$error  = "\nFatal Error: (" . $this->getCode() . ") " . $this->getMessage() . "\n";
		$error .= "desc: " . $this->description . "\n";
		$error .= "file: " . str_replace(array('de\\wbbaddons\\minecraft\\api\\', '\\'), array('', DIRECTORY_SEPARATOR), $this->getFile()) . "\n";
		$error .= "date: " .gmdate('r') . "\n";
		$error .= "php version: " .  phpversion() . "\n";
		$error .= "\nStacktrace:\n";
		$error .= $this->getSTDTrace();
		fwrite(STDOUT, $error . "\n");
	}	
}
?>