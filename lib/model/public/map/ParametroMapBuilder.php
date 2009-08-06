<?php



class ParametroMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.ParametroMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ParametroPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ParametroPeer::TABLE_NAME);
		$tMap->setPhpName('Parametro');
		$tMap->setClassname('Parametro');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_parametros_ca_casouso_seq');

		$tMap->addPrimaryKey('CA_CASOUSO', 'CaCasouso', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_IDENTIFICACION', 'CaIdentificacion', 'INTEGER', true, null);

		$tMap->addPrimaryKey('CA_VALOR', 'CaValor', 'VARCHAR', true, null);

		$tMap->addColumn('CA_VALOR2', 'CaValor2', 'VARCHAR', false, null);

	} 
} 