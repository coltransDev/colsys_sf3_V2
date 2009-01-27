<?php


/**
 * This class adds structure of 'tb_conceptos' table to 'propel' DatabaseMap object.
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
class ConceptoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.ConceptoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ConceptoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ConceptoPeer::TABLE_NAME);
		$tMap->setPhpName('Concepto');
		$tMap->setClassname('Concepto');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_conceptos_id');

		$tMap->addPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', true, null);

		$tMap->addColumn('CA_CONCEPTO', 'CaConcepto', 'VARCHAR', true, null);

		$tMap->addColumn('CA_UNIDAD', 'CaUnidad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_LIMINFERIOR', 'CaLiminferior', 'INTEGER', false, null);

	} // doBuild()

} // ConceptoMapBuilder
