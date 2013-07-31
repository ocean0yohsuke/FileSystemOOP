<?php
namespace mywork;

class output extends \MethodFileSystemFile
{
	function main($string, $str_to_upper = false)
	{
		if ($str_to_upper)
		{
			$string = strtoupper($string);
		}
		
		print $string;
	}
}
