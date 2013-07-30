<?php
/*
 * If the version of PHP is lower than 5.3.0, do as below. 
 */

class ns_HelloWorld // Must be {namespace}_{objectname}
	extends ObjectFileSystemFile
{
	private $string;
	
	function main() 
	{
		$this->string = 'Hello, World!';
	}
	
	function show()
	{
		print $this->string;
	}
}
?>
