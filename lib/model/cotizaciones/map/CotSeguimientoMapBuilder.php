<?php



class CotSeguimientoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotSeguimientoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CotSeguimientoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotSeguimientoPeer::TABLE_NAME);
		$tMap->setPhpName('CotSeguimiento');
		$tMap->setClassname('CotSeguimiento');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER' , 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER' , 'tb_cotproductos', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'INTEGER' , 'tb_cotproductos', 'CA_IDPRODUCTO', true, null);

		$tMap->addPrimaryKey('CA_FCHSEGUIMIENTO', 'CaFchseguimiento', 'TIMESTAMP', true, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', true, null);

		$tMap->addColumn('CA_SEGUIMIENTO', 'CaSeguimiento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'VARCHAR', false, null);

	} 
} 