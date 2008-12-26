<?php


/**
 * This class adds structure of 'bs_pricrecargosxconcepto' table to 'propel' DatabaseMap object.
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
class PricRecargoxConceptoLogMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.PricRecargoxConceptoLogMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(PricRecargoxConceptoLogPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PricRecargoxConceptoLogPeer::TABLE_NAME);
		$tMap->setPhpName('PricRecargoxConceptoLog');
		$tMap->setClassname('PricRecargoxConceptoLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'INTEGER', 'tb_pricfletes', 'CA_IDTRAYECTO', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_pricfletes', 'CA_IDCONCEPTO', true, null);

		$tMap->addForeignKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER', 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addColumn('CA_VLRRECARGO', 'CaVlrrecargo', 'NUMERIC', true, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VLRMINIMO', 'CaVlrminimo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICACION_MIN', 'CaAplicacionMin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, 3);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'DATE', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'DATE', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addPrimaryKey('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', true, null);

	} // doBuild()

} // PricRecargoxConceptoLogMapBuilder
