<?php 
/*
 * Use of method chain
 */

include_once '../../../MethodFileSystem.php';
$chainMethods = new MethodFileSystem('./chainMethods', 'chainMethods');

// Define a global public property befer make()
$chainMethods->chain_var = '';
$chainMethods->make();

// Go to the files of each method.
$chainMethods('.')->callStart("Let's start! ")->call1()->call2()->call3()->callEnd(' bye-bye!!!');

$chainMethods('.')->call1();
//The above example will output:
//Let's start! one, two, three, bye-bye!!!

?>