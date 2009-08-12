<?php



class InoIngresosSeaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.sea.map.InoIngresosSeaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(InoIngresosSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoIngresosSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoIngresosSea');
		$tMap->setClassname('InoIngresosSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR' , 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER' , 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addPrimaryKey('CA_HBLS', 'CaHbls', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_FACTURA', 'CaFactura', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHFACTURA', 'CaFchfactura', 'DATE', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NETO', 'CaNeto', 'NUMERIC', false, null);

		$tMap->addColumn('CA_VALOR', 'CaValor', 'NUMERIC', false, null);

		$tMap->addColumn('CA_RECCAJA', 'CaReccaja', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHPAGO', 'CaFchpago', 'DATE', false, null);

		$tMap->addColumn('CA_TCAMBIO', 'CaTcambio', 'NUMERIC', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} 
} 