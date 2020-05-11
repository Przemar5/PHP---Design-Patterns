<?php


interface DrinkInterface
{
	public function cost(): float;
}


abstract class Drink
{
	public float $price;


	public function cost(): float
	{
		return $this->price;
	}
}


class Juice extends Drink implements DrinkInterface
{
	public function __construct()
	{
		$this->price = 2.5;
	}
}


class Tea extends Drink implements DrinkInterface
{
	public function __construct()
	{
		$this->price = 3.0;
	}
}

class Decorator implements DrinkInterface
{
	public float $price;
	private DrinkInterface $_drink;


	public function __construct(DrinkInterface $drink)
	{
		$this->_drink = $drink;
	}

	public function cost(): float
	{
		if ($this->_drink != null)
			return $this->price + $this->_drink->cost();
		else
			return $this->price;
	}
}


class SugarAddon extends Decorator implements DrinkInterface
{
	public function __construct(DrinkInterface $drink)
	{
		parent::__construct($drink);
		$this->price = 1.0;
	}
}



$order = new SugarAddon(new Tea);
echo 'Cost of tea with sugar: ' . $order->cost() . '<br>';

$order = new SugarAddon(new Juice);
echo 'Cost of juice with sugar: ' . $order->cost() . '<br>';