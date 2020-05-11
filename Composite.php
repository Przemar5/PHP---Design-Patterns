<?php


interface Operable
{
	public function doOperation();
}


abstract class Component
{
	protected string $_name;


	public function __construct(string $name)
	{
		$this->_name = $name;
	}

}


class Composite extends Component implements Operable
{
	protected Component $_parent;
	protected array $_children;


	public function setParent(Composite $parent): void
	{
		$this->_parent = $parent;
	}

	public function addChild(Component $child): void
	{
		$this->_children[] = $child;
	}

	public function doOperation(): string
	{
		$string = $this->_name . ', ';

		foreach ($this->_children as $child)
		{
			$string .= $child->doOperation();
		}

		return $string;
	}
}


class Leaf extends Component implements Operable
{
	public function doOperation(): string
	{
		return $this->_name . ', ';
	}
}


$composite1 = new Composite('composite1');
$composite2 = new Composite('composite2');
$composite3 = new Composite('composite3');
$leaf1 = new Leaf('leaf1');
$leaf2 = new Leaf('leaf2');
$leaf3 = new Leaf('leaf3');
$leaf4 = new Leaf('leaf4');

$composite1->addChild($composite2);
$composite1->addChild($composite3);
$composite2->addChild($leaf1);
$composite2->addChild($leaf2);
$composite3->addChild($leaf3);
$composite3->addChild($leaf4);

echo $composite1->doOperation();