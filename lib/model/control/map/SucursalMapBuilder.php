<?php


/**
 * This class adds structure of 'control.tb_sucursales' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.control.map
 */
class SucursalMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.control.map.SucursalMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('control.tb_sucursales');
		$tMap->setPhpName('Sucursal');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_NOMBRE', 'CaNombre', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('CA_TELEFONO', 'CaTelefono', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CA_FAX', 'CaFax', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'string', CreoleTypes::VARCHAR, false, 100);

	} // doBuild()

} // SucursalMapBuilder
