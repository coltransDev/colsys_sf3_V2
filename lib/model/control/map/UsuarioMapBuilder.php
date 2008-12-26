<?php


/**
 * This class adds structure of 'control.tb_usuarios' table to 'propel' DatabaseMap object.
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
class UsuarioMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.control.map.UsuarioMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(UsuarioPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UsuarioPeer::TABLE_NAME);
		$tMap->setPhpName('Usuario');
		$tMap->setClassname('Usuario');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('control.tb_usuarios_ca_login_seq');

		$tMap->addPrimaryKey('CA_LOGIN', 'CaLogin', 'VARCHAR', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'VARCHAR', false, 10);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_SUCURSAL', 'CaSucursal', 'VARCHAR', 'control.tb_sucursales', 'CA_NOMBRE', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_RUTINAS', 'CaRutinas', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EXTENSION', 'CaExtension', 'VARCHAR', false, null);

	} // doBuild()

} // UsuarioMapBuilder
