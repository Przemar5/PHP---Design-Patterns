<?php


interface Builder
{
	public function producePart1(): void;
	public function producePart2(): void;
	public function producePart3(): void;
}


class ConcreteBuilder implements Builder
{
	private Product $_product;


	public function __construct()
	{
		$this->reset();
	}

	public function reset(): void
	{
		$this->_product = new Product;
	}

	public function producePart1(): void
	{
		$this->_product->parts[] = 'Part 1';
	}

	public function producePart2(): void
	{
		$this->_product->parts[] = 'Part 2';
	}

	public function producePart3(): void
	{
		$this->_product->parts[] = 'Part 3';
	}

	public function getProduct(): Product
	{
		$result = $this->_product;
		$this->reset();

		return $result;
	}
}


class Product
{
	public array $parts = [];


	public function listParts(): void
	{
		echo 'Product parts: ' . implode(', ', $this->parts) . '<br>';
	}
}


class Director
{
	private Builder $_builder;


	public function setBuilder(Builder $builder): void
	{
		$this->_builder = $builder;
	}

	public function buildBasic(): void
	{
		$this->_builder->producePart1();
		$this->_builder->producePart2();
	}

	public function buildExtended(): void
	{
		$this->_builder->producePart1();
		$this->_builder->producePart2();
		$this->_builder->producePart3();
	}
}


$director = new Director;
$builder = new ConcreteBuilder;
$director->setBuilder($builder);

echo 'Basic:<br>';
$director->buildBasic();
$builder->getProduct()->listParts();

echo 'Extended:<br>';
$director->buildExtended();
$builder->getProduct()->listParts();