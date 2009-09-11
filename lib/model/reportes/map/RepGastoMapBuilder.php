<?php



class RepGastoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepGastoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepGastoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepGastoPeer::TABLE_NAME);
		$tMap->setPhpName('RepGasto');
		$tMap->setClassname('RepGasto');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER', 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_NETA_TAR', 'CaNetaTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_NETA_MIN', 'CaNetaMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_REPORTAR_TAR', 'CaReportarTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_REPORTAR_MIN', 'CaReportarMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_COBRAR_TAR', 'CaCobrarTar', 'NUMERIC', true, null);

		$tMap->addColumn('CA_COBRAR_MIN', 'CaCobrarMin', 'NUMERIC', true, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', true, 3);

		$tMap->addColumn('CA_DETALLES', 'CaDetalles', 'VARCHAR', true, 3);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

	} 
} 