<?php
class Player
{
	public $playerName;
	public $playerSym;
	//the color set and used in the tictactoe.php file
	public $color;
	public function __construct($name, $symbol)
	{
		// initialize attributes
		$this->playerName = $name;
		$this->playerSym = $symbol;
	}
	
	public function getSymbol()
	{
		// returns the symbol used by that player
		return $this->playerSym;
	}
	
	public function getName()
	{
		// returns the name of the current player
		return $this->playerName;
	}
}
?>