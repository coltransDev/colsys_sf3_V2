<?php


/**
 * This class adds structure of 'tb_repequipos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.reportes.map
 */
class RepEquipoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepEquipoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RepEquipoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepEquipoPeer::TABLE_NAME);
		$tMap->setPhpName('RepEquipo');
		$tMap->setClassname('RepEquipo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER' , 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER' , 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_CANTIDAD', 'CaCantidad', 'NUMERIC', false, null);

		$tMap->addColumn('CA_IDEQUIPO', 'CaIdequipo', 'VARCHAR', false, 12);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

	} // doBuild()

} // RepEquipoMapBuilder
