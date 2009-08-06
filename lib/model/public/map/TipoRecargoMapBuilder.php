<?php



class TipoRecargoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TipoRecargoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TipoRecargoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TipoRecargoPeer::TABLE_NAME);
		$tMap->setPhpName('TipoRecargo');
		$tMap->setClassname('TipoRecargo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_tiporecargo_id');

		$tMap->addPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER', true, null);

		$tMap->addColumn('CA_RECARGO', 'CaRecargo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REPORTE', 'CaReporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', false, null);

	} 
} 