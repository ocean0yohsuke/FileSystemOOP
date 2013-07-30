<?php 
/*
 * Use of private properties
 */

include_once '../../../MethodFileSystem.php';
$methodpack = new MethodFileSystem('./methodpack', 'mywork');
$methodpack->make();

// This output 1
$methodpack('.')->test();

// This output 2
$methodpack('.')->test();

// The above example will output:
// 1
// 2
?>
