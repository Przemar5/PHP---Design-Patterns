<?php


abstract class Template
{
	final public function doOperation()
	{
		$this->beforeOperation();
		$this->afterOperation();
	}

	public function beforeOperation()
	{
		echo 'Before Template operation.<br>';
	}

	public function afterOperation()
	{
		echo 'After Template operation.<br>';
	}
}


class ConcreteTemplate extends Template
{
	public function afterOperation()
	{
		echo 'After ConcreteTemplate operation.<br>';
	}
}


$template = new ConcreteTemplate;
$template->doOperation();