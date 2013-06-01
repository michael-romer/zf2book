<?php
namespace Helloworld\Entity;

class UserAddress
{
	private $street;
	private $streetNumber;
	private $zipcode;
	private $city;

	public function setStreet($street)
	{
		$this->street = $street;
	}

	public function getStreet()
	{
		return $this->street;
	}

	public function setCity($city)
	{
		$this->city = $city;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function setStreetNumber($streetNumber)
	{
		$this->streetNumber = $streetNumber;
	}

	public function getStreetNumber()
	{
		return $this->streetNumber;
	}

	public function setZipcode($zipcode)
	{
		$this->zipcode = $zipcode;
	}

	public function getZipcode()
	{
		return $this->zipcode;
	}
}