<?php
/*
 * Use of setCach()
 */

include_once '../../../MethodFileSystem.php';
$pack1 = new MethodFileSystem('./pack1', 'pack1');
$pack1->make();
$cache = $pack1->get_cache();

// print the cached data: a serialized object
var_dump($cache); print '<br />'; print '<br />';

// Normal mode
{
	$time_start = microtime();

	$pack1->make();

	$time_end = microtime();

	print ($time_end - $time_start)*10000; print '<br />';
}


// Cache mode
{
	$time_start = microtime();

	$pack1->set_cache($cache);
	$pack1->make();

	$time_end = microtime();

	print ($time_end - $time_start)*10000; print '<br />';
}

//The above example will output:
//{STRING}
//
//{DECIMAL}
//{DECIMAL}

?>