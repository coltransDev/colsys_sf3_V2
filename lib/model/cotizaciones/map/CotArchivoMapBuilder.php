<?php


/**
 * This class adds structure of 'tb_cotarchivos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.cotizaciones.map
 */
class CotArchivoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotArchivoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(CotArchivoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotArchivoPeer::TABLE_NAME);
		$tMap->setPhpName('CotArchivo');
		$tMap->setClassname('CotArchivo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotarchivos_id');

		$tMap->addPrimaryKey('CA_IDARCHIVO', 'CaIdarchivo', 'VARCHAR', true, null);

		$tMap->addForeignKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER', 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TAMANO', 'CaTamano', 'NUMERIC', false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DATOS', 'CaDatos', 'BLOB', false, null);

	} // doBuild()

} // CotArchivoMapBuilder
