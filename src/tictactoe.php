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
	$this->won = False;
	$this->winner = null;
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
		if($this->turn >= $arraySize or $this->won == True)
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
						$this->checkWinCondition($this->board->getArray(), $this->currentPlayer);
						$this->isRefreshed = False;
						$this->switchPlayer();
						$this->refreshPage();
					}
				}
			}
		}
		if($this->won)
		{
			echo ($this->winner->getName()." has WON");
		}
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
	
	private function checkRow($curPlayer, $row, $length)
	{
		$win = 0;
		for ($n = 0; $n < $length; $n++)
		{
			if($row[$n] == $curPlayer->getSymbol())
			{
				$win += 1;
			}
		}
		if($win == 3)
		{
			return True;
		}
	}
	
	private function checkCol($curPlayer, $col, $length)
	{
		$win = 0;
		for ($n = 0; $n < $length; $n++)
		{
			if($col[$n] == $curPlayer->getSymbol())
			{
				$win += 1;
			}
		}
		if($win == 3)
		{
			return True;
		}
	}
	
	private function flipBoard($board, $length)
	{
		$newBoard = array(
					array("", "", ""), 
					array("", "", ""),
					array("", "", ""));
		for ($row = 0; $row < $length; $row++)
		{
			for ($col = 0; $col < $length; $col++)
			{
				$newBoard[$col][$row] = $board[$row][$col];
			}
		}
		return $newBoard;
	}
	
	private function checkDiag($curPlayer, $board, $length)
	{
		$win1 = 0;
		$win2 = 0;
		for ($n = 0; $n < $length; $n++)
		{
			if($board[$n][$n] == $curPlayer->getSymbol())
			{
				$win1 += 1;
			}
			if($board[$n][$length - 1 - $n] == $curPlayer->getSymbol())
			{
				$win2 += 1;
			}
		}
		if($win1 == 3 or $win2 == 3)
		{
			return True;
		}
		else
		{
			return False;
		}
	}
	
	public function checkWinCondition($board, $curPlayer)
	{
	// checks if the is a win condition on the current board
		$length = count($board);
		$flippedBoard = $this->flipBoard($board, $length);
		for ($row = 0; $row < $length; $row++) 
		{
			if($this->checkRow($curPlayer, $board[$row], $length) or $this->checkCol($curPlayer, $flippedBoard[$row], $length) or $this->checkDiag($curPlayer, $board, $length))
			{
				$this->won = True;
				$this->winner = $curPlayer;
				return;
			}
			else
			{
				$this->won = False;
			}
		}
	}
}



?>