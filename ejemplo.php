<?php


header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once("./clases/tree.php");


$tree = new Tree();

$elements = $tree->get();
$masters = $elements["masters"];
$childrens = $elements["childrens"];

$tree->hola($childrens);

//
//foreach($masters as $master)
//{
//
//    echo Tree::nested($childrens, $master["codigo"]);
//}

