<?php

require_once('Deck.php');

class Player
{
	private $name;
	private $cards = [];

	function __construct($name) {
		$this->name = $name;
	}

	public function getHand()
	{
		return $this->cards;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getCards($cards)
	{
		$deck = Deck::getInstance();
		$this->cards = $deck->takeCard($this->name, 7);
	}
}