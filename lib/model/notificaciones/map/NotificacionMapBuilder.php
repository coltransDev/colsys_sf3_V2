<?php



class NotificacionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.notificaciones.map.NotificacionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(NotificacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(NotificacionPeer::TABLE_NAME);
		$tMap->setPhpName('Notificacion');
		$tMap->setClassname('Notificacion');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDTAREA', 'CaIdtarea', 'INTEGER' , 'notificaciones.tb_tareas', 'CA_IDTAREA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDEMAIL', 'CaIdemail', 'INTEGER' , 'tb_emails', 'CA_IDEMAIL', true, null);

	} 
} 