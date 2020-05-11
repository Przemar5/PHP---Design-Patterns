<?php


interface State
{
	public function changeState();
	public function undoStateChange();
}


class Changer implements State
{
	public State $state;


	public function __construct()
	{
		$this->state = new ConcreteState1($this);
	}

	public function changeState()
	{
		$this->state->changeState();
	}

	public function undoStateChange()
	{
		$this->state->undoStateChange();
	}

	public function setState(State $state)
	{
		$this->state = $state;
	}
}


class ConcreteState1 implements State
{
	private Changer $_changer;
	public string $name;


	public function __construct(Changer $changer)
	{
		$this->_changer = $changer;
		$this->name = 'ConcreteState1';
	}

	public function changeState()
	{
		$this->_changer->setState(new ConcreteState2($this->_changer));
	}

	public function undoStateChange()
	{
		$this->_changer->setState(new ConcreteState3($this->_changer));
	}
}


class ConcreteState2 implements State
{
	private Changer $_changer;
	public string $name;


	public function __construct(Changer $changer)
	{
		$this->_changer = $changer;
		$this->name = 'ConcreteState2';
	}

	public function changeState()
	{
		$this->_changer->setState(new ConcreteState3($this->_changer));
	}

	public function undoStateChange()
	{
		$this->_changer->setState(new ConcreteState1($this->_changer));
	}
}


class ConcreteState3 implements State
{
	private Changer $_changer;
	public string $name;


	public function __construct(Changer $changer)
	{
		$this->_changer = $changer;
		$this->name = 'ConcreteState3';
	}

	public function changeState()
	{
		$this->_changer->setState(new ConcreteState1($this->_changer));
	}

	public function undoStateChange()
	{
		$this->_changer->setState(new ConcreteState2($this->_changer));
	}
}


$changer = new Changer;
echo $changer->state->name, '<br>';
$changer->changeState();
echo $changer->state->name, '<br>';
$changer->changeState();
echo $changer->state->name, '<br>';
$changer->changeState();