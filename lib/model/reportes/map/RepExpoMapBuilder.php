<?php


/**
 * This class adds structure of 'tb_repexpo' table to 'propel' DatabaseMap object.
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
class RepExpoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepExpoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RepExpoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepExpoPeer::TABLE_NAME);
		$tMap->setPhpName('RepExpo');
		$tMap->setClassname('RepExpo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER' , 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'NUMERIC', false, null);

		$tMap->addColumn('CA_VOLUMEN', 'CaVolumen', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIMENSIONES', 'CaDimensiones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALORCARGA', 'CaValorcarga', 'NUMERIC', false, null);

		$tMap->addColumn('CA_ANTICIPO', 'CaAnticipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDSIA', 'CaIdsia', 'INTEGER', false, null);

		$tMap->addColumn('CA_TIPOEXPO', 'CaTipoexpo', 'INTEGER', false, null);

		$tMap->addColumn('CA_IDLINEATERRESTRE', 'CaIdlineaterrestre', 'INTEGER', false, null);

		$tMap->addColumn('CA_MOTONAVE', 'CaMotonave', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMISIONBL', 'CaEmisionbl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DATOSBL', 'CaDatosbl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NUMBL', 'CaNumbl', 'INTEGER', false, null);

	} // doBuild()

} // RepExpoMapBuilder
