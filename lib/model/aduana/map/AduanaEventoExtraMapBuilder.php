<?php


/**
 * This class adds structure of 'tb_brk_eventoextras' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.aduana.map
 */
class AduanaEventoExtraMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.aduana.map.AduanaEventoExtraMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(AduanaEventoExtraPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AduanaEventoExtraPeer::TABLE_NAME);
		$tMap->setPhpName('AduanaEventoExtra');
		$tMap->setClassname('AduanaEventoExtra');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR', 'tb_brk_maestra', 'CA_REFERENCIA', true, null);

		$tMap->addPrimaryKey('CA_IDEVENTO', 'CaIdevento', 'INTEGER', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TEXTO', 'CaTexto', 'VARCHAR', false, null);

	} // doBuild()

} // AduanaEventoExtraMapBuilder
