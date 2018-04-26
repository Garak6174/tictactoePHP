<?php
class TicTacToe
{
	private $play1;
	private $play2;
	private $currentPlayer;
	
	public function __construct($play1, $play2)
	{
	// initialize attributes
	$this->play1 = $play1;
	$this->play2 = $play2;
	$this->currentPlayer = $this->play1;
	}
	
	public function getCurrentPlayer()
	{
	// returns the current player
	return $this->currentPlayer;
	}
	
	public function switchPlayer()
	{
	// switches the player
	$curPlay = $this->getCurrentPlayer();
	if ($curPlay->getSymbol() == "X")
	{
		$this->currentPlayer = $this->p2;
	}
	else
	{
		$this->currentPlayer = $this->p1;
	}
	}
		
	public function setSymbol($board, $column, $row)
	{
	// Puts the symbol of the current player on the game board
		if ($this->isFree($board, $column, $row))
		{
			$board[$column][$row] = $this->currentPlayer->getSymbol();
		}
		$this->checkWinCondition($board);
	}
	
	public function isFree($board, $column, $row)
	{
	// checks if the selected field is free
		if ($board[$column][$row] == "")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
		
	public function checkWinCondition($board)
	{
	// checks if the is a win condition on the current board
		for ($i = 0, $i <= 2, $i++)
		{
			for ($i = 0, $i <= 2, $i++)
			{
				
			}
		}
	}
}



?>