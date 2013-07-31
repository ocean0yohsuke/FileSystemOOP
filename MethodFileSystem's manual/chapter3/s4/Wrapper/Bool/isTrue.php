<?php
namespace Wrapper\Bool;

class isTrue extends \MethodFileSystemFile
{
	function main($bool)
	{
		return ($bool === TRUE);
	}
}
