<?php 
/*
 * Use of public properties
 */

include_once '../../../MethodFileSystem.php';
$methodpack = new MethodFileSystem('./methodpack', 'mywork');

// Define a global public property here before make().
$methodpack->var1 = 'Hello world.';
$methodpack->make();

// Go to ./methodpack/declared_public.php
$methodpack('.')->declared_public(); print '<br />';

// Confirm whether the property was altered or not.
var_export($methodpack->var1); print '<br />';

// Go to ./methodpack/not_declared_public.php
$methodpack('.')->not_declared_public();

// The above example will output:
// 'Hello world.'
// 'Property var1 was altered.'
// NULL
?>
