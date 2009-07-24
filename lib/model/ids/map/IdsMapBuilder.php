<?php


/**
 * This class adds structure of 'ids.tb_ids' table to 'propel' DatabaseMap object.
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
class IdsMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.ids.map.IdsMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(IdsPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsPeer::TABLE_NAME);
		$tMap->setPhpName('Ids');
		$tMap->setClassname('Ids');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_ids_id');

		$tMap->addPrimaryKey('CA_ID', 'CaId', 'INTEGER', true, null);

		$tMap->addColumn('CA_DV', 'CaDv', 'INTEGER', false, null);

		$tMap->addColumn('CA_IDALTERNO', 'CaIdalterno', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIPOIDENTIFICACION', 'CaTipoidentificacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDGRUPO', 'CaIdgrupo', 'INTEGER', false, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_WEBSITE', 'CaWebsite', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ACTIVIDAD', 'CaActividad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SECTORECO', 'CaSectoreco', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} // doBuild()

} // IdsMapBuilder
