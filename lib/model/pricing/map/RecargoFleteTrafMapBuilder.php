<?php



class RecargoFleteTrafMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.RecargoFleteTrafMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RecargoFleteTrafPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RecargoFleteTrafPeer::TABLE_NAME);
		$tMap->setPhpName('RecargoFleteTraf');
		$tMap->setClassname('RecargoFleteTraf');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDTRAFICO', 'CaIdtrafico', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', true, null);

		$tMap->addForeignPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER' , 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VLRFIJO', 'CaVlrfijo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PORCENTAJE', 'CaPorcentaje', 'NUMERIC', false, null);

		$tMap->addColumn('CA_BASEPORCENTAJE', 'CaBaseporcentaje', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VLRUNITARIO', 'CaVlrunitario', 'NUMERIC', false, null);

		$tMap->addColumn('CA_BASEUNITARIO', 'CaBaseunitario', 'VARCHAR', false, null);

		$tMap->addColumn('CA_RECARGOMINIMO', 'CaRecargominimo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'DATE', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'DATE', false, null);

		$tMap->addPrimaryKey('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

	} 
} 