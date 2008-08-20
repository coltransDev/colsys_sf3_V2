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
class UsuarioMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('control.tb_usuarios');
		$tMap->setPhpName('Usuario');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('control.tb_usuarios_SEQ');

		$tMap->addPrimaryKey('CA_LOGIN', 'CaLogin', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_SUCURSAL', 'CaSucursal', 'string', CreoleTypes::VARCHAR, 'control.tb_sucursales', 'CA_NOMBRE', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_RUTINAS', 'CaRutinas', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EXTENSION', 'CaExtension', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // UsuarioMapBuilder
