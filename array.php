<?php
$gameBoard = array(array("_", "_", "_"), array("_", "_", "_"), array("_", "_", "_"));

foreach ($gameBoard as $valueArray) {
	foreach ($valueArray as $valueNum) {
		echo $valueNum;
	}
	echo "<br>";
}

$gameBoard[1][2] = "x";

foreach ($gameBoard as $valueArray) {
	foreach ($valueArray as $valueNum) {
		echo $valueNum;
	}
	echo "<br>";
}
?>