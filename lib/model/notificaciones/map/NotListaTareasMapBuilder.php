<?php



class NotListaTareasMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.notificaciones.map.NotListaTareasMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(NotListaTareasPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(NotListaTareasPeer::TABLE_NAME);
		$tMap->setPhpName('NotListaTareas');
		$tMap->setClassname('NotListaTareas');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('notificaciones.tb_listatareas_id');

		$tMap->addPrimaryKey('CA_IDLISTATAREA', 'CaIdlistatarea', 'INTEGER', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESCRIPCION', 'CaDescripcion', 'VARCHAR', false, null);

	} 
} 