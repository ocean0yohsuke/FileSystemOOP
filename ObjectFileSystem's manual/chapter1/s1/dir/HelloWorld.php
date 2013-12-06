<?php
/* 
 * If PHP version is 5.3.0 or higher, using following schema is recommended.
 */
namespace ns; // namespace 

class HelloWorld // name of the method to be called
	extends \ObjectFileSystemFile // required 
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
