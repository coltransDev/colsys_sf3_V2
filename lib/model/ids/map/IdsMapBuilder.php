<?php



class IdsMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsPeer::TABLE_NAME);
		$tMap->setPhpName('Ids');
		$tMap->setClassname('Ids');

		$tMap->setUseIdGenerator(false);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_ids_id');

		$tMap->addPrimaryKey('CA_ID', 'CaId', 'INTEGER', true, null);

		$tMap->addColumn('CA_DV', 'CaDv', 'INTEGER', false, null);

		$tMap->addColumn('CA_IDALTERNO', 'CaIdalterno', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIPOIDENTIFICACION', 'CaTipoidentificacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDGRUPO', 'CaIdgrupo', 'INTEGER', false, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_WEBSITE', 'CaWebsite', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ACTIVIDAD', 'CaActividad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SECTORECO', 'CaSectoreco', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 