<?php

namespace models;

class Cinema
{
	private $id;
	private $name;
	private $address;
	private $capacity;
	private $ticketPrice;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function  getName()
	{
		return $this->name;
	}

	public function  setName($name)
	{
		$this->name = $name;
	}

	public function  getAddress()
	{
		return $this->address;
	}

	public function  setAddress($address)
	{
		$this->address = $address;
	}

	public function getCapacity()
	{
		return $this->capacity;
	}

	public function setCapacity($capacity)
	{
		$this->capacity = $capacity;
	}

	public function getTicketPrice()
	{
		return $this->ticketPrice;
	}

	public function setTicketPrice($ticketPrice)
	{
		$this->ticketPrice= $ticketPrice;
	}
}
