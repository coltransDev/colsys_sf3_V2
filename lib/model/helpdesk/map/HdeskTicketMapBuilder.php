<?php


/**
 * This class adds structure of 'helpdesk.tb_tickets' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.helpdesk.map
 */
class HdeskTicketMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.helpdesk.map.HdeskTicketMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
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

	} // doBuild()

} // HdeskTicketMapBuilder
