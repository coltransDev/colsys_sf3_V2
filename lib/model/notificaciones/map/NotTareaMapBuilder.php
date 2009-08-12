<?php



class NotTareaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.notificaciones.map.NotTareaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(NotTareaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(NotTareaPeer::TABLE_NAME);
		$tMap->setPhpName('NotTarea');
		$tMap->setClassname('NotTarea');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('notificaciones.tb_tareas_id');

		$tMap->addPrimaryKey('CA_IDTAREA', 'CaIdtarea', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDLISTATAREA', 'CaIdlistatarea', 'INTEGER', 'notificaciones.tb_listatareas', 'CA_IDLISTATAREA', false, null);

		$tMap->addColumn('CA_URL', 'CaUrl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TITULO', 'CaTitulo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TEXTO', 'CaTexto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHVISIBLE', 'CaFchvisible', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_FCHTERMINADA', 'CaFchterminada', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUTERMINADA', 'CaUsuterminada', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PRIORIDAD', 'CaPrioridad', 'INTEGER', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NOTIFICAR', 'CaNotificar', 'VARCHAR', false, null);

	} 
} 