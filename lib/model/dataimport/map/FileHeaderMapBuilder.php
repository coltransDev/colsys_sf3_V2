<?php


/**
 * This class adds structure of 'tb_fileheader' table to 'propel' DatabaseMap object.
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
class FileHeaderMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.dataimport.map.FileHeaderMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(FileHeaderPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FileHeaderPeer::TABLE_NAME);
		$tMap->setPhpName('FileHeader');
		$tMap->setClassname('FileHeader');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_fileheader_ca_idfileheader_seq');

		$tMap->addPrimaryKey('CA_IDFILEHEADER', 'CaIdfileheader', 'INTEGER', true, null);

		$tMap->addColumn('CA_DESCRIPCION', 'CaDescripcion', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TIPOARCHIVO', 'CaTipoarchivo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_SEPARADOR', 'CaSeparador', 'VARCHAR', true, null);

		$tMap->addColumn('CA_SEPARADORDEC', 'CaSeparadordec', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', true, null);

	} // doBuild()

} // FileHeaderMapBuilder
