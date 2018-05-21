<?php
session_start();

define ('BASEPATH', realpath(dirname(__FILE__)));
require_once (BASEPATH.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');

//check if the 'game' session is filled with data
//if not, a new game ist created
if(empty($_SESSION['game']))
{
	$p1 = new Player("Player/X/", "X");
	$p2 = new Player("Player/O/", "O");
	$newBoard = new Board();
	$newGame = new TicTacToe($newBoard, $p1, $p2);
}
else
{
	$newGame = unserialize($_SESSION['game']);
}
$_SESSION['game'] = serialize($newGame);

//only here for testing
//session_destroy(); 
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Tic-Tac-Toe. This is the title. It is displayed in the titlebar of the window in most browsers.</title>
    <meta name="description" content="Tic-Tac-Toe-Game. Here is a short description for the page. This text is displayed e. g. in search engine result listings.">
    <style>
        table.tic td {
            border: 1px solid #333; /* grey cell borders */
            width: 8rem;
            height: 8rem;
            vertical-align: middle;
            text-align: center;
            font-size: 4rem;
            font-family: Arial;
        }
        table { margin-bottom: 2rem; }
        input.field {
            border: 0;
            background-color: white;
            color: white; /* make the value invisible (white) */
            height: 8rem;
            width: 8rem !important;
            font-family: Arial;
            font-size: 4rem;
            font-weight: normal;
            cursor: pointer;
        }
        input.field:hover {
            border: 0;
            color: #c81657; /* red on hover */
        }
        .colorX { color: #e77; } /* X is light red */
        .colorO { color: #77e; } /* O is light blue */
        table.tic { border-collapse: collapse; }
    </style>
</head>
<body>
    <section>
        <h1>Tic-Tac-Toe</h1>
        <article id="mainContent">
            <h2>Your free browsergame!</h2>
            <p>Type your game instructions here...</p>
            <form method="get" action="index.php">
                <?php
					//calls the method of the 'board' to display its array
					$newGame->board->displayBoard($newGame);
					$newGame->setSymbol();
					//saves the state of the game
					$_SESSION['game'] = serialize($newGame);
				?>
            </form>
        </article>
    </section>
</body>
</html>






