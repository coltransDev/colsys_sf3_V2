<?php


/**
 * This class adds structure of 'ids.ca_idproveedor' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.ids.map
 */
class IdsProveedorMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.ids.map.IdsProveedorMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(IdsProveedorPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsProveedorPeer::TABLE_NAME);
		$tMap->setPhpName('IdsProveedor');
		$tMap->setClassname('IdsProveedor');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDPROVEEDOR', 'CaIdproveedor', 'INTEGER' , 'ids.tb_ids', 'CA_ID', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'INTEGER', true, null);

		$tMap->addColumn('CA_CRITICO', 'CaCritico', 'BOOLEAN', true, null);

		$tMap->addColumn('CA_CONTROLADOPORSIG', 'CaControladoporsig', 'BOOLEAN', true, null);

		$tMap->addColumn('CA_FCHAPROBADO', 'CaFchaprobado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUAPROBADO', 'CaUsuaprobado', 'VARCHAR', false, null);

	} // doBuild()

} // IdsProveedorMapBuilder
