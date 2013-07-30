<?php
namespace Wrapper;

class Bool extends \ObjectFileSystemFile
{
	function main()
	{
	}
	
	function isFalse($bool)
	{
		return ($bool === FALSE);
	}
	
	function isTrue($bool)
	{
		return ($bool === TRUE);
	}
	
	
}
