<?php


interface Target
{
	public function request(): void;
}


class Adapter implements Target
{
	private Adaptee $adaptee;


	public function __construct(Adaptee $adaptee)
	{
		$this->_adaptee = $adaptee;
	}

	public function request(): void
	{
		$this->_adaptee->use();
	}
}


class Adaptee
{
	public function use(): void
	{
		echo 'Requested adaptee.<br>';
	}
}


$adapter = new Adapter(new Adaptee);
$adapter->request();