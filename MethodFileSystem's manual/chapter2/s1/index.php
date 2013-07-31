<?php
/*
 * Use of many methods
 */

include_once '../../../MethodFileSystem.php';

$methods = new MethodFileSystem('./methods', 'methods');
$methods->make();

// output 'Hello '
$methods('.')->method1();

// output 'world.'
$methods('.')->method2();

//The above example will output:
//Hello world.

?>