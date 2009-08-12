<?php



class CotContactoAgMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotContactoAgMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CotContactoAgPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotContactoAgPeer::TABLE_NAME);
		$tMap->setPhpName('CotContactoAg');
		$tMap->setClassname('CotContactoAg');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER' , 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addPrimaryKey('CA_IDCONTACTO', 'CaIdcontacto', 'VARCHAR', true, null);

	} 
} 