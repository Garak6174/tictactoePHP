<?php
class Board
{
	private $gameBoard;
	
	public function __construct()
	{
	// initialize attributes
	$this->gameBoard = array(
						array("", "", ""), 
						array("", "", ""), 
						array("", "", ""));
	}
	
	public function getBoard()
	{
	// returns the current board
	return $this->gameBoard;
	}
	
	public function displayBoard()
	{
	// displays the board to the screen
		
	}
}

?>