<?php



class RecargoFleteMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.RecargoFleteMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RecargoFletePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RecargoFletePeer::TABLE_NAME);
		$tMap->setPhpName('RecargoFlete');
		$tMap->setClassname('RecargoFlete');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'INTEGER' , 'tb_fletes', 'CA_IDTRAYECTO', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER' , 'tb_fletes', 'CA_IDCONCEPTO', true, null);

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

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 