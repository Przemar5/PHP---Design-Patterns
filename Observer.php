<?php


class SubjectExample implements \SplSubject
{
	private array $observers;
	public int $value;


	public function __construct()
	{
		$this->value = 1;
	}

	public function attach(\SplObserver $observer)
	{
		$this->observers[] = $observer;
	}

	public function detach(\SplObserver $observer)
	{
		$key = array_search($observer, $this->observers, true);

		if ($key)
		{
			unset($this->observers[$key]);
		}
	}

	public function notify()
	{
		foreach ($this->observers as $observer)
		{
			$observer->update($this);
		}
	}

	public function change()
	{
		$this->value++;
	}
}


class ObserverExample implements \SplObserver
{
	private \SplSubject $subject;

	public function update(\SplSubject $subject)
	{
		$this->subject = $subject;
	}

	public function printValue()
	{
		if ($this->subject)
			echo "Subject's value: " . $this->subject->value . "<br>";
		else
			echo "Subject hasn't been set yet.<br>";
	}
}


$subject = new SubjectExample;
$observer1 = new ObserverExample;
$observer2 = new ObserverExample;

$subject->attach($observer1);
$subject->attach($observer2);

$subject->notify();
$observer1->printValue();
$observer2->printValue();
$subject->change();
$subject->notify();
$observer1->printValue();
$observer2->printValue();
