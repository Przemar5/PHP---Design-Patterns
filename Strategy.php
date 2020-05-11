<?php


interface Strategy
{
	public function run();
}


class ConcreteStrategy1 implements Strategy
{
	public function run()
	{
		echo 'Strategy no. 1<br>';
	}
}


class ConcreteStrategy2 implements Strategy
{
	public function run()
	{
		echo 'Strategy no. 2<br>';
	}
}


class Context
{
	private Strategy $strategy;

	public function runStrategy()
	{
		$this->strategy->run();
	}

	public function setStrategy(Strategy $strategy)
	{
		$this->strategy = $strategy;
	}
}


$c = new Context;
$c->setStrategy(new ConcreteStrategy1);
$c->runStrategy();
$c->setStrategy(new ConcreteStrategy2);
$c->runStrategy();