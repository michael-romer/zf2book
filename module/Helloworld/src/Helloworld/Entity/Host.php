<?php
namespace Helloworld\Entity;

class Host
{
	protected $id;
	protected $ip;
	protected $hostname;

	public function getHostname()
	{
		return $this->hostname;
	}

	public function getIp()
	{
		return $this->ip;
	}

	public function setIp($ip)
	{
		$this->ip = $ip;
	}

	public function setHostname($hostname)
	{
		$this->hostname = $hostname;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}
}