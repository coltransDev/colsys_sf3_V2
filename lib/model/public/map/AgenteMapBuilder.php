<?php


/**
 * This class adds structure of 'tb_agentes' table to 'propel' DatabaseMap object.
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
class AgenteMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.AgenteMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_agentes');
		$tMap->setPhpName('Agente');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_agentes_SEQ');

		$tMap->addPrimaryKey('CA_IDAGENTE', 'CaIdagente', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'string', CreoleTypes::VARCHAR, 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_ZIPCODE', 'CaZipcode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_WEBSITE', 'CaWebsite', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DIVULGACION', 'CaDivulgacion', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // AgenteMapBuilder
