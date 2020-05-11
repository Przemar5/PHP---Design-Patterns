<?php


interface Command
{
	public function execute();
}


class TurnOnCommand implements Command
{
	private Receiver $_receiver;


	public function __construct(Receiver $receiver)
	{
		$this->_receiver = $receiver;
	}

	public function execute()
	{
		$this->_receiver->turnOn();
	}
}


class TurnOffCommand implements Command
{
	private Receiver $_receiver;


	public function __construct(Receiver $receiver)
	{
		$this->_receiver = $receiver;
	}

	public function execute()
	{
		$this->_receiver->turnOff();
	}
}


class Receiver
{
	public function turnOn()
	{
		echo "Receiver is now on.<br>";
	}

	public function turnOff()
	{
		echo "Receiver is now off.<br>";
	}
}


class Invoker
{
	private Command $_firstAction;
	private Command $_secondAction;


	public function executeFirstAction()
	{
		$this->_firstAction->execute();
	}

	public function executeSecondAction()
	{
		$this->_secondAction->execute();
	}

	public function setFirstAction(Command $command)
	{
		$this->_firstAction = $command;
	}

	public function setSecondAction(Command $command)
	{
		$this->_secondAction = $command;
	}
}


$receiver = new Receiver;
$invoker = new Invoker;
$turnOnCommand = new TurnOnCommand($receiver);
$turnOffCommand = new TurnOffCommand($receiver);
$invoker->setFirstAction($turnOnCommand);
$invoker->setSecondAction($turnOffCommand);
$invoker->executeFirstAction();
$invoker->executeSecondAction();