<?php



class CotContinuacionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotContinuacionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CotContinuacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotContinuacionPeer::TABLE_NAME);
		$tMap->setPhpName('CotContinuacion');
		$tMap->setClassname('CotContinuacion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotcontinuacion_id');

		$tMap->addPrimaryKey('CA_IDCONTINUACION', 'CaIdcontinuacion', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER', 'tb_cotizaciones', 'CA_IDCOTIZACION', false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDEQUIPO', 'CaIdequipo', 'INTEGER', false, null);

		$tMap->addColumn('CA_TARIFA', 'CaTarifa', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALOR_TAR', 'CaValorTar', 'NUMERIC', false, null);

		$tMap->addColumn('CA_VALOR_MIN', 'CaValorMin', 'NUMERIC', false, null);

		$tMap->addColumn('CA_FRECUENCIA', 'CaFrecuencia', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIEMPOTRANSITO', 'CaTiempotransito', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 