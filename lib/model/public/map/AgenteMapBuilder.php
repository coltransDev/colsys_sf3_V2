<?php



class AgenteMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.AgenteMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(AgentePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AgentePeer::TABLE_NAME);
		$tMap->setPhpName('Agente');
		$tMap->setClassname('Agente');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_agentes_id');

		$tMap->addPrimaryKey('CA_IDAGENTE', 'CaIdagente', 'INTEGER', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_ZIPCODE', 'CaZipcode', 'VARCHAR', false, null);

		$tMap->addColumn('CA_WEBSITE', 'CaWebsite', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ACTIVO', 'CaActivo', 'BOOLEAN', false, null);

	} 
} 