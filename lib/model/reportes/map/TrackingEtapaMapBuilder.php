<?php



class TrackingEtapaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.TrackingEtapaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TrackingEtapaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrackingEtapaPeer::TABLE_NAME);
		$tMap->setPhpName('TrackingEtapa');
		$tMap->setClassname('TrackingEtapa');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDETAPA', 'CaIdetapa', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORDEN', 'CaOrden', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TTL', 'CaTtl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CLASS', 'CaClass', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TEMPLATE', 'CaTemplate', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MESSAGE', 'CaMessage', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MESSAGE_DEFAULT', 'CaMessageDefault', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INTRO', 'CaIntro', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TITLE', 'CaTitle', 'VARCHAR', false, null);

	} 
} 