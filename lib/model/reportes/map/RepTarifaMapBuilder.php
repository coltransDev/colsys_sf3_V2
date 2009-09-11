<?php



class RepTarifaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepTarifaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepTarifaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepTarifaPeer::TABLE_NAME);
		$tMap->setPhpName('RepTarifa');
		$tMap->setClassname('RepTarifa');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_CANTIDAD', 'CaCantidad', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NETA_TAR', 'CaNetaTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NETA_MIN', 'CaNetaMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NETA_IDM', 'CaNetaIdm', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_REPORTAR_TAR', 'CaReportarTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_REPORTAR_MIN', 'CaReportarMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_REPORTAR_IDM', 'CaReportarIdm', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_COBRAR_TAR', 'CaCobrarTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_COBRAR_MIN', 'CaCobrarMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_COBRAR_IDM', 'CaCobrarIdm', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', true, 255);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 