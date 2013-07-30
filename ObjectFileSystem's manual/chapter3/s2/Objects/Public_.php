<?php
namespace Objects;

class Public_ extends \ObjectFileSystemFile
{
	// This public property will be 'Hello World!'.
	// Any public property declared here will load a value from invoker's public property automatically 
	public $var1;
	
	function main()
	{
	}
	
	function var1()
	{
		return $this->var1;
	}
}
