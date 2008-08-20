<?php


/**
 * This class adds structure of 'tb_fileimported' table to 'propel' DatabaseMap object.
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
class FileImportedMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.dataimport.map.FileImportedMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_fileimported');
		$tMap->setPhpName('FileImported');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDFILEHEADER', 'CaIdfileheader', 'int' , CreoleTypes::INTEGER, 'tb_fileheader', 'CA_IDFILEHEADER', true, null);

		$tMap->addPrimaryKey('CA_FCHIMPORTACION', 'CaFchimportacion', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('CA_CONTENT', 'CaContent', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_USUARIO', 'CaUsuario', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_PROCESADO', 'CaProcesado', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addPrimaryKey('CA_NOMBRE', 'CaNombre', 'string', CreoleTypes::VARCHAR, true, null);

	} // doBuild()

} // FileImportedMapBuilder
