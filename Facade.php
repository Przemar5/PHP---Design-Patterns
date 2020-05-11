<?php


class Facade
{
	private Subsystem1 $_subsystem1;
	private Subsystem2 $_subsystem2;


	public function __construct(Subsystem1 $subsystem1 = null, 
								Subsystem2 $subsystem2 = null)
	{
		$this->_subsystem1 = $subsystem1 ?? new Subsystem1;
		$this->_subsystem2 = $subsystem2 ?? new Subsystem2;
	}

	public function doOperation()
	{
		$this->_subsystem1->complexOperation();
		$this->_subsystem2->complexOperation();
	}
}


class Subsystem1
{
	public function complexOperation()
	{
		echo 'Subsystem1 complex operation.<br>';
	}
}


class Subsystem2
{
	public function complexOperation()
	{
		echo 'Subsystem2 complex operation.<br>';
	}
}


$facade = new Facade;
$facade->doOperation();