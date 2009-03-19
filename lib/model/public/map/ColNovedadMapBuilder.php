<?php


/**
 * This class adds structure of 'tb_colnovedades' table to 'propel' DatabaseMap object.
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
class ColNovedadMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.ColNovedadMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ColNovedadPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ColNovedadPeer::TABLE_NAME);
		$tMap->setPhpName('ColNovedad');
		$tMap->setClassname('ColNovedad');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_colnovedades_id');

		$tMap->addPrimaryKey('CA_IDNOVEDAD', 'CaIdnovedad', 'INTEGER', true, null);

		$tMap->addColumn('CA_FCHPUBLICACION', 'CaFchpublicacion', 'DATE', false, null);

		$tMap->addColumn('CA_ASUNTO', 'CaAsunto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DETALLE', 'CaDetalle', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHARCHIVAR', 'CaFcharchivar', 'DATE', false, null);

		$tMap->addColumn('CA_EXTENSION', 'CaExtension', 'VARCHAR', false, null);

		$tMap->addColumn('CA_HEADER_FILE', 'CaHeaderFile', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTENT', 'CaContent', 'BLOB', false, null);

		$tMap->addColumn('CA_FCHPUBLICADO', 'CaFchpublicado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUPUBLICADO', 'CaUsupublicado', 'VARCHAR', false, null);

	} // doBuild()

} // ColNovedadMapBuilder
