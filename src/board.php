<?php
class Board
{
	public $boardArray;
	
	public function __construct()
	{
	// initialize attributes
	$this->boardArray = array(
						array("", "", ""), 
						array("", "", ""),
						array("", "", ""));
	}
	
	public function getArray()
	{
		// returns the current board
		return $this->boardArray;
	}
	
	public function displayBoard($game)
	{
		$sym = "";
		// displays the board to the screen
		echo ('<table class="tic">');
			for ($num = 0; $num < 3; $num++)
			{
				echo ('<tr>');
				for ($i = 0; $i < 3; $i++)
				{
				$sym = $game->board->boardArray[$num][$i];
					if(empty($game->board->boardArray[$num][$i]))
					{
						echo ('<td><input type="submit" class="reset field" name="cell-'.$num.'-'.$i.'" value="'.$game->getCurrentPlayer()->getSymbol().'" /></td>');
					}
					else
					{
						echo ('<td><span class="'.$game->getColor($sym).'">'.$sym.'</span></td>');
					}
				}
				echo ('</tr>');
			}
		echo ('</table>');
		
	}
}

?>