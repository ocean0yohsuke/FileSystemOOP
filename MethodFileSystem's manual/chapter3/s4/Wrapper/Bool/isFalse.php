<?php
namespace Wrapper\Bool;

class isFalse extends \MethodFileSystemFile
{
	function main($bool)
	{
		return ($bool === FALSE);
	}
}
