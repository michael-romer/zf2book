<?php
namespace Helloworld\Entity;

class User
{
	protected $id;
	protected $email;
	protected $name;
    protected $userAddress;

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

    public function setUserAddress($userAddress)
    {
        $this->userAddress = $userAddress;
    }

    public function getUserAddress()
    {
        return $this->userAddress;
    }
}