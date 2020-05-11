<?php


interface AbstractFactoryInterface
{
	public function getChair(): Chair;
	public function getTable(): Table;
	public function getSofa(): Sofa;
}


class VictorianCollectionFactory 
implements AbstractFactoryInterface
{
	public function getChair(): Chair
	{
		return new VictorianChair;
	}

	public function getTable(): Table
	{
		return new VictorianTable;
	}

	public function getSofa(): Sofa
	{
		return new VictorianSofa;
	}
}


class ModernCollectionFactory 
implements AbstractFactoryInterface
{
	public function getChair(): Chair
	{
		return new ModernChair;
	}

	public function getTable(): Table
	{
		return new ModernTable;
	}

	public function getSofa(): Sofa
	{
		return new ModernSofa;
	}
}


interface Chair
{
	public function introduceChair(): void;
}


interface Table
{
	public function introduceTable(): void;
}


interface Sofa
{
	public function introduceSofa(): void;
}


class VictorianChair implements Chair
{
	public function introduceChair(): void
	{
		echo "It's victorian chair.<br>";
	}
}


class ModernChair implements Chair
{
	public function introduceChair(): void
	{
		echo "It's modern chair.<br>";
	}
}


class VictorianTable implements Table
{
	public function introduceTable(): void
	{
		echo "It's victorian table.<br>";
	}
}


class ModernTable implements Table
{
	public function introduceTable(): void
	{
		echo "It's modern table.<br>";
	}
}


class VictorianSofa implements Sofa
{
	public function introduceSofa(): void
	{
		echo "It's victorian sofa.<br>";
	}
}


class ModernSofa implements Sofa
{
	public function introduceSofa(): void
	{
		echo "It's modern sofa.<br>";
	}
}


$victorian = new VictorianCollectionFactory;
$victorianChair = $victorian->getChair();
$victorianTable = $victorian->getTable();
$victorianSofa = $victorian->getSofa();
$victorianChair->introduceChair();
$victorianTable->introduceTable();
$victorianSofa->introduceSofa();

$modern = new ModernCollectionFactory;
$modernChair = $modern->getChair();
$modernTable = $modern->getTable();
$modernSofa = $modern->getSofa();
$modernChair->introduceChair();
$modernTable->introduceTable();
$modernSofa->introduceSofa();


