<?php


/**
 * This class adds structure of 'tb_falainstructions' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.falabella.map
 */
class FalaInstructionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.falabella.map.FalaInstructionMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(FalaInstructionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FalaInstructionPeer::TABLE_NAME);
		$tMap->setPhpName('FalaInstruction');
		$tMap->setClassname('FalaInstruction');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('CA_IDDOC', 'CaIddoc', 'VARCHAR', 'tb_falaheader', 'CA_IDDOC', true, null);

		$tMap->addColumn('CA_INSTRUCTIONS', 'CaInstructions', 'VARCHAR', false, null);

		$tMap->addPrimaryKey('CA_IDFALAINSTRUCTIONS', 'CaIdfalainstructions', 'INTEGER', true, null);

	} // doBuild()

} // FalaInstructionMapBuilder
