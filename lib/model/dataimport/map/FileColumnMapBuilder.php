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
class FileColumnMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_filecolumns');
		$tMap->setPhpName('FileColumn');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_filecolumns_SEQ');

		$tMap->addForeignKey('CA_IDFILEHEADER', 'CaIdfileheader', 'int', CreoleTypes::INTEGER, 'tb_fileheader', 'CA_IDFILEHEADER', true, null);

		$tMap->addPrimaryKey('CA_IDCOLUMNA', 'CaIdcolumna', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_COLUMNA', 'CaColumna', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_LABEL', 'CaLabel', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_MASCARA', 'CaMascara', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_LONGITUD', 'CaLongitud', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_PRECISION', 'CaPrecision', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_IDREGISTRO', 'CaIdregistro', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, true, null);

	} // doBuild()

} // FileColumnMapBuilder
