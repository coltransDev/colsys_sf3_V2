<?php


/**
 * This class adds structure of 'tb_stdcliente' table to 'propel' DatabaseMap object.
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
class ClienteStdMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.ClienteStdMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ClienteStdPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ClienteStdPeer::TABLE_NAME);
		$tMap->setPhpName('ClienteStd');
		$tMap->setClassname('ClienteStd');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER' , 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addPrimaryKey('CA_FCHESTADO', 'CaFchestado', 'DATE', true, null);

		$tMap->addColumn('CA_ESTADO', 'CaEstado', 'VARCHAR', false, null);

		$tMap->addPrimaryKey('CA_EMPRESA', 'CaEmpresa', 'VARCHAR', true, null);

	} // doBuild()

} // ClienteStdMapBuilder
