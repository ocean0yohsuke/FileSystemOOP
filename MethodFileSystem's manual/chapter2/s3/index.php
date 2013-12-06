<?php
/*
 * Use of a methodFile from a methodPack
 */

include_once '../../../MethodFileSystem.php';
$pack1 = new MethodFileSystem('./pack1', 'pack1', TRUE, FALSE);
$pack1->make();

$pack1->__invoke('.')->test1();

$pack1->__invoke('pack2')->test2();

//The above example will output:
//test1() has been called successfully.
//test2() has been called successfully.
//test3() has been called successfully.
//
//test2() has been called successfully.
//test3() has been called successfully.
//
//test3() has been called successfully.
?>
