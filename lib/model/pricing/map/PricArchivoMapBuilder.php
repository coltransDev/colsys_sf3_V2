<?php


/**
 * This class adds structure of 'tb_pricarchivos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.pricing.map
 */
class PricArchivoMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.PricArchivoMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_pricarchivos');
		$tMap->setPhpName('PricArchivo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_pricarchivos_SEQ');

		$tMap->addPrimaryKey('CA_IDARCHIVO', 'CaIdarchivo', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addForeignKey('CA_IDTRAFICO', 'CaIdtrafico', 'string', CreoleTypes::VARCHAR, 'tb_traficos', 'CA_IDTRAFICO', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_DESCRIPCION', 'CaDescripcion', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_TAMANO', 'CaTamano', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DATOS', 'CaDatos', 'string', CreoleTypes::BLOB, false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // PricArchivoMapBuilder
