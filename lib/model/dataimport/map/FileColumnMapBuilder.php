<?php


/**
 * This class adds structure of 'tb_filecolumns' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.dataimport.map
 */
class FileColumnMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.dataimport.map.FileColumnMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(FileColumnPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FileColumnPeer::TABLE_NAME);
		$tMap->setPhpName('FileColumn');
		$tMap->setClassname('FileColumn');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_filecolumns_ca_idcolumna_seq');

		$tMap->addForeignKey('CA_IDFILEHEADER', 'CaIdfileheader', 'INTEGER', 'tb_fileheader', 'CA_IDFILEHEADER', true, null);

		$tMap->addPrimaryKey('CA_IDCOLUMNA', 'CaIdcolumna', 'INTEGER', true, null);

		$tMap->addColumn('CA_COLUMNA', 'CaColumna', 'VARCHAR', true, null);

		$tMap->addColumn('CA_LABEL', 'CaLabel', 'VARCHAR', true, null);

		$tMap->addColumn('CA_MASCARA', 'CaMascara', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_LONGITUD', 'CaLongitud', 'INTEGER', true, null);

		$tMap->addColumn('CA_PRECISION', 'CaPrecision', 'INTEGER', true, null);

		$tMap->addColumn('CA_IDREGISTRO', 'CaIdregistro', 'INTEGER', true, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', true, null);

	} // doBuild()

} // FileColumnMapBuilder
