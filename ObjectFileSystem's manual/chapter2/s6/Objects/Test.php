<?php
namespace Objects;

// Base class will be primarily loaded automatically if it exists.
// Default name of the base class is 'base'.  
class Test extends base
{
	function main()
	{
		print $this->var;
	}
}