<?php

require_once('Deck.php');
require_once('Player.php');

class Dealer
{	
    	private static $instance;
    	public $player1;
    	public $player2;
    	public $player3;
    	public $player4;
    	public $order = [];
    	public $turn = 0;
    	public $current;
    	private $topCard;

    	public function setTopCard($card){
    		$this->topCard = $card;
    	}

	public static function getInstance()
	{
		if (!isset(self::$instance)) {
		    self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$deck = Deck::getInstance();

		$this->player1 = new Player('Peter');
		$this->order[] = $this->player1;
		$this->player2 = new Player('Jan');
		$this->order[] = $this->player2;
		$this->player3= new Player('Kees');
		$this->order[] = $this->player3;
		$this->player4 = new Player('Klaas');
		$this->order[] = $this->player4;

		$deck->shuffle();
		$this->dealCards($deck);

	}

	public function getTurn(){
		$currentPlayer = $this->order[$this->turn];
		echo date("h:i:sa") . ": It is "  . $currentPlayer->getName() . "'s turn <br>";
		$this->turn++;

		$this->getOptions($currentPlayer);
	}

	public function getOptions($player)
	{
		$topCard = $this->topCard;
		$suit = substr($topCard, 0, 1);
		echo $suit;	
		print_r($player->getHand());
	}

	public function dealCards(Deck $deck)
	{
		echo date("h:i:sa") . ": Starting game with " .
		$this->player1->getName() . ", " .
		$this->player2->getName() . ", " .
		$this->player3->getName() . ", en " .
		$this->player4->getName()  . "<br>";

		$this->player1->getCards(7);
		$this->player2->getCards(7);
		$this->player3->getCards(7);
		$this->player4->getCards(7);
		$deck->takeCard(null, 1);
		$this->getTurn();
	}
}