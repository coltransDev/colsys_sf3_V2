<?php


/**
 * This class adds structure of 'tb_traficos' table to 'propel' DatabaseMap object.
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
class TraficoMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.TraficoMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_traficos');
		$tMap->setPhpName('Trafico');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_traficos_SEQ');

		$tMap->addPrimaryKey('CA_IDTRAFICO', 'CaIdtrafico', 'string', CreoleTypes::VARCHAR, true, 6);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('CA_BANDERA', 'CaBandera', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'string', CreoleTypes::VARCHAR, false, 3);

		$tMap->addForeignKey('CA_IDGRUPO', 'CaIdgrupo', 'int', CreoleTypes::INTEGER, 'tb_grupos', 'CA_IDGRUPO', false, null);

		$tMap->addColumn('CA_LINK', 'CaLink', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CA_CONCEPTOS', 'CaConceptos', 'string', CreoleTypes::VARCHAR, false, 255);

	} // doBuild()

} // TraficoMapBuilder
