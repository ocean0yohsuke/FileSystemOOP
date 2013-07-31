<?php
/*
 * Use of base class
 */

include_once '../../../MethodFileSystem.php';
$methods = new MethodFileSystem('./methods', 'methods');
$methods->make();

// Go to ./methodpack/method.php
$methods('.')->test();

//The above example will output:
//Hello world

?>