<?php

class Deck
{
    	private static $instance = null;

	public $cards = array(2,3,4,5,6,7,8,9,10,'J', 'Q', 'K', 'A'); 
	public $diamonds = [];
	public $clubs = [];
	public $hearts = [];
	public $spades = [];
	public $deck = []; 


	public static function getInstance()
	{
		if (self::$instance == null) {
		    self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct()
	{
		foreach($this->cards as $key => $card){
			$this->diamonds[] = '&diams;' . $card; 
			$this->clubs[] = '&clubs;'. $card; 
			$this->hearts[] = '&hearts;'. $card; 
			$this->spades[] = '&spades;'. $card; 
		}		

		$this->deck = array_merge($this->diamonds, $this->clubs, $this->hearts, $this->spades);

		echo 'Aantal Kaarten: ' . count($this->deck) . '<br>'	;
	}

	public function getCount()
	{
		$count = 0;

		foreach($this->deck as $key => $suit){
			$count += count($this->deck[$key]);
		}
		return $count;
	}

	public static function getDeck()
	{
		return $this->deck;
	}

	public function shuffle()
	{
		shuffle($this->deck);
		
		return $this->deck;
	}

	public function takeCard($name = null, $count = 1)
	{
		if(empty($this->deck)){
			echo date("h:i:sa") . ": Game Over <br>";
			exit();
		}
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