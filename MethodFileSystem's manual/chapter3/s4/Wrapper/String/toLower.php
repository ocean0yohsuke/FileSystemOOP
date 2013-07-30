<?php
namespace Wrapper\String;

class toLower extends \MethodFileSystemFile
{
	function main($string)
	{
		return strtolower($string);
	}
}
