<?php 
/*
 * MethodFileSystem requires at least PHP version 5.0.0 or higher.
 * 
 * This is the first example to show minimum use of MethodFileSystem.
 * Please note that $MFS can call helloworld() method which is defined as a class in a file within a directory tree you specified. 
 * You would recognize later how powerful this framework is. 
 * 
 * If the version of PHP is 5.3.0 or higher, do as below.
 */

include_once '../../../MethodFileSystem.php';

// Let's start MethodFileSystem
$MFS = new MethodFileSystem(
	'./dir', // Root directory 
	'ns' // Root namespace 
);
$MFS->make();

// Call helloworld().
// Go to ./dir/helloworld.php
$MFS('.')->helloworld();

//The above example will output:
//Hello world.

?>
