<?php
namespace Objects;

// Base class will be primarily loaded automatically if exists.
// Default name of the class is 'Base'.  
class Test extends Base
{
	function main()
	{
		print $this->var;
	}
}
