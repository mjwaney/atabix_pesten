<?php

require_once('Deck.php');

class Player
{
	private $name;
	private $cards = [];

	function __construct($name) {
		$this->name = $name;
	}

	public function handCount()
	{
		return count($this->cards);
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

	public function removeCard($throwCard){
		foreach($this->cards as $key => $card){
			if($card == $throwCard){
				unset($this->cards[$key]);
				return;
			}
		}
	}

	public function takeCard()
	{
		$deck = Deck::getInstance();
		$this->cards = array_merge($this->cards, $deck->takeCard($this->name, 1));
	}

	public function getHandString()
	{
		return implode('|', $this->cards);
	}
}