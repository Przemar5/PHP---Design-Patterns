<?php


class Originator
{
	private string $_state;


	public function __construct(string $state)
	{
		$this->_state = $state;
	}

	public function getState(): string
	{
		return $this->_state;
	}

	public function doOperation(): void
	{
		$this->_state .= ' next,';
	}

	public function save(): Memento
	{
		return new ConcreteMemento($this->_state);
	}

	public function restore(Memento $memento): void
	{
		$this->_state = $memento->getState();
	}
}


interface Memento
{
	public function getState(): string;
	public function getName(): string;
	public function getDate(): string;
}


class ConcreteMemento implements Memento
{
	private string $_state;
	private string $_date;


	public function __construct(string $state)
	{
		$this->_state = $state;
		$this->_date = date('Y-m-d H:i:s');
	}

	public function getState(): string
	{
		return $this->_state;
	}

	public function getName(): string
	{
		return $this->_date . ' / (' . substr($this->_state, 0, 9) . '...)';
	}

	public function getDate(): string
	{
		return $this->_date;
	}
}


class Caretaker
{
	private Originator $_originator;
	private array $_mementos = [];


	public function __construct(Originator $originator)
	{
		$this->_originator = $originator;
	}

	public function backUp(): void
	{
		echo "Caretaker: saving originator's state...<br>";
		$this->_mementos[] = $this->_originator->save();
	}

	public function undo(): void
	{
		if (!count($this->_mementos))
		{
			echo 'Nothing to undo.<br>';
			return;
		}

		$memento = array_pop($this->_mementos);

		echo "Caretaker: Restoring state to " . $memento->getName() . "<br>";
		
		try 
		{
			$this->_originator->restore($memento);
		}
		catch (\Exception $e)
		{
			$this->undo();
		}
	}

	public function showHistory(): void
	{
		echo "Caretaker: here's the list of momentos:<br>";

		foreach ($this->_mementos as $memento)
		{
			echo $memento->getName() . "<br>";
		}
	}
}


$originator = new Originator('First');
$caretaker = new Caretaker($originator);
echo $originator->getState() . '<br>';
echo $originator->save()->getName();

$caretaker->backUp();
$originator->doOperation();
echo $originator->getState() . '<br>';

$caretaker->backUp();
$originator->doOperation();
echo $originator->getState() . '<br>';

$caretaker->backUp();
$originator->doOperation();
echo $originator->getState() . '<br>';

$caretaker->showHistory();

echo "Rollback<br>";
$caretaker->undo();
echo $originator->getState() . '<br>';