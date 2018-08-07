<?php

class Deck
{
    	private static $instance;

	public $cards = array(2,3,4,5,6,7,8,9,10,'J', 'Q', 'K', 'A'); 
	public $diamonds = [];
	public $clubs = [];
	public $hearts = [];
	public $spades = [];
	public $deck = []; 


	public static function getInstance()
	{
		if (!isset(self::$instance)) {
		    self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct()
	{
		foreach($this->cards as $key => $card){
			$this->diamonds[$card] = 'd' . $card; 
			$this->clubs[$card] = 'c'. $card; 
			$this->hearts[$card] = 'h'. $card; 
			$this->spades[$card] = 's'. $card; 
		}
		$this->deck = array_merge($this->diamonds, $this->clubs, $this->hearts, $this->spades);
	}

	public static function getDeck()
	{
		return $this->deck;
	}

	public function shuffle()
	{
		shuffle($this->diamonds);
		shuffle($this->clubs);
		shuffle($this->hearts);
		shuffle($this->spades);

		$deck = array_merge([$this->diamonds, $this->clubs, $this->hearts, $this->spades]);
		shuffle($deck);
		return $deck;
	}

	public function takeCard($name = null, $count = 1)
	{
		$cards = [];

		while($count > 0){
			$card = array_pop ($this->deck);
			$cards[] = $card;
			$count--;
		}

		if($name !== null){
			echo date("h:i:sa") . ": " . $name . " has been dealt ".  implode(',', $cards) . "<br>";
		}else{
			echo date("h:i:sa") . ": Top card is ".  $cards[0] . "<br>";
			$dealer = Dealer::getInstance();
			$dealer->setTopCard($cards[0]);
			return;
		}

		return $cards;
	}


}