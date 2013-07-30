<?php
namespace Objects;

class Output extends \ObjectFileSystemFile
{
	private $string;
	
	function main($string, $str_to_upper = FALSE)
	{
		$this->string = $string;
		if ($str_to_upper) {
			$this->string = strtoupper($this->string);
		}
	}
	
	function run()
	{
		print $this->string . '!';
		print '<br />';
	}
}
