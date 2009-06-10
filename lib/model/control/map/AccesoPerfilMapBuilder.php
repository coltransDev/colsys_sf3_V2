<?php


/**
 * This class adds structure of 'control.tb_accesos_perfiles' table to 'propel' DatabaseMap object.
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
class AccesoPerfilMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.control.map.AccesoPerfilMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(AccesoPerfilPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AccesoPerfilPeer::TABLE_NAME);
		$tMap->setPhpName('AccesoPerfil');
		$tMap->setClassname('AccesoPerfil');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_RUTINA', 'CaRutina', 'VARCHAR', true, null);

		$tMap->addForeignPrimaryKey('CA_PERFIL', 'CaPerfil', 'VARCHAR' , 'control.tb_perfiles', 'CA_PERFIL', true, null);

		$tMap->addColumn('CA_ACCESO', 'CaAcceso', 'INTEGER', false, null);

	} // doBuild()

} // AccesoPerfilMapBuilder
