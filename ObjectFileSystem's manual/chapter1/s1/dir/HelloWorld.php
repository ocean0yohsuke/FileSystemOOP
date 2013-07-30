<?php
/* 
 * If PHP version is 5.3.0 or higher, using following schema is recommended.
 */
namespace ns; // Namespace 

class HelloWorld // Name of the method to be called
	extends \ObjectFileSystemFile // required 
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