<?php

require_once('Deck.php');
require_once('Player.php');

class Dealer
{	
    	private static $instance = null;
    	public $player1;
    	public $player2;
    	public $player3;
    	public $player4;
    	public $order = [];
    	public $turn = 0;
    	public $current;
    	private $topCard;
    	private $deck;

    	public function setTopCard($card){
    		$this->topCard = $card;
    	}

	public static function getInstance()
	{
		if (self::$instance == null) {
		    self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() 
	{
		$this->deck = Deck::getInstance();
	}

	public function start()
	{
		$this->player1 = new Player('Peter');
		$this->order[] = $this->player1;
		$this->player2 = new Player('Jan');
		$this->order[] = $this->player2;
		$this->player3= new Player('Kees');
		$this->order[] = $this->player3;
		$this->player4 = new Player('Klaas');
		$this->order[] = $this->player4;
		$deck = $this->deck;
		$deck->shuffle();
		$this->dealCards($deck);
		$deck->takeCard(null, 1);
		echo "<hr>";
		while(1 == 1){
			$this->getTurn();
		}
	}

	public function getTurn(){
		$deck = Deck::getInstance();

		$currentPlayer = $this->order[$this->turn];
		echo "<hr>";
		echo date("h:i:sa") . ": It is "  . $currentPlayer->getName() . "'s turn <br>";

		if($this->turn < (count($this->order) - 1)){
			$this->turn++;
		}else{
			$this->turn = 0;
		}

		echo date("h:i:sa") . ": There are "  . $deck->getCount() . " cards left in the deck <br>";
		$this->getOptions($currentPlayer);

		return;
	}

	public function getOptions($player)
	{
		echo date("h:i:sa") . ": "  . $player->getName() . " has " . $player->handCount() . " cards left<br>";			
		echo date("h:i:sa") . ": "  . $player->getHandString()  .  "<br>";			
		$topCard = $this->topCard;
		$suit = strstr ($topCard , ';', true);
		$value = substr($topCard, strpos($topCard, ';') + 1);
		$hand = $player->getHand();
		$option = false;

		#check useable cards
		foreach($hand as $key => $card){
			#compare player card to top card

			if(strstr($card , ';', true) == $suit || substr($card, strpos($card, ';') + 1) == $value ){	
				echo date("h:i:sa") . ": "  . $player->getName() . " uses " . $card . "<br>";	
				$player->removeCard($card);
				echo date("h:i:sa") . ": "  . $player->getName() . " has " . $player->handCount() . " cards left<br>";			

				if($player->handCount() == 0){
					echo date("h:i:sa") . ": "  . $player->getName() . " has no more cards left  <br>";
					echo date("h:i:sa") . ": "  . $player->getName() . " has won the game!  <br>";
					exit();
				}
				$this->topCard = $card;
				$option = true;
				break;
			}
		}

		if($option == false){

			echo date("h:i:sa") . ": " . $player->getName() . " does not have a suitable card, taking  from deck <br>";	
			$card = $player->takeCard();
			echo date("h:i:sa") . ": "  . $player->getName() . " has " . $player->handCount() . " cards left<br>";			
		}

		echo date("h:i:sa") . ": "  . $player->getHandString()  .  "<br>";	
		echo date("h:i:sa") . ": Top card is ".  $this->topCard . "<br>";
		return;
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
	}
}