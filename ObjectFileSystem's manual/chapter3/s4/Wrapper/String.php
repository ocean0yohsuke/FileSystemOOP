<?php
namespace Wrapper;

class String extends \ObjectFileSystemFile
{
	function main()
	{
	}
	
	function toLower($string)
	{
		return strtolower($string);
	}
	
	function toUpper($string)
	{
		return strtoupper($string);
	}
}