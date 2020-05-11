<?php


abstract class Factory
{
	public float $price;
	abstract public function create(): Product;

	public function useProduct(): void
	{
		$product = $this->create();

		$product->use();
	}
}


class Product1Factory extends Factory
{
	public function create(): Product
	{
		return new Product1;
	}
}


class Product2Factory extends Factory
{
	public function create(): Product
	{
		return new Product2;
	}
}


interface Product
{
	public function use(): void; 
}


class Product1 implements Product
{
	public function use(): void
	{
		echo 'Product1 is being used.<br>';
	}
}


class Product2 implements Product
{
	public function use(): void
	{
		echo 'Product2 is being used.<br>';
	}
}


function init(Factory $factory)
{
	$factory->useProduct();
}


init(new Product1Factory);
init(new Product2Factory);