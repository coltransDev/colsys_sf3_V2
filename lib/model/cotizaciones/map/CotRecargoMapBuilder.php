<?php



class CotRecargoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotRecargoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CotRecargoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotRecargoPeer::TABLE_NAME);
		$tMap->setPhpName('CotRecargo');
		$tMap->setClassname('CotRecargo');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER', true, null);

		$tMap->addPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'INTEGER', true, null);

		$tMap->addForeignPrimaryKey('CA_IDOPCION', 'CaIdopcion', 'INTEGER' , 'tb_cotopciones', 'CA_IDOPCION', true, null);

		$tMap->addPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', true, null);

		$tMap->addForeignPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER' , 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALOR_TAR', 'CaValorTar', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICA_TAR', 'CaAplicaTar', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALOR_MIN', 'CaValorMin', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICA_MIN', 'CaAplicaMin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addPrimaryKey('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', false, null);

	} 
} 