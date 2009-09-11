<?php



class RepCostoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepCostoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepCostoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepCostoPeer::TABLE_NAME);
		$tMap->setPhpName('RepCosto');
		$tMap->setClassname('RepCosto');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDCOSTO', 'CaIdcosto', 'INTEGER', 'tb_costos', 'CA_IDCOSTO', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_VLRCOSTO', 'CaVlrcosto', 'NUMERIC', true, null);

		$tMap->addColumn('CA_MINCOSTO', 'CaMincosto', 'NUMERIC', false, null);

		$tMap->addColumn('CA_NETCOSTO', 'CaNetcosto', 'NUMERIC', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DETALLES', 'CaDetalles', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 