<?php


abstract class BridgeObject
{
	protected Implementation $_implementation;


	public function __construct(Implementation $implementation)
	{
		$this->_implementation = $implementation;
	}

	public function operation()
	{
		$this->_implementation->operation();
	}
}


class BridgeObjectExtended extends BridgeObject
{
	//
}


interface Implementation
{
	public function operation();
}


class ConcreteImplementation1 implements Implementation
{
	public function operation()
	{
		echo 'ConcreteImplementation1 operation is being performed.<br>';
	}
}


class ConcreteImplementation2 implements Implementation
{
	public function operation()
	{
		echo 'ConcreteImplementation2 operation is being performed.<br>';
	}
}


$object = new BridgeObjectExtended(new ConcreteImplementation1);
$object->operation();
$object = new BridgeObjectExtended(new ConcreteImplementation2);
$object->operation();