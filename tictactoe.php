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
	$this->turn = 0;
	$this->isRefreshed = True;
	$this->winCondition = 0;
	}
	
	public function getCurrentPlayer()
	{
		// returns the current player
		return $this->currentPlayer;
	}
	
	public function switchPlayer()
	{
		$this->turn += 1;
		if(($this->turn + 2) % 2 == 0)
		{
			$this->currentPlayer = $this->player1;
		}
		else
		{
			$this->currentPlayer = $this->player2;
		}
	}
	private function refreshPage()
	{
		if(!$this->isRefreshed)
		{
			header("Refresh:0; url=index.php");
			$this->isRefreshed = True;
		}
	}
		
	public function setSymbol()
	{
		//
		$arraySize = pow(count($this->board->getArray()), 2);
		//$arraySize = count($this->board->getArray(), 1);
		
		echo ($arraySize);
		echo ("</br>");
		var_dump($this->board->getArray());
		if($this->turn >= $arraySize)
		{
			session_destroy();
			header("Refresh:3; url=index.php");
			$this->turn = 0;
			
		}
		// Sets the symbol of the current player in an array at the given address
		// Then switches the next player
		// Checks if the page has been refreshed, if not -> refresh page
		for($y = 0; $y < 3; $y++){
			for($x = 0; $x < 3; $x++){
				if(isset($_GET["cell-".$y."-".$x])) {
					if(empty($this->board->boardArray[$y][$x])) {
						$this->board->boardArray[$y][$x] = $_GET["cell-".$y."-".$x];
						$this->switchPlayer();
						$this->isRefreshed = False;
						$this->refreshPage();
					}
				}
			}
		}
		//header("Refresh:0; url=index.php");
	}
	
	public function getColor($sym)
	{
		if($sym == "X")
		{
			return $this->player1->color;
		}
		else
		{
			return $this->player2->color;
		}
	}
	
		
	public function checkWinCondition($board)
	{
	// checks if the is a win condition on the current board
		$length = count($this->board->getArray());
		for ($row = 0; $row < $length; $row++) 
		{
			for ($col = 0; $row < length; $col++)
			{
				//checks each row for 3 same symbols
				if(isset($board[$row][$col]))
				{
					
				}
			}
		}
	}
}



?>