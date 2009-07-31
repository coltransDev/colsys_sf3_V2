<?php



class HdeskTicketMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskTicketMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(HdeskTicketPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(HdeskTicketPeer::TABLE_NAME);
		$tMap->setPhpName('HdeskTicket');
		$tMap->setClassname('HdeskTicket');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('helpdesk.tb_tickets_id');

		$tMap->addPrimaryKey('CA_IDTICKET', 'CaIdticket', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDGROUP', 'CaIdgroup', 'INTEGER', 'helpdesk.tb_groups', 'CA_IDGROUP', true, null);

		$tMap->addForeignKey('CA_IDPROJECT', 'CaIdproject', 'INTEGER', 'helpdesk.tb_projects', 'CA_IDPROJECT', true, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', false, null);

		$tMap->addColumn('CA_TITLE', 'CaTitle', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TEXT', 'CaText', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PRIORITY', 'CaPriority', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OPENED', 'CaOpened', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_TYPE', 'CaType', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ASSIGNEDTO', 'CaAssignedto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ACTION', 'CaAction', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDTAREA', 'CaIdtarea', 'INTEGER', 'notificaciones.tb_tareas', 'CA_IDTAREA', false, null);

		$tMap->addColumn('CA_IDSEGUIMIENTO', 'CaIdseguimiento', 'INTEGER', false, null);

	} 
} 