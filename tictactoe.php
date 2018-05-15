<?php
class TicTacToe
{
	private $play1;
	private $play2;
	private $currentPlayer;
	
	public function __construct($board, $player1, $player2)
	{
	// initialize attributes
	$this->player1 = $player1;
	$this->player1->color = "colorX";
	$this->player2 = $player2;
	$this->player2->color = "colorO";
	$this->board = $board;
	$this->currentPlayer = $this->player1;
	}
	
	public function getCurrentPlayer()
	{
		// returns the current player
		return $this->currentPlayer;
	}
	
	public function switchPlayer()
	{
		// switches the player
		$player_now = $this->getCurrentPlayer();
		if ($player_now->getSymbol() == $this->player1->getSymbol())
		{
			$this->currentPlayer = $this->player2;
		}
		else
		{
			$this->currentPlayer = $this->player1;
		}
	}
		
	public function setSymbol()
	{
	// Returns the symbol of the current player on the game board		
		for($y = 0; $y < 3; $y++){
			for($x = 0; $x < 3; $x++){
				if(isset($_GET["cell-".$y."-".$x])) {
					if(empty($this->board->boardArray[$y][$x])) {
						$this->board->boardArray[$y][$x] = $_GET["cell-".$y."-".$x];
					}
				}
			}
		}
		header("Refresh:0");
	}
	
		
	public function checkWinCondition($board)
	{
	// checks if the is a win condition on the current board
		for ($i = 1; $i <= 3; $i++) 
		{
			echo $i;
		}
	}
}



?>