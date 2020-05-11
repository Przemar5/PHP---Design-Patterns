<?php


class CollectionIterator implements \Iterator
{
	private \IteratorAggregate $_collection;
	private int $_position = 0;
	private bool $_reverse = false;


	public function __construct(\IteratorAggregate $collection, ?bool $reverse = false)
	{
		$this->_collection = $collection;
		$this->_reverse = $reverse;
	}

	public function rewind(): void
	{
		$this->_position = $this->_reverse 
			? count($this->_collection->getItems()) - 1 : 0;
	}

	public function current()
	{
		return $this->_collection->getItems()[$this->_position];
	}

	public function key(): scalar
	{
		return $this->_position;
	}

	public function next(): void
	{
		$this->_position = $this->_position + ($this->_reverse ? -1 : 1);
	}

	public function valid(): bool
	{
		return isset($this->_collection->getItems()[$this->_position]);
	}
}


class Collection implements \IteratorAggregate
{
	private array $_items = [];


	public function getItems(): array
	{
		return $this->_items;
	}

	public function addItem($item)
	{
		$this->_items[] = $item;
	}

	public function getIterator(): \Iterator
	{
		return new CollectionIterator($this);
	}

	public function getReverseIterator(): \Iterator
	{
		return new CollectionIterator($this, true);
	}
}


$collection = new Collection;
$collection->addItem('First');
$collection->addItem('Second');
$collection->addItem('Third');

foreach ($collection->getIterator() as $item)
{
	echo $item . '<br>';
}

foreach ($collection->getReverseIterator() as $item)
{
	echo $item . '<br>';
}