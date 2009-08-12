<?php



class InoAvisosSeaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.sea.map.InoAvisosSeaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(InoAvisosSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoAvisosSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoAvisosSea');
		$tMap->setClassname('InoAvisosSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR' , 'tb_inoclientes_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR' , 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER' , 'tb_inoclientes_sea', 'CA_IDCLIENTE', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER' , 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addForeignPrimaryKey('CA_HBLS', 'CaHbls', 'VARCHAR' , 'tb_inoclientes_sea', 'CA_HBLS', true, null);

		$tMap->addForeignPrimaryKey('CA_IDEMAIL', 'CaIdemail', 'INTEGER' , 'tb_emails', 'CA_IDEMAIL', true, null);

		$tMap->addColumn('CA_FCHAVISO', 'CaFchaviso', 'DATE', false, null);

		$tMap->addColumn('CA_AVISO', 'CaAviso', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDBODEGA', 'CaIdbodega', 'INTEGER', false, null);

		$tMap->addColumn('CA_FCHLLEGADA', 'CaFchllegada', 'DATE', false, null);

		$tMap->addColumn('CA_FCHENVIO', 'CaFchenvio', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUENVIO', 'CaUsuenvio', 'VARCHAR', false, null);

	} 
} 