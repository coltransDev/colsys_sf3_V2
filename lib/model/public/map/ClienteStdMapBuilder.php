<?php



class ClienteStdMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.ClienteStdMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(ClienteStdPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ClienteStdPeer::TABLE_NAME);
		$tMap->setPhpName('ClienteStd');
		$tMap->setClassname('ClienteStd');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER' , 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addPrimaryKey('CA_FCHESTADO', 'CaFchestado', 'DATE', true, null);

		$tMap->addColumn('CA_ESTADO', 'CaEstado', 'VARCHAR', false, null);

		$tMap->addPrimaryKey('CA_EMPRESA', 'CaEmpresa', 'VARCHAR', true, null);

	} 
} 