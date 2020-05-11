<?php


interface IntroduceInterface
{
	public function introduce(): void;
}


class SomeObject implements IntroduceInterface
{
	public function introduce(): void
	{
		echo "I'm some object.";
	}
}


class NullObject implements IntroduceInterface
{
	public function introduce(): void
	{
		echo "I'm null object.";
	}
}


class Presenter
{
	private IntroduceInterface $_subject;


	public function __construct(?IntroduceInterface $subject = null)
	{
		$this->_subject = $subject ?? new NullObject;
	}

	public function introduceSubject(): void
	{
		$this->_subject->introduce();
		echo '<br>';
	}
}


$presenter = new Presenter(new SomeObject);
$presenter->introduceSubject();
$presenter2 = new Presenter();
$presenter2->introduceSubject();