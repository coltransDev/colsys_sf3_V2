<?php



class CotOpcionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotOpcionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CotOpcionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotOpcionPeer::TABLE_NAME);
		$tMap->setPhpName('CotOpcion');
		$tMap->setClassname('CotOpcion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotopciones_id');

		$tMap->addPrimaryKey('CA_IDOPCION', 'CaIdopcion', 'VARCHAR', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER' , 'tb_cotproductos', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'INTEGER' , 'tb_cotproductos', 'CA_IDPRODUCTO', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', false, null);

		$tMap->addColumn('CA_VALOR_TAR', 'CaValorTar', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICA_TAR', 'CaAplicaTar', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALOR_MIN', 'CaValorMin', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICA_MIN', 'CaAplicaMin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addColumn('CA_RECARGOS', 'CaRecargos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', false, null);

	} 
} 