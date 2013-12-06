<?php
/*
* Use of many objects
*/

include_once '../../../ObjectFileSystem.php';

$OFS = new ObjectFileSystem('./dir', 'mywork');
$OFS->make();

// output 'Hello '
$OFS->Object1();

// output 'World!'
$OFS->Object2();

//The above example will output:
//Hello World!

?>
