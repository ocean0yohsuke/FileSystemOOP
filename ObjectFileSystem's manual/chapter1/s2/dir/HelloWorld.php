<?php
/*
 * If the version of PHP is lower than 5.3.0, do as below. 
 */

class ns_HelloWorld // must be {namespace}_{objectname}
	extends ObjectFileSystemFile
{
	private $string;
	
        function construct() {
		$this->string = 'Hello World!';
        }

	function main() {
		print $this->string;
	}
}
?>
