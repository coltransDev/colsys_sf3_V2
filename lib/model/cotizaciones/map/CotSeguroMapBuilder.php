<?php



class CotSeguroMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotSeguroMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CotSeguroPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotSeguroPeer::TABLE_NAME);
		$tMap->setPhpName('CotSeguro');
		$tMap->setClassname('CotSeguro');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotseguro_id');

		$tMap->addPrimaryKey('CA_IDSEGURO', 'CaIdseguro', 'VARCHAR', true, null);

		$tMap->addForeignKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER', 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignKey('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', 'tb_monedas', 'CA_IDMONEDA', true, null);

		$tMap->addColumn('CA_PRIMA_TIP', 'CaPrimaTip', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PRIMA_VLR', 'CaPrimaVlr', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PRIMA_MIN', 'CaPrimaMin', 'NUMERIC', false, null);

		$tMap->addColumn('CA_OBTENCION', 'CaObtencion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

	} 
} 