<?php


/**
 * This class adds structure of 'control.tb_usuarios_perfil' table to 'propel' DatabaseMap object.
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
class UsuarioPerfilMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.control.map.UsuarioPerfilMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(UsuarioPerfilPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UsuarioPerfilPeer::TABLE_NAME);
		$tMap->setPhpName('UsuarioPerfil');
		$tMap->setClassname('UsuarioPerfil');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_LOGIN', 'CaLogin', 'VARCHAR' , 'control.tb_usuarios', 'CA_LOGIN', true, null);

		$tMap->addForeignPrimaryKey('CA_PERFIL', 'CaPerfil', 'VARCHAR' , 'control.tb_perfiles', 'CA_PERFIL', true, null);

	} // doBuild()

} // UsuarioPerfilMapBuilder
