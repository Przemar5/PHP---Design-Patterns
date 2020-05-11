<?php


class Flyweight
{
	private $_sharedState;


	public function __construct($sharedState)
	{
		$this->_sharedState = $sharedState;
	}

	public function operation($uniqueState): void
	{
		$s = json_encode($this->_sharedState);
		$u = json_encode($uniqueState);
	}
}


class FlyweightFactory
{
	private array $_flyweights = [];


	public function __construct(array $flyweights)
	{
		$this->_flyweights = $flyweights;
	}

	public function getKey(array $state): string
	{
		ksort($state);

		return implode('_', $state);
	}

	public function getFlyweight(array $sharedState): Flyweight
	{
		$key = $this->getKey($sharedState);

		if (!isset($this->_flyweights[$key]))
		{
			echo "FlyweightFactory: can't find a flyweight.<br>";
			$this->_flyweights[$key] = new Flyweight($sharedState);
		}
		else
		{
			echo "FlyweightFactory: reusing existing flyweight.<br>";
		}

		return $this->_flyweights[$key];
	}

	public function listFlyweights(): void
	{
		$count = count($this->_flyweights);

		echo "FlyweightFactory: there are $count flyweights.<br>";

		foreach ($this->_flyweights as $key => $flyweight)
		{
			echo $key . '<br>';
		}
	}
}


$factory = new FlyweightFactory([
	['string', 'Object1', 1],
	['string', 'Object3', 3],
	['string', 'Object2', 2]
]);
$factory->listFlyweights();

function addToDatabase(FlyweightFactory $ff, $type, $object, $number): void
{
	echo 'Client: adding object to database.<br>';
	$flyweight = $ff->getFlyweight([$type]);
	$flyweight->operation([$object, $number]);
}

addToDatabase($factory, 'string', 'Object4', 4);
addToDatabase($factory, 'string', 'Object5', 5);

$factory->listFlyweights();