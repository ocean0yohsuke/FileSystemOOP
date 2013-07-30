<?php
namespace Wrapper\String;

class toUpper extends \MethodFileSystemFile
{
	function main($string)
	{
		return strtoupper($string);
	}
}
