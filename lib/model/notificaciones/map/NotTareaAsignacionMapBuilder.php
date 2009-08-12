<?php



class NotTareaAsignacionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.notificaciones.map.NotTareaAsignacionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(NotTareaAsignacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(NotTareaAsignacionPeer::TABLE_NAME);
		$tMap->setPhpName('NotTareaAsignacion');
		$tMap->setClassname('NotTareaAsignacion');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDTAREA', 'CaIdtarea', 'INTEGER' , 'notificaciones.tb_tareas', 'CA_IDTAREA', true, null);

		$tMap->addForeignPrimaryKey('CA_LOGIN', 'CaLogin', 'VARCHAR' , 'control.tb_usuarios', 'CA_LOGIN', true, null);

	} 
} 