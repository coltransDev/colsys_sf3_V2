<?php


/**
 * This class adds structure of 'tb_parametros' table to 'propel' DatabaseMap object.
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
class ParametroMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.ParametroMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ParametroPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ParametroPeer::TABLE_NAME);
		$tMap->setPhpName('Parametro');
		$tMap->setClassname('Parametro');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_parametros_ca_casouso_seq');

		$tMap->addPrimaryKey('CA_CASOUSO', 'CaCasouso', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_IDENTIFICACION', 'CaIdentificacion', 'INTEGER', true, null);

		$tMap->addPrimaryKey('CA_VALOR', 'CaValor', 'VARCHAR', true, null);

		$tMap->addColumn('CA_VALOR2', 'CaValor2', 'VARCHAR', false, null);

	} // doBuild()

} // ParametroMapBuilder
