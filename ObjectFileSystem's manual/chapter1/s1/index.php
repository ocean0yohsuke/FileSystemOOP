<?php 
/*
 * ObjectFileSystem requires at least PHP version 5.0.0 or higher.
 * 
 * This is the first example to show minimum use of ObjectFileSystem.
 * Please note that $OFS can call helloworld() method which is defined as a class in a file within a directory tree you specified. 
 * You would recognize later how powerful this framework is. 
 * 
 * If the version of PHP is 5.3.0 or higher, do as below.
 */

include_once '../../../ObjectFileSystem.php';

// Let's start ObjectFileSystem
$OFS = new ObjectFileSystem(
	'./dir', // Root directory 
	'ns' // Root namespace 
);
$OFS->make();

$OFS->HelloWorld()->show();

//The above example will output:
//Hello world.

?>
