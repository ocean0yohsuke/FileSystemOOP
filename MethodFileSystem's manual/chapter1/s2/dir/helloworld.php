<?php
/*
 * If the version of PHP is lower than 5.3.0, do as below. 
 */

class ns_helloworld // Must be {namespace}_{methodname}
	extends MethodFileSystemFile
{
	function main() 
	{
		//
		// Contents of helloworld() method 
		//
		
		print 'Hello world.';
	}
}
?>
