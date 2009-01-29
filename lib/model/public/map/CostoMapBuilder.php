<?php


/**
 * This class adds structure of 'tb_costos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.public.map
 */
class CostoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.CostoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(CostoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CostoPeer::TABLE_NAME);
		$tMap->setPhpName('Costo');
		$tMap->setClassname('Costo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_costos_id');

		$tMap->addPrimaryKey('CA_IDCOSTO', 'CaIdcosto', 'INTEGER', true, null);

		$tMap->addColumn('CA_COSTO', 'CaCosto', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COMISIONABLE', 'CaComisionable', 'VARCHAR', false, null);

	} // doBuild()

} // CostoMapBuilder
