<?php



class PricNotificacionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.PricNotificacionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PricNotificacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricNotificacionPeer::TABLE_NAME);
		$tMap->setPhpName('PricNotificacion');
		$tMap->setClassname('PricNotificacion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_pricnotificaciones_id');

		$tMap->addPrimaryKey('CA_IDNOTIFICACION', 'CaIdnotificacion', 'INTEGER', true, null);

		$tMap->addColumn('CA_TITULO', 'CaTitulo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_MENSAJE', 'CaMensaje', 'VARCHAR', true, null);

		$tMap->addColumn('CA_CADUCIDAD', 'CaCaducidad', 'DATE', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, 15);

	} 
} 