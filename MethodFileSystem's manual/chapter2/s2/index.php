<?php
/*
 * Use of a methodfile from a methodpack
 */

include_once '../../../MethodFileSystem.php';

$pack1 = new MethodFileSystem('./pack1', 'pack1');
$pack1->make();

// Call test1() from ./pack1
// Go to ./pack/test1.php
$pack1('.')->test1();

// Call test2() from ./pack/pack2
// Go to ./pack/pack2/test2.php
$pack1('pack2')->test2();

// This is wrong.
//$pack1('pack2/pack3')->test3();

//The above example will output:
//test1() has been called successfully.
//test2() has been called successfully.
//test3() has been called successfully.
//
//test2() has been called successfully.
//test3() has been called successfully.
?>