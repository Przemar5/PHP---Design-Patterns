<?php


interface Handler
{
	public function setNext(Handler $handler): Handler;
	public function handle(string $request): ?string;
}


abstract class AbstractHandler implements Handler
{
	private Handler $_nextHandler;


	public function setNext(Handler $handler): Handler
	{
		$this->_nextHandler = $handler;

		return $handler;
	}

	public function handle(string $request): ?string
	{
		if (isset($this->_nextHandler))
		{
			return $this->_nextHandler->handle($request);
		}

		return null;
	}
}


class FirstHandler extends AbstractHandler
{
	public function handle(string $request): ?string
	{
		if ($request === "1")
		{
			return __CLASS__ . ' handles request: ' . $request . '<br>';
		}
		else
		{
			return parent::handle($request);
		}
	}
}


class SecondHandler extends AbstractHandler
{
	public function handle(string $request): ?string
	{
		if ($request === "2")
		{
			return __CLASS__ . ' handles request: ' . $request . '<br>';
		}
		else
		{
			return parent::handle($request);
		}
	}
}


function clientCode(Handler $handler)
{
	foreach (['1', '2', '3'] as $arg)
	{
		echo '<br>Request: ' . $arg . '<br>';
		$result = $handler->handle($arg);

		if ($result)
		{
			echo $result;
		}
		else
		{
			echo "Request: $arg was'n handled.<br>";
		}
	}
}


$firstHandler = new FirstHandler;
$secondHandler = new SecondHandler;

$firstHandler->setNext($secondHandler);

clientCode($firstHandler);
clientCode($secondHandler);