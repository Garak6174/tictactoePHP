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
	//added the board to an attribute for easy referencing
	$this->board = $board;
	//current player in a new game is always player1
	$this->currentPlayer = $this->player1;
	//counting the turns to reliably tell whos turn it is
	$this->turn = 0;
	//boolean attribute to tell if the page has already been refreshed
	$this->isRefreshed = True;
	//True == Win condition has been met
	$this->won = False;
	//which player has won, used in text output
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
	
	//refreshes the page if @isRefreshed == False and sets it to True
	private function refreshPage()
	{
		if(!$this->isRefreshed)
		{
			header("Refresh:0; url=index.php");
			$this->isRefreshed = True;
		}
	}
	
	//Main method where all other methods are called from
	public function setSymbol()
	{
		//destroys the session and refreshed the page if the last possible turn has been made
		//in a 3x3 grid the highest number of turns are 9
		$arraySize = pow(count($this->board->getArray()), 2);
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
	
	//returns the color for each symbol
	//hardcoded at the moment -> should be made more flexible in the future
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
	
	//After each turn made it checks if there are 3 symbols of the current player in a row
	//if true it returns True
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
	
	//After each turn made it checks if there are 3 symbols of the current player in a col
	//if true it returns True
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
	
	//flips the board at 90 degree counterclockwise for easy handling of columns
	//and then returns the newly created array
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
	
	//checks if the are three symbols of the current player in any diagonal
	//if true it returns true
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
	
	// checkRow, checkCol and CheckDiag are called, if any of them are true it sets the @won to True
	public function checkWinCondition($board, $curPlayer)
	{
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