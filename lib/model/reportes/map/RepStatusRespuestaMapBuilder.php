<?php


/**
 * This class adds structure of 'tb_repstatusrespuestas' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.reportes.map
 */
class RepStatusRespuestaMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepStatusRespuestaMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RepStatusRespuestaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepStatusRespuestaPeer::TABLE_NAME);
		$tMap->setPhpName('RepStatusRespuesta');
		$tMap->setClassname('RepStatusRespuesta');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_repstatus', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDEMAIL', 'CaIdemail', 'INTEGER', 'tb_repstatus', 'CA_IDEMAIL', true, null);

		$tMap->addPrimaryKey('CA_IDREPSTATUSRESPUESTAS', 'CaIdrepstatusrespuestas', 'INTEGER', true, null);

		$tMap->addColumn('CA_RESPUESTA', 'CaRespuesta', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

	} // doBuild()

} // RepStatusRespuestaMapBuilder
