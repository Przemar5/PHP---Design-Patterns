<?php


class Prototype
{
	public int $primitive;
	public \DateTime $component;
	public ComponentWithBackReference $circularReference;


	public function __clone()
	{
		$this->component = clone $this->component;
		$this->circularReference = clone $this->circularReference;
		$this->circularReference->prototype = $this;
	}
}


class ComponentWithBackReference
{
	public Prototype $prototype;


	public function __construct(Prototype $prototype)
	{
		$this->prototype = $prototype;
	}
}


$prototype1 = new Prototype;
$prototype1->primitive = 12;
$prototype1->component = new \DateTime;
$prototype1->circularReference = new ComponentWithBackReference($prototype1);
$prototype2 = clone $prototype1;

if ($prototype1->primitive === $prototype1->primitive &&
	$prototype1->component === $prototype1->component &&
	$prototype1->circularReference === $prototype1->circularReference &&
	$prototype1->circularReference->prototype === $prototype1->circularReference->prototype)
	echo 'Everything had been cloned successfully!<br>';